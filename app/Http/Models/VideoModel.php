<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 22:16
 */

namespace App\Http\Models;


use App\Http\Api\Module;

class VideoModel extends BaseModel
{
    protected $table = 'video';

    protected $appends = ['likeCnt'];

    public function users()
    {
        return $this->hasOne('App\Http\Models\UserModel', 'id', 'uid');
    }

    public function question()
    {
        return $this->hasOne('App\Http\Models\QuestionModel', 'id', 'qid');
    }

    public function getLikeCntAttribute()
    {
        $like = LikeModel::where('module', Module::VIDEO_MODULE)->where('target_id', $this->id)->count();
        return ($like + 10);
    }
}