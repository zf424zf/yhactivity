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
    public function submit($uid, $content, $channel)
    {
        $user = UserModel::where('id', $uid)->first();
        if (!isset($user)) {
            return api_response(Service::MSG_USER_NOT_FOUND, '用户不存在，不能发表留言');
        }
        $comment = new CommentModel();
        $comment->uid = $uid;
        $comment->content = $content;
        $comment->channel = $channel;
        $isSave = $comment->save();
        if ($isSave) {
            $ment = CommentModel::with('users')->where('id', $comment->id)->first();
            return api_response(Service::SUCCESS, $ment ? $ment->toArray() : []);
        }
        return api_response(Service::MSG_SAVE_ERR);
    }

    public function getMessage($channel, $msgId = '')
    {
        $model = CommentModel::with('users')->where('channel', $channel)->orderBy('id', 'desc');
        if (!empty($msgId)) {
            $model->where('id', '>', $msgId);
        }
        return $model->take(10)->get()->toArray();
    }
}