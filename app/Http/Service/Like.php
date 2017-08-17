<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 20:39
 */

namespace App\Http\Service;

use App\Http\Api\Module;
use App\Http\Models\LikeModel;
use App\Http\Service\Service as Status;
use Carbon\Carbon;

class Like
{
    public $startTimestamp;
    public $endTimestamp;

    public function __construct()
    {
        $this->startTimestamp = Carbon::now()->startOfDay()->getTimestamp();
        $this->endTimestamp = Carbon::now()->endOfDay()->getTimestamp();
    }

    public function pointLike($uid, $module, $child, $target)
    {

        $likeCount = LikeModel::where('uid', $uid)
            ->where('module', $module)
            ->where('child', $child)
            ->where('target_id', $target)
            ->where('created_at', '>=', $this->startTimestamp)
            ->where('created_at', '<=', $this->endTimestamp)
            ->count();
        if ($likeCount >= 5) {
            api_exception(Service::LK_USER_HAS_BEEN_LIKE, '一天只能点赞5次哦');
        }
        $model = Module::getModuleModel($module);
        $file = $model::where('module', $child)->where('id', $target)->first();
        if (!isset($file)) {
            api_exception(Service::LK_FILE_NOT_FOUND);
        }
        $newLike = new LikeModel();
        $newLike->uid = $uid;
        $newLike->module = $module;
        $newLike->child = $child;
        $newLike->target_id = $target;
        $newLike->save();
        return api_response(Service::SUCCESS);
    }
}