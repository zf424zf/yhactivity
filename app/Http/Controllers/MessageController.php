<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:28
 */

namespace App\Http\Controllers;


use App\Http\Requests\CommentRequest;
use App\Http\Service\Message;

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
}