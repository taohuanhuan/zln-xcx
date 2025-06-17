<?php
namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

class Reminder extends Api
{
    protected $noNeedLogin = [];
    protected $noNeedRight = '*';

    /**
     * 保存用药提醒（支持多时间点）
     */
    public function save()
    {
        $userId     = $this->auth->id;
        $startTs    = $this->request->post('startDateTs');
        $duration   = $this->request->post('duration');
        $planPeriod = $this->request->post('planPeriod');
        $planTimes  = $this->request->post('planTimes');
        $timeList   = $this->request->post('timeList/a');
        $dosage     = $this->request->post('dosage');
        $drugName     = $this->request->post('drugName');

        if (
            !$startTs || !$duration || !$planPeriod ||
            !$planTimes || !is_array($timeList) || empty($timeList) || !$dosage
        ) {
            return json(['code'=>0,'msg'=>'参数不完整','data'=>null]);
        }

        $startDate = date('Y-m-d', intval($startTs) / 1000);
        $remindTimes = [];
        foreach ($timeList as $ts) {
            $remindTimes[] = is_numeric($ts)
                ? date('H:i', intval($ts) / 1000)
                : $ts;
        }

        Db::startTrans();
        try {
            // 主表，禁用前缀
            $masterId = Db::table('yly_medication_reminder', false)
                ->insertGetId([
                    'user_id'    => $userId,
                    'start_date' => $startDate,
                    'drug_name' => $drugName,
                    'duration'   => intval($duration),
                    'plan_period'=> $planPeriod,
                    'plan_times' => intval($planTimes),
                    'dosage'     => $dosage,
                    'status'     => 1,
                    'createtime' => date('Y-m-d H:i:s'),
                    'updatetime' => date('Y-m-d H:i:s'),
                ]);

            // 子表，多条时间点
            $rows = [];
            foreach ($remindTimes as $timeStr) {
                $rows[] = [
                    'reminder_id' => $masterId,
                    'time'        => $timeStr,
                    'status'      => 1,
                ];
            }
            Db::table('yly_medication_reminder_time', false)
              ->insertAll($rows);

            Db::commit();
            return json(['code'=>1,'msg'=>'保存成功','data'=>['id'=>$masterId]]);
        } catch (\Exception $e) {
            Db::rollback();
            return json(['code'=>0,'msg'=>'保存失败: '.$e->getMessage(),'data'=>null]);
        }
    }

    /**
     * 当日用药提醒列表（含药品名称）
     */
    public function todayList()
    {
        $userId = $this->auth->id;
        $today  = date('Y-m-d');

        // 查主表
        $reminders = Db::table('yly_medication_reminder', false)
            ->alias('r')
            ->field('r.id,r.drug_name,r.dosage')
            ->where('r.user_id', $userId)
            ->where('r.status', 1)
            ->where('r.start_date', '<=', $today)
            ->whereRaw("DATE_ADD(r.start_date, INTERVAL r.duration-1 DAY) >= '{$today}'")
            ->select();

        $list = [];
        foreach ($reminders as $rem) {
            $times = Db::table('yly_medication_reminder_time', false)
                ->where('reminder_id', $rem['id'])
                ->order('time ASC')
                ->select();
            foreach ($times as $t) {
                $list[] = [
                    'time'   => $t['time'],
                    'id'   => $t['id'],
                    'name'   => $rem['drug_name'],
                    'dosage' => $rem['dosage'],
                    'status' => $t['status']
                ];
            }
        }

        return json(['code'=>1,'msg'=>'获取成功','data'=>$list]);
    }

/**
 * 标记服药状态
 * @ApiMethod (POST)
 * @ApiParams (name="timeId", type="int", required=true, description="时间点 ID")
 * @ApiParams (name="status", type="int", required=true, description="0=已服药，1=待服药")
 */
public function mark()
{
    $userId = $this->auth->id;
    $timeId = (int)$this->request->post('timeId');
    $status = (int)$this->request->post('status');

    if (!$timeId || !in_array($status, [0,1], true)) {
        return json(['code'=>0,'msg'=>'参数错误','data'=>null]);
    }

    // 1. 取子表记录，拿到 reminder_id
    $timeRec = Db::table('yly_medication_reminder_time', false)
        ->where('id', $timeId)
        ->field('reminder_id')
        ->find();

    if (!$timeRec) {
        return json(['code'=>0,'msg'=>'记录不存在','data'=>null]);
    }

    // 2. 验证 reminder_id 属于当前用户
    $rem = Db::table('yly_medication_reminder', false)
        ->where('id', $timeRec['reminder_id'])
        ->where('user_id', $userId)
        ->field('id')
        ->find();

    if (!$rem) {
        return json(['code'=>0,'msg'=>'无权限操作','data'=>null]);
    }

    // 3. 更新状态
    $updated = Db::table('yly_medication_reminder_time', false)
        ->where('id', $timeId)
        ->update(['status' => $status]);

    if ($updated !== false) {
        return json(['code'=>1,'msg'=>'更新成功','data'=>null]);
    } else {
        return json(['code'=>0,'msg'=>'更新失败','data'=>null]);
    }
}

 public function create()
    {
        $r = $this->request;
        // 1. 接收并校验参数
        $userId     = $this->auth->id; // 或者从 token 中获取
        $drugName   = $r->post('drugName/s');
        $dosage     = $r->post('dosage/s');
        $startDate  = $r->post('startDate/s');   // 格式 '2025-05-23'
        $duration   = $r->post('duration/d');    // 天数
        $timeList   = $r->post('timeList/a');    // ['08:00','14:00','20:00']
        $templateId = $r->post('template_id/s');
        $page       = $r->post('page/s');

        if (!$drugName || !$dosage || !$startDate || !$duration || !$timeList || !$templateId || !$page) {
            return json(['code'=>0,'msg'=>'缺少必要参数']);
        }

        // 2. 写主表 fa_reminder
        $reminderId = Db::name('reminder')->insertGetId([
            'user_id'    => $userId,
            'drug_name'  => $drugName,
            'dosage'     => $dosage,
            'start_date' => $startDate,
            'duration'   => $duration,
            'frequency'  => count($timeList),
            'times_json' => json_encode($timeList, JSON_UNESCAPED_UNICODE),
            'template_id'=> $templateId,
            'page'       => $page,
            'status'     => 'pending',
            'create_time'=> date('Y-m-d H:i:s'),
        ]);

        if (!$reminderId) {
            return json(['code'=>0,'msg'=>'保存提醒配置失败']);
        }

        // 3. 生成子任务并入库、入 Redis
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);

        // 3.1 将 startDate 转成当天零点时间戳（秒）
        $baseDateTs = strtotime($startDate . ' 00:00:00');

        // 3.2 循环 duration 天，每天按 timeList 生成 schedule_at（毫秒）
        $tasks = [];
        for ($day = 0; $day < $duration; $day++) {
            foreach ($timeList as $time) {
                list($h, $m) = explode(':', $time);
                $tsSec = $baseDateTs + $day * 86400 + $h * 3600 + $m * 60;
                $scheduleAt = $tsSec * 1000; // 毫秒

                // 3.3 入子表
                $taskId = Db::name('reminder_task')->insertGetId([
                    'reminder_id' => $reminderId,
                    'schedule_at' => $scheduleAt,
                    'status'      => 'pending',
                    'create_time' => date('Y-m-d H:i:s'),
                ]);

                if ($taskId) {
                    // 3.4 将 task_id 入 Redis 延时队列
                    $payload = json_encode(['task_id' => $taskId], JSON_UNESCAPED_UNICODE);
                    $redis->zAdd('delayed_tasks', $scheduleAt, $payload);
                }
            }
        }

        return json(['code'=>1,'msg'=>'用药提醒创建成功']);
    }

}
