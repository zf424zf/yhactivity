<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 16:37
 */

namespace App\Http\Service;


use App\Http\Models\ImageModel;

class Image
{
    public function addImage($uid,$module,$path,$info='')
    {
        $info = is_array($info) ? implode(',',$info) :$info;
        $model = new ImageModel();
        $model->uid = $uid;
        $model->module = $module;
        $model->path = $path;
        $model->picInfo = $info;
        $model->save();
        return $model->with('users')->first();
    }
}