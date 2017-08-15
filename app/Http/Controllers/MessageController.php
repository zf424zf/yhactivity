<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:28
 */

namespace App\Http\Controllers;


use App\Http\Request\CommentGetRequest;
use App\Http\Request\CommentRequest;
use App\Http\Service\Message;
use App\Http\Service\Service;
class MessageController extends Controller
{
    public function submit(CommentRequest $request)
    {
        return (new Message())->submit(
            $request->get('uid'),
            $request->get('content'),
            $request->get('channel')
        );
    }

    public function messageList(CommentGetRequest $request)
    {
        $data = (new Message())->getMessage($request->get('msgId', ''));
        return api_response(Service::SUCCESS, $data);
    }
}