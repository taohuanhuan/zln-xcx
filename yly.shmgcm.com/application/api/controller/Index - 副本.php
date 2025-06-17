<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Request;  // 正确引入 Request 类

class Index extends Api
{
    // 公共配置项
    protected static $vekey = 'V89656787H40284406';  // 替换成你的 vekey
    protected static $pid = 'mm_30905544_3170750103_115839750224';  // 默认 PID
    protected static $relation_id = '3160664444';  // 默认关系ID

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    /**
     * 测试接口
     *
     * @param Request $request
     * @return \think\response\Json
     */
    public function testapi(Request $request)
    {
        // 获取请求参数
        $param = $request->param('param', 'https://detail.tmall.com/item.htm?id=600601736405'); // 获取 'param' 参数，默认值为 'default_value'

        // 返回测试数据
        $response = [
            'code' => 200,
            'msg' => '成功',
            'data' => [
                'received_param' => $param,  // 显示接收到的参数
                'status' => 'API is working',
            ]
        ];

        return json($response);
    }

    /**
     * 万能转链接口
     *
     * @param Request $request
     * @return \think\response\Json
     */
    public function generalConvert(Request $request)

    {
        // 获取请求参数
//        $para = urlencode($request->param('para'));  // URL 编码后的参数

        $para = 'https://detail.tmall.com/item.htm?id=600601736405';  // URL 编码后的参数

        
        $globaltpwd = $request->param('globaltpwd', 1); // 是否生成 IOS 和 安卓通用淘口令
        $promotion_type = $request->param('promotion_type', 1); // 推广类型，默认 1
        $detail = $request->param('detail', 2); // 详情字段，默认 2

        // 构建请求的 URL
        $url = 'http://api.veapi.cn/tbk/generalconvert';
        $params = [
            'vekey' => self::$vekey,
            'para' => $para,
            'pid' => self::$pid,
            'relation_id' => self::$relation_id,
            'globaltpwd' => $globaltpwd,
            'promotion_type' => $promotion_type,
            'detail' => $detail
        ];

        // 发起 GET 请求
        $response = $this->makeRequest($url, $params);

        // 返回请求结果
        return json($response);
    }

    /**
     * 发起 HTTP GET 请求
     *
     * @param string $url 请求的 URL
     * @param array $params 请求的参数
     * @return mixed
     */
    private function makeRequest($url, $params)
    {
        // 初始化 cURL
        $ch = curl_init();

        // 设置 cURL 选项
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // 执行请求并获取响应
        $response = curl_exec($ch);

        // 检查请求是否成功
        if (curl_errno($ch)) {
            return ['error' => 1, 'msg' => curl_error($ch)];
        }

        // 关闭 cURL
        curl_close($ch);

        // 返回 JSON 解码的响应
        return json_decode($response, true);
    }
}
