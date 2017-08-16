<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 21:33
 */

namespace App\Http\Api;


use App\Http\Models\ImageModel;
use App\Http\Models\VideoModel;
use App\Http\Service\Service;

class Module
{
    const PHOTO_MODULE = 1;
    const VIDEO_MODULE = 2;

    public static function getModuleModel($module){
        if($module == self::PHOTO_MODULE){
            return ImageModel::class;
        }else if($module == self::VIDEO_MODULE){
            return VideoModel::class;
        }else{
            api_exception(Service::LK_MODULE_VALUE_ERR);
        }
    }
}