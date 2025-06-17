<?php
namespace app\common\utils;

use think\facade\Config;
use think\facade\Cache;
use think\facade\Log;
use think\facade\Http;

class WeChat
{
    const TOKEN_CACHE_KEY = 'wechat_access_token';

    public static function getAccessToken(): string
    {
        if ($token = Cache::get(self::TOKEN_CACHE_KEY)) {
            return $token;
        }
        $appId  = Config::get('wechat.appid');
        $secret = Config::get('wechat.secret');
        $res = Http::get('https://api.weixin.qq.com/cgi-bin/token', [
            'grant_type' => 'client_credential',
            'appid'      => $appId,
            'secret'     => $secret,
        ])->json();
        if (isset($res['access_token'])) {
            Cache::set(self::TOKEN_CACHE_KEY, $res['access_token'], $res['expires_in'] - 200);
            return $res['access_token'];
        }
        Log::error('��ȡ access_token ʧ��', $res);
        throw new \Exception('��ȡ΢�� access_token ʧ��');
    }

    public static function sendRemind(string $openid, string $templateId, string $page, array $data): array
    {
        $token = self::getAccessToken();
        $url   = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token={$token}";
        $res = Http::post($url, [
            'touser'      => $openid,
            'template_id' => $templateId,
            'page'        => $page,
            'data'        => $data,
        ])->json();
        if (isset($res['errcode']) && $res['errcode'] === 0) {
            return $res;
        }
        Log::error('���Ͷ�����Ϣʧ��', $res);
        throw new \Exception('���Ͷ�����Ϣʧ��:' . ($res['errmsg'] ?? 'unknown'));
    }
}
