<?php

namespace app\api\controller;

use app\common\controller\Api;

require '../extend/top/TopSdk.php'; // 手动引入淘宝客 SDK

class Taobao extends Api
{
    // 无需登录的接口
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口
    protected $noNeedRight = ['*'];

    private $client;
    private $appkey = '34978207';
    private $secret = '5ad0632b2df6c2da050ff808e1159fcc';

    public function __construct()
    {
        parent::__construct();

        // 初始化淘宝客客户端
        $this->client = new \TopClient();
        $this->client->appkey = $this->appkey;
        $this->client->secretKey = $this->secret;
        $this->client->format = 'json'; // 返回 JSON 格式数据
    }

    /**
     * 查询商品详情
     */
    public function getItemDetails()
    {
        // 创建请求对象
        $req = new \TbkItemInfoGetRequest();
        $req->setNumIids("766722564298"); // 商品ID，多个用逗号分隔
        $req->setPlatform(1); // 平台类型：1-PC，2-无线
        $req->setIp("11.22.33.43"); // 可选参数

        // 执行请求
        try {
            $response = $this->client->execute($req);

            return json([
                'code' => 200,
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return json([
                'code' => 500,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    /**
     * 搜索店铺
     */
    public function searchShops()
    {
        // 创建请求对象
        $req = new \TbkShopGetRequest();

        // 设置请求参数
        $req->setFields("user_id,shop_title,shop_type,seller_nick,pict_url,shop_url"); // 必填字段
        $req->setQ("女装"); // 查询关键词
        $req->setSort("commission_rate_des"); // 按佣金比率降序排序
        $req->setIsTmall("false"); // 是否仅查询天猫店铺 (true: 天猫, false: 全部)
        $req->setPlatform(1); // 平台类型：1-PC端，2-无线端
        $req->setPageNo(1); // 页码，默认值为1
        $req->setPageSize(20); // 每页返回的结果数，默认值为20

        // 可选参数
        $req->setStartCredit(1); // 店铺信用等级下限
        $req->setEndCredit(20); // 店铺信用等级上限
        $req->setStartCommissionRate(2000); // 淘客佣金比率下限
        $req->setEndCommissionRate(10000); // 淘客佣金比率上限

        // 执行请求
        try {
            $response = $this->client->execute($req);

            if (isset($response->results->n_tbk_shop)) {
                return json([
                    'code' => 200,
                    'data' => $response->results->n_tbk_shop, // 店铺列表
                    'total_results' => $response->total_results, // 总结果数
                ]);
            } else {
                return json([
                    'code' => 400,
                    'msg' => $response->msg ?? '请求失败',
                    'sub_code' => $response->sub_code ?? '',
                    'sub_msg' => $response->sub_msg ?? ''
                ]);
            }
        } catch (\Exception $e) {
            return json([
                'code' => 500,
                'msg' => $e->getMessage(),
            ]);
        }
    }
	    /**
     * 生成淘宝客商品推广链接
     */
    public function getPrivilegeLink()
    {
        // 用户输入的商品链接
        $item_url = "https://item.taobao.com/item.htm?id=856937422881"; // 示例商品链接
        $item_id = $this->extractItemIdFromUrl($item_url); // 提取商品ID

        // 创建请求对象
        $req = new \TbkPrivilegeGetRequest();

        // 设置请求参数
        $req->setAdzoneId("mm_30905544_3170750103_115839750224"); // 推广位ID，必须使用自己的
        $req->setPlatform(1); // 平台类型：1-PC，2-无线
        $req->setSiteId("1"); // 网站ID，必填
        $req->setItemId($item_id); // 商品ID，必须传入商品ID
        $req->setPromotionType("2"); // 推广类型，2-推广赚（代理模式）
        $req->setBizSceneId("1"); // 场景ID，默认为1

        // 执行请求
        try {
            $response = $this->client->execute($req);

            // 检查响应并返回数据
            if (isset($response->tbk_privilege_get_response->result->data)) {
                $data = $response->tbk_privilege_get_response->result->data;

                return json([
                    'code' => 200,
                    'data' => [
                        'item_url' => $data->item_url, // 推广商品的链接
                        'coupon_click_url' => $data->coupon_click_url, // 优惠券推广链接
                        'coupon_info' => $data->coupon_info, // 优惠券信息
                        'commission_rate' => $data->ysyl_commission_rate, // 佣金比例
                    ],
                ]);
            } else {
                return json([
                    'code' => 400,
                    'msg' => $response->msg ?? '请求失败',
                    'sub_code' => $response->sub_code ?? '',
                    'sub_msg' => $response->sub_msg ?? ''
                ]);
            }
        } catch (\Exception $e) {
            return json([
                'code' => 500,
                'msg' => $e->getMessage(),
            ]);
        }
    }

    // 提取商品ID的方法
    private function extractItemIdFromUrl($url)
    {
        preg_match('/id=(\d+)/', $url, $matches);
        return $matches[1] ?? null; // 返回商品ID
    }
}
