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
    public function addImage($uid, $module, $path, $type, $info = '', $originId=0, $label = '', $originLabel = '')
    {
        if($type == 1) {
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
        $info = is_array($info) ? implode(',', $info) : $info;
        $model = new ImageModel();
        $model->type = $type;
        $model->uid = $uid;
        $model->module = $module;
        $model->path = $path;
        $model->picInfo = $info;
        $model->origin = $type == 0 ? 0 : $originId;
        $model->label = $label;
        $model->save();
        return ImageModel::where('id',$model->id)->with(['users','originInfo'])->first();
    }

    public function imageInfo($id,$uid){
        $canLike = 0;
        $data = ImageModel::where('id',$id)->with(['users','originInfo'])->first();
       if(!$data){
           api_exception(Service::IMAGE_NOT_FOUND);
       }
       if(!empty($uid)){
           $likeCount = LikeModel::where('uid',$uid)
               ->where('module',Module::PHOTO_MODULE)
               ->where('child',$data->module)
               ->where('target',$data->id)
               ->count();
           if($likeCount < 5){
               $canLike = 1;
           }
       }
       $data->canLike = $canLike;
       return $data;
    }
}