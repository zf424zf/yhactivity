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
        $unionid = isset($userinfo['unionId']) && $userinfo['unionId'] ? $userinfo['unionId'] : '';
        $user = UserModel::where('unionId', $unionid)->first();
        if (!$user) {
            $userData = [
<<<<<<< HEAD
                'openid' => $userinfo['openId'],
                'unionid' => $unionid,
=======
                'unionid'  => $unionid,
>>>>>>> aa0f9c3d91c5e104c7cbfe866072192497bf2a87
                'nickname' => $userinfo['nickName'],
                'profile' => json_encode($userinfo),
            ];
            $user = new UserModel($userData);
            $user->save();
        }
        $user = $user->toArray();
        $profile = json_decode($user['profile']);
        $data = [
            'id'       => $user['id'],
            'nickname' => $user['nickname'],
            'img' => $profile->avatarUrl,
        ];
        return $data;
    }

    public function niceUser($uid, $nickName, $avatar)
    {
        session('sb',2222);
        $user = UserModel::where('uid', $uid)->first();
        if (!$user) {
            $user = new UserModel();
            $user->uid = $uid;
            $user->headicon = $avatar;
            $user->nickname = $nickName;
            $user->save();
        }
        session('user', $user->toArray());
        return true;
    }

}