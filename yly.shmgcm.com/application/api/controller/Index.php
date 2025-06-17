<?php
namespace app\api\controller;

use app\common\controller\Api;
use think\Request;

class Index extends Api
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function testapi(Request $request)
    {
        // 要监控的接口URL
        $targetUrl = 'https://sail-api.ibox.art/api-public-service/announcements?categoryId=-1&pageNo=1&pageSize=20';

        // 捕获异常，防止接口请求失败导致程序崩溃
        try {
            // 实时抓取最新数据
            $currentData = file_get_contents($targetUrl);  // 请求目标接口并获取数据
            if ($currentData === false) {
                throw new \Exception('接口请求失败');  // 如果请求失败，则抛出异常
            }

            // 将数据解析成 PHP 数组
            $data = json_decode($currentData, true);

            // 提取 list 部分的数据
            $listData = $data['data']['list'] ?? [];

            // 对 list 数组中的每一项进行标准化处理，选取关键字段来生成哈希
            $normalizedList = [];
            foreach ($listData as $item) {
                $normalizedList[] = [
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'createdAt' => $item['createdAt'],
                    'preAnnouncementId' => $item['preAnnouncementId'],
                    'itemUrl' => $item['itemUrl'],  // 添加 itemUrl
                ];
            }

            // 将标准化后的 list 数组进行 JSON 序列化并计算哈希值
            $currentHash = md5(json_encode($normalizedList));  // 使用整个数据的哈希

            // 获取 ThinkPHP 运行时目录
            $runtimePath = ROOT_PATH . 'runtime/';  // 使用 ROOT_PATH 获取应用根目录

            // 哈希文件路径
            $hashFile = $runtimePath . 'hash/last_hash.txt';

            // 检查目录是否存在，不存在则创建
            if (!is_dir($runtimePath . 'hash')) {
                mkdir($runtimePath . 'hash', 0777, true); // 创建目录
            }

            // 从文件读取上次存储的哈希值
            $lastHash = @file_get_contents($hashFile);  // 使用 `@` 防止文件不存在时报错

            // 判断数据是否有变化
            $hasUpdate = ($currentHash != $lastHash);  // 如果当前哈希值与上次不一样，则表示有更新

            // 如果数据更新了，则返回相关通知信息（包含 link）
            if ($hasUpdate) {
                // 提取最新的公告 id 和 title，生成跳转链接
                $latestItem = $listData[0]; // 假设最新的一条数据是第一个
                $noticeId = $latestItem['id'];
                $itemUrl = "https://announcement.ibox.art/#/detail?noticeId=" . $noticeId;

                // 将当前哈希值存储到文件中，持久化存储
                file_put_contents($hashFile, $currentHash);  // 存储当前哈希值

                return json([
                    'code' => 200,
                    'msg' => '成功',
                    'data' => [
                        'has_update' => true,
                        'notice_id' => $noticeId,
                        'item_url' => $itemUrl,  // 返回跳转链接
                        'title' => $latestItem['title'],  // 返回标题
                    ]
                ]);
            }

            // 返回数据（没有更新时）
            return json([
                'code' => 200,
                'msg' => '成功',
                'data' => [
                    'has_update' => false,  // 没有更新
                ]
            ]);
        } catch (\Exception $e) {
            // 如果发生异常，返回错误信息
            return json([
                'code' => 500,
                'msg' => '请求接口失败: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
}
