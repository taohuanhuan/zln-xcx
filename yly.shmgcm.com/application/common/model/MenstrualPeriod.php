<?php
namespace app\common\model;

use think\Model;
use think\Exception;

class MenstrualPeriod extends Model
{
    // 数据库表名（会自动加上全局前缀 fa_）
    protected $name = 'menstrual_period';

    // 自动写入 createtime 和 updatetime 两个字段
    protected $autoWriteTimestamp = 'int';
    protected $createTime        = 'createtime';
    protected $updateTime        = 'updatetime';

    // 允许所有字段写入
    protected $field = true;

    /**
     * 记录一次经期开始或结束
     *
     * @param int    $userId 用户ID
     * @param string $type   'start' 或 'end'
     * @param string $date   Y-m-d 格式
     * @return MenstrualPeriod
     * @throws Exception
     */
    public static function recordPeriod(int $userId, string $type, string $date): self
    {
        if (!in_array($type, ['start','end'])) {
            throw new Exception('type 参数必须是 start 或 end');
        }
        // 简单校验日期
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception('date 格式必须为 YYYY-MM-DD');
        }

        if ($type === 'start') {
            // 新增一条仅含开始日期的记录
            return self::create([
                'user_id'    => $userId,
                'start_date' => $date
            ], true);
        }

        // type === 'end'：补全最近一条没有 end_date 的记录
        $row = self::where('user_id', $userId)
            ->whereNull('end_date')
            ->order('start_date', 'desc')
            ->find();

        if (!$row) {
            throw new Exception('请先记录经期开始');
        }

        // 填写结束日期
        $row->end_date = $date;

        // 计算持续天数 = end_date - start_date + 1
        $row->duration_days = floor((strtotime($date) - strtotime($row->start_date)) / 86400) + 1;

        // 计算周期天数 = 本次开始 - 上次开始
        $prevStart = self::where('user_id', $userId)
            ->where('id', '<', $row->id)
            ->order('start_date', 'desc')
            ->value('start_date');

        $row->cycle_days = $prevStart
            ? floor((strtotime($row->start_date) - strtotime($prevStart)) / 86400)
            : null;

        $row->save();
        return $row;
    }

    /**
     * 获取某用户的所有经期记录（按开始日期倒序）
     *
     * @param int $userId
     * @return \think\Collection
     */
    public static function listByUser(int $userId)
    {
        return self::where('user_id', $userId)
            ->order('start_date', 'desc')
            ->select();
    }

    /**
     * 获取某用户最近一次经期记录
     *
     * @param int $userId
     * @return MenstrualPeriod|null
     */
    public static function latestByUser(int $userId)
    {
        return self::where('user_id', $userId)
            ->order('start_date', 'desc')
            ->find();
    }
}
