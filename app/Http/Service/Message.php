<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:31
 */

namespace App\Http\Service;


use App\Http\Models\CommentModel;
use App\Http\Models\UserModel;

class Message
{
    public function submit($uid,$content,$channel){
        $user = UserModel::where('uid',$uid)->first();
        if(!isset($user)){
            return api_response(Service::MSG_USER_NOT_FOUND,'用户不存在，不能发表留言');
        }
        $comment = new CommentModel();
        $comment->uid = $uid;
        $comment->content = $content;
        $comment->channel = $channel;
        $isSave = $comment->save();
        if($isSave){
            return api_response(Service::SUCCESS,$comment->users());
        }
        return api_response(Service::MSG_SAVE_ERR);
    }

    public function getMessage($msgId = ''){
        $model = CommentModel::with('users')->orderBy('id','desc');
        if(!empty($msgId)){
            $model->where('id','>',$msgId);
        }
        return $model->take(10)->get();
    }
}