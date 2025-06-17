<?php
namespace app\api\controller;

use app\common\controller\Api;

class Push extends Api
{
    protected $noNeedLogin = ['schedule'];
    protected $noNeedRight = '*';

    public function schedule()
    {
        // 1. 获取参数（注意 data 加上 /a）
        $openid      = $this->request->post('openid');
        $template_id = $this->request->post('template_id');
        $page        = $this->request->post('page');
        $data        = $this->request->post('data/a');      // ← 关键改动
        $sendTime    = $this->request->post('send_time');

        // 2. 参数校验
        if (!$openid || !$template_id || !$page || !$data || !$sendTime) {
            return json(['code'=>0, 'msg'=>'缺少必要参数']);
        }

        // 3. 计算执行时间戳
        $executeAt = is_numeric($sendTime)
            ? (int)$sendTime
            : strtotime($sendTime);
        if ($executeAt <= time()) {
            return json(['code'=>0, 'msg'=>'发送时间必须晚于当前时间']);
        }

        // 4. 连接 Redis
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);

        // 5. 准备载荷并 JSON 编码
        $taskArray = [
            'openid'      => $openid,
            'template_id' => $template_id,
            'page'        => $page,
            'data'        => $data,
        ];
        $payload = json_encode($taskArray, JSON_UNESCAPED_UNICODE);

        // 6. 入队
        $ok = $redis->zAdd('delayed_tasks', $executeAt, $payload);

        if ($ok === false) {
            return json(['code'=>0, 'msg'=>'入队失败，请重试']);
        }
        return json(['code'=>1, 'msg'=>'已加入延时队列']);
    }
}
