<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 11:22
 */

namespace App\Http\Service;

use App\Http\Api\Module;
use App\Http\Models\UserModel;

class User
{
    public function info()
    {

    }

    public function wxRegister(array $userinfo)
    {
        $user = UserModel::where('openid', $userinfo['openId'])->first();
        if (!$user) {
            $unionid = isset($userinfo['unionId']) && $userinfo['unionId'] ? $userinfo['unionId'] : '';
            $userData = [
                'openid'   => $userinfo['openId'],
                'unionid'  => $unionid,
                'nickname' => $userinfo['nickName'],
                'profile'  => json_encode($userinfo),
            ];
            $user = new UserModel($userData);
            $user->save();
        }
        $user = $user->toArray();
        $profile = json_decode($user['profile']);
        $data = [
            'nickname' => $user['nickname'],
            'img'      => $profile['avatarUrl']
        ];
        return $data;
    }

}