<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 16:37
 */

namespace App\Http\Service;


use App\Http\Api\Module;
use App\Http\Models\ImageModel;
use App\Http\Models\LikeModel;

class Image
{
    public function addImage($uid, $module, $path, $type, $info = '', $originId = 0, $label = '', $originLabel = '')
    {
//        $uid = array_get(session('user'),'id');
//        if(empty($uid)){
//            api_exception(Service::TOKENERROR);
//        }
        if ($type == 1) {
            if (!empty($originId)) {
                //查找左图
                $left = ImageModel::where('id', $originId)->where('type', 0)->first();
                if (!$left) {
                    api_exception(Service::IMAGE_LEFT_PIC_NOT_FOUND);
                }
                if (empty($left->label) && !empty($originLabel)) {
                    $left->label = $originLabel;
                }
                $left->save();
            } else {
                api_exception(Service::IMAGE_ORIGIN_REQUIRED);
            }
        }
        if(!empty($info)){
            $info = is_array($info) ? implode(',', $info) : $info;
        }
        $model = new ImageModel();
        $model->type = $type;
        $model->uid = $uid;
        $model->module = $module;
        $model->path = $path;
        $model->picInfo = $info;
        $model->origin = $type == 0 ? 0 : $originId;
        $model->label = $label;
        $model->save();
        $data = ImageModel::where('id', $model->id)->with(['users', 'originInfo'])->first();
        if($type == 9){
            $haveChance = (new Luck())->checkUserTodayLuck($uid);
            if(empty($haveChance)){
                $data->haveChance = 0;
            }
            $data->haveChance = 1;
        }
        return $data;
    }

    /**
     * 晒单上传
     */
    public function shareImage($uid,$path,$info=''){
        $model = new ImageModel();
        $model->type = 9;
        $model->uid = $uid;
        $model->module = 9;
        $model->path = $path;
        $model->picInfo = $info;
        $model->save();
        return ImageModel::where('id', $model->id)->with(['users'])->first();
    }

    public function imageInfo($id, $uid = '')
    {
        $canLike = 0;
        $data = ImageModel::where('id', $id)/*->where('type',1)*/->with(['users', 'originInfo'])->first();
        if (!$data) {
            api_exception(Service::IMAGE_NOT_FOUND);
        }
        if (!empty($uid)) {
            $likeCount = (new Like())->userLikeCount($uid,Module::PHOTO_MODULE,$id);
            if ($likeCount < 5) {
                $canLike = 1;
            }
        }
        $likeCnt = LikeModel::where('module',Module::PHOTO_MODULE)
            ->where('target_id',$id)->count();
        $data->canLike = $canLike;
        $data->cnt = $likeCnt;
        return $data;
    }

    public function challengeList($module, $page, $pagesize)
    {

        $data = ImageModel::orderBy('id','asc')->with('users')->where('type', 0)
            ->where('module', $module)
            ->paginate($pagesize)->toArray();
        return $data;
    }

    public function challengeDetail($id)
    {
        $data = ImageModel::with('users')
            ->where('id', $id)->first()->toArray();
        return $data;
    }
}