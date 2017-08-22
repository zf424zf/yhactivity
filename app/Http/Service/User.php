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
            $userData = [
                'openid'   => $userinfo['openId'],
                'unionid'  => isset($userinfo['unionId']) ? $userinfo['unionId'] : null,
                'nickname' => $userinfo['nickName'],
                'profile'  => $userinfo,
            ];
            $user = new UserModel($userData);
            $user->save();
        }
        return $user;
    }

}