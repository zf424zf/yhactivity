<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: skiden
 * Date: 2017/5/18
 * Time: 下午10:13
 */
class WxApp
{

    protected $appId = null;

    protected $appSecret = null;

    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * @param $code
     * @return bool
     * 小程序获取openid
     */
    public function getSession($code)
    {
        $http = new Client();
        $get = [
            'appid'      => $this->appId,
            'secret'     => $this->appSecret,
            'js_code'    => $code,
            'grant_type' => 'authorization_code',
        ];
        $result = $http->get('https://api.weixin.qq.com/sns/jscode2session', ['query' => $get]);
        $response = json_decode($result->getBody()->__toString(), true);
        if (isset($response['openid']) && isset($response['session_key'])) {
            return $response;
        } else {
            api_exception($response['errcode'], $response['errmsg']);
        }
        return false;
    }

    /**
     * @return bool
     * 获取access token
     */
    public function getAccessToken()
    {
        $key = $this->appId . ':access_token';
        $value = cache()->get($key);
        if (!is_null($value)) {
            return $value;
        }
        $http = new Client();
        $get = [
            'appid'      => $this->appId,
            'secret'     => $this->appSecret,
            'grant_type' => 'client_credential',
        ];
        $result = $http->get('https://api.weixin.qq.com/cgi-bin/token', ['query' => $get]);
        $response = json_decode($result->getBody()->__toString());
        if (isset($response->access_token)) {
            cache()->put($key, $response->access_token, 119);
            return $response->access_token;
        }
        return false;
    }

    /**
     * @param $sessionKey
     * @param $data
     * @param $iv
     * @return mixed
     * 微信用户数据解密
     */
    public static function decrypt($sessionKey, $data, $iv)
    {
        $sessionKey = base64_decode($sessionKey);
        $data = base64_decode($data);
        $iv = base64_decode($iv);
        $decrypted = openssl_decrypt($data, 'AES-128-CBC', $sessionKey, OPENSSL_RAW_DATA, $iv);
        //去除补位字符
        $pad = ord(substr($decrypted, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        $result = substr($decrypted, 0, (strlen($decrypted) - $pad));
        return json_decode($result, true);
    }
}