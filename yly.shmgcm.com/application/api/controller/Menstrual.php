<?php
namespace app\api\controller;
use app\common\controller\Api;
use think\Db;

class Menstrual extends Api
{
    // 需要登录；免二级权限检查
    protected $noNeedLogin = [];
    protected $noNeedRight = '*';

    /**
     * 保存一次经期记录：支持单独标记开始或结束
     * POST 参数：
     *   type  = start|end
     *   date  = Y-m-d
     */
    public function save()
    {
        $userId = $this->auth->id;
        $type   = $this->request->post('type/s', '');
        $date   = $this->request->post('date/s', '');

        // 简单校验
        if (!in_array($type, ['start','end']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return json(['code'=>0,'msg'=>'参数错误','data'=>null]);
        }

        $now = date('Y-m-d H:i:s');

        Db::startTrans();
        try {
            if ($type === 'start') {
                // 新建一条仅含开始日期的记录
                $id = Db::table('fa_menstrual_period', false)
                    ->insertGetId([
                        'user_id'       => $userId,
                        'start_date'    => $date,
                        'end_date'      => null,
                        'cycle_days'    => null,
                        'duration_days' => null,
                        'createtime'    => $now,
                        'updatetime'    => $now,
                    ]);
                $row = Db::table('fa_menstrual_period', false)->where('id', $id)->find();
            } else {
                // 找到最近一条未结束的记录
                $row = Db::table('fa_menstrual_period', false)
                    ->where('user_id', $userId)
                    ->whereNull('end_date')
                    ->order('start_date', 'desc')
                    ->find();
                if (!$row) {
                    Db::rollback();
                    return json(['code'=>0,'msg'=>'请先标记开始日期','data'=>null]);
                }
                // 计算持续天数
                $duration = floor((strtotime($date) - strtotime($row['start_date']))/86400) + 1;
                // 计算周期天数（与上一次开始日差）
                $prevStart = Db::table('fa_menstrual_period', false)
                    ->where('user_id', $userId)
                    ->where('id', '<', $row['id'])
                    ->order('start_date', 'desc')
                    ->value('start_date');
                $cycle = $prevStart
                    ? floor((strtotime($row['start_date']) - strtotime($prevStart))/86400)
                    : null;

                // 更新本条
                Db::table('fa_menstrual_period', false)
                    ->where('id', $row['id'])
                    ->update([
                        'end_date'      => $date,
                        'duration_days' => $duration,
                        'cycle_days'    => $cycle,
                        'updatetime'    => $now
                    ]);

                // 重
                $row = Db::table('fa_menstrual_period', false)->where('id', $row['id'])->find();
            }

            Db::commit();
            return json(['code'=>1,'msg'=>'保存成功','data'=>$row]);
        } catch (\Exception $e) {
            Db::rollback();
            return json(['code'=>0,'msg'=>'保存失败: '.$e->getMessage(),'data'=>null]);
        }
    }

    /**
     * 列出所有记录（不分页）
     */
    public function list()
    {
        $userId = $this->auth->id;
        $data = Db::table('fa_menstrual_period', false)
            ->where('user_id', $userId)
            ->order('start_date', 'desc')
            ->select();
        return json(['code'=>1,'msg'=>'ok','data'=>$data]);
    }

    /**
     * 最近一次记录
     */
    public function latest()
    {
        $userId = $this->auth->id;
        $row = Db::table('fa_menstrual_period', false)
            ->where('user_id', $userId)
            ->order('start_date', 'desc')
            ->find();
        return json(['code'=>1,'msg'=>'ok','data'=>$row]);
    }
}
