<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 11:22
 */

namespace App\Http\Service;



use App\Http\Models\VideoModel;

class Video
{

    public function add($uid, $module, $path, $info)
    {
        $info = is_array($info) ? implode(',', $info) : $info;
        $model = new VideoModel();
        $model->uid = $uid;
        $model->module = $module;
        $model->path = $path;
        $model->videoinfo = $info;
        $model->save();
        return $model->with('users')->first();
    }


}