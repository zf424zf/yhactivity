<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:47
 */

namespace App\Http\Models;


class CommentModel extends BaseModel
{
    protected $table = 'comment';

    public function users(){
        return $this->hasOne('App\Http\Models\UserModel','uid','uid');
    }
}