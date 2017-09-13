<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 18:05
 */

namespace App\Http\Models;


class ImageModel extends BaseModel
{
    protected $table = 'image';
    public function users(){
        return $this->belongsTo('App\Http\Models\UserModel','uid','id');
    }

    public function originInfo(){
        return $this->hasOne('App\Http\Models\ImageModel','id','origin');
    }
}