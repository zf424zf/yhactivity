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
            $user = new UserModel();
            $user->openid = $userinfo['openId'];
            $user->unionid = $unionid;
            $user->nickname = $userinfo['nickName'];
            $user->profile = $userinfo;
            $user->save();
        }
        return $user;
    }

}