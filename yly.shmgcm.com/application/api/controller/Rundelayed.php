<?php
namespace app\api\controller;
use app\common\controller\Api;

use think\Controller;
use think\Db;               // ← 一定要加上
use app\common\utils\WeChat;

class Rundelayed extends Api
{
    public function index()
    {
       // 1. 连接 Redis
echo "[" . date('H:i:s') . "] Step 1: 开始连接 Redis\n";
$redis = new Redis();
try {
    $redis->connect('127.0.0.1', 6379);
    echo "[" . date('H:i:s') . "] Step 1: Redis 连接成功\n";
} catch (\Exception $e) {
    echo "[" . date('H:i:s') . "] Step 1: Redis 连接失败：" . $e->getMessage() . "\n";
    exit;
}

// 2. 当前毫秒级时间戳（写死用于测试）
$now = (int)(microtime(true) * 1000);
$testPayload = json_encode(['task_id' => 10], JSON_UNESCAPED_UNICODE);
$redis->zAdd('delayed_tasks', $now, $testPayload);

echo "[" . date('H:i:s') . "] Step 2: 使用测试时间戳 now = {$now}\n";

// 3. 从 Redis 延时队列拉出所有到期的任务
echo "[" . date('H:i:s') . "] Step 3: 从 delayed_tasks 拉取 score <= now 的成员\n";
$members = $redis->zRangeByScore('delayed_tasks', 0, $now);
$count = count($members);
echo "[" . date('H:i:s') . "] Step 3: 找到 {$count} 个到期任务\n";
if ($count === 0) {
    echo "[" . date('H:i:s') . "] 暂无到期任务，脚本结束\n";
    exit;
}

foreach ($members as $index => $m) {
    echo "[" . date('H:i:s') . "] ---- 处理第 " . ($index + 1) . " 个任务 ----\n";

    // 4. 防重：先从队列删除
    echo "[" . date('H:i:s') . "] Step 4: 从 Redis zRem 成员\n";
    $redis->zRem('delayed_tasks', $m);

    // 5. 解析 Member，拿到 task_id
    echo "[" . date('H:i:s') . "] Step 5: 解析 JSON member\n";
    $obj = json_decode($m, true);
    if (!$obj || !isset($obj['task_id'])) {
        echo "[" . date('H:i:s') . "] Step 5: 解析失败，member 内容：{$m}\n";
        continue;
    }
    $taskId = $obj['task_id'];
    echo "[" . date('H:i:s') . "] Step 5: task_id = {$taskId}\n";

    // 6. 从子表查这一条任务，状态仍是 pending
    echo "[" . date('H:i:s') . "] Step 6: 查询 fa_reminder_task 中的任务\n";
    $task = Db::name('reminder_task')
        ->where('id', $taskId)
        ->where('status', 'pending')
        ->find();
    if (!$task) {
        echo "[" . date('H:i:s') . "] Step 6: 未找到 pending 状态任务或已被处理，跳过\n";
        continue;
    }
    echo "[" . date('H:i:s') . "] Step 6: 任务状态 pending，schedule_at = {$task['schedule_at']}\n";

    // 7. 查询主表
    echo "[" . date('H:i:s') . "] Step 7: 查询 fa_reminder 中的配置\n";
    $reminder = Db::name('reminder')->where('id', $task['reminder_id'])->find();
    if (!$reminder) {
        echo "[" . date('H:i:s') . "] Step 7: 未找到对应的 fa_reminder 记录\n";
        continue;
    }
    echo "[" . date('H:i:s') . "] Step 7: 找到 reminder: drug_name={$reminder['drug_name']}, dosage={$reminder['dosage']}\n";

    // 8. 构造模板数据
    echo "[" . date('H:i:s') . "] Step 8: 构造模板数据\n";
    $templateData = [
        'thing1' => ['value' => $reminder['drug_name']],
        'time2'  => ['value' => date('Y-m-d H:i', $task['schedule_at'] / 1000)],
        'thing3' => ['value' => "请按时服用：{$reminder['dosage']}"],
    ];
    echo "[" . date('H:i:s') . "] Step 8: templateData = " . json_encode($templateData, JSON_UNESCAPED_UNICODE) . "\n";

    try {
        // 9. 调用微信订阅消息发送
        echo "[" . date('H:i:s') . "] Step 9: 调用 WeChat::sendRemind()\n";
        WeChat::sendRemind(
            $reminder['openid'],
            $reminder['template_id'],
            $reminder['page'],
            $templateData
        );

        // 10. 更新子表状态
        echo "[" . date('H:i:s') . "] Step 10: 更新任务状态为 sent\n";
        Db::name('reminder_task')->where('id', $taskId)->update([
            'status'    => 'sent',
            'sent_time' => date('Y-m-d H:i:s')
        ]);

        echo "[" . date('H:i:s') . "] Step 10: 任务 {$taskId} 发送成功\n";
    } catch (\Exception $e) {
        // 11. 失败处理
        echo "[" . date('H:i:s') . "] Step 11: 捕获异常，标记为 failed\n";
        Db::name('reminder_task')->where('id', $taskId)->update(['status' => 'failed']);
        echo "[" . date('H:i:s') . "] Step 11: 任务 {$taskId} 发送失败，错误：" . $e->getMessage() . "\n";
    }
     }
	}
}
