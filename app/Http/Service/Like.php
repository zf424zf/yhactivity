<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 20:39
 */

namespace App\Http\Service;

use App\Http\Models\LikeModel;
use App\Http\Service\Service as Status;

class Like
{
    public function pointLike($uid, $module, $child, $target)
    {
        $like = LikeModel::where('uid', $uid)
            ->where('module', $module)
            ->where('child', $child)
            ->where('target', $target)
            ->first();
        if($like){
            api_exception(Service::LK_USER_HAS_BEEN_LIKE,'您已经点赞过');
        }
        $newLike = new LikeModel();
        $newLike->uid = $uid;
        $newLike->module = $module;
        $newLike->child = $child;
        $newLike->target = $target;
        $newLike->save();
        return api_response(Service::SUCCESS);
    }
}