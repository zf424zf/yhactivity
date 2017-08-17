<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 22:16
 */

namespace App\Http\Models;


class VideoModel extends BaseModel
{
    protected $table = 'video';

    public function users(){
        return $this->hasOne('App\Http\Models\UserModel','uid','uid');
    }
}