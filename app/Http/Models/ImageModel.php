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
        return $this->hasOne('App\Http\Models\UserModel','uid','uid');
    }
}