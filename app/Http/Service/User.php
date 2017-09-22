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
                'unionid' => $unionid,
                'nickname' => $userinfo['nickName'],
                'profile' => json_encode($userinfo),
                'headicon' => $userinfo['avatarUrl'],
            ];
            $user = new UserModel($userData);
            $user->save();
        }
        $user = $user->toArray();
        $profile = json_decode($user['profile']);
        $data = [
            'id' => $user['id'],
            'nickname' => $user['nickname'],
            'img' => $profile->avatarUrl,
        ];
        return $data;
    }

    public function redirectByUser($uid, $nickName, $avatar)
    {
        $this->niceUser($uid, $nickName, $avatar);
        return redirect()->action('IndexController@index');
    }

    public function niceUser($uid, $nickName, $avatar)
    {
        $user = UserModel::where('uid', $uid)->first();
        if (!$user) {
            $user = new UserModel();
            $user->uid = $uid;
            $user->headicon = $avatar;
            $user->nickname = $nickName;
            $user->save();
        }
        session(['user' => $user]);
    }

}