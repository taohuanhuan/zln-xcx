<?php
namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\User;

class Wx extends Api
{
    protected $noNeedLogin = ['login'];
    protected $noNeedRight = '*';

    public function login()
    {
        try {
            // 1. 参数校验
            $code = $this->request->post('code');
            if (!$code || !is_string($code)) {
                return json(['code' => 0, 'msg' => __('缺少 code 参数'), 'data' => null]);
            }

            // 2. 微信接口
            $appid  = 'wxe73c7ebff470d287';
            $secret = '706ddf45f2c6d97fcb388306af7271a9';
            $url    = "https://api.weixin.qq.com/sns/jscode2session?"
                    . "appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";
            $json   = @file_get_contents($url);
            if ($json === false) {
                return json(['code' => 0, 'msg' => __('请求微信接口失败'), 'data' => null]);
            }

            // 3. 强制转换 UTF-8
            $json = mb_convert_encoding($json, 'UTF-8', 'UTF-8');
            $res  = json_decode($json, true);
            if (!isset($res['openid'])) {
                $errmsg = isset($res['errmsg']) ? $res['errmsg'] : __('未知错误');
                return json(['code' => 0, 'msg' => __('微信登录失败：') . $errmsg, 'data' => null]);
            }

            // 4. 查用户 / 注册
            $openid = $res['openid'];
            $user   = User::where('openid', $openid)->find();
            $isNew  = false;
            if (!$user) {
                $user = User::create([
                    'username'   => 'wx_' . substr($openid, -6),
                    'openid'     => $openid,
                    'status'     => 'normal',
                    'logintime'  => time(),
                    'loginip'    => request()->ip(),
                    'createtime' => time(),
                ]);
                $isNew = true;
            }

            // 5. 登录 + 取 token
            $this->auth->direct($user->id);
            $token = $this->auth->getToken();

            return json([
                'code' => 1,
                'msg'  => __('登录成功'),
                'data' => [
                    'token'  => $token,
                    'is_new' => $isNew,
                    'user'   => [
                        'id'       => $user->id,
                        'nickname' => $user->nickname,
                        'avatar'   => $user->avatar,
                        'openid'   => $user->openid,
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            // 出现任何异常，也不要走框架默认的 error()，直接返回纯 UTF-8
            return json([
                'code' => 0,
                'msg'  => __('系统异常：') . $e->getMessage(),
                'data' => null,
            ]);
        }
    }
}
