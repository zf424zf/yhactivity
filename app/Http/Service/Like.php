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
use Illuminate\Support\Facades\Redis;

class Like
{
    public $startTimestamp;
    public $endTimestamp;

    public function __construct()
    {
        date_default_timezone_set('PRC');
        $this->startTimestamp = Carbon::now()->startOfDay()->getTimestamp();
        $this->endTimestamp = Carbon::now()->endOfDay()->getTimestamp();
    }

    public function pointLike($uid, $module, $child, $target)
    {

         $likeCount = $this->userLikeCount($uid,$module,$target);
        if ($likeCount >= 10) {
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
        $isSave = $newLike->save();
        if($isSave){
           $this->updateUserLikeCount($uid,$module,$target);
        }
        return api_response(Service::SUCCESS);
    }

    public function userLikeCount($uid, $module, $target){
        //当前用户指定图片/视频点赞数
        $key = cache_key('user.like',$uid,$module,$target);
        $count =  Redis::get($key);
        return empty($count) ? 0 : $count;
    }

    public function updateUserLikeCount($uid, $module,  $target){
        $expire = Carbon::now()->endOfDay()->timestamp - Carbon::now()->timestamp;
         $key = cache_key('user.like',$uid,$module,$target);
        if(empty(Redis::get($key))){
            Redis::setex($key,$expire,1);
            return;
        }
         Redis::incr($key);
    }
}