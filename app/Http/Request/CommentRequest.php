<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:59
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class CommentRequest extends ApiRequest
{

    public function messages()
    {
        // TODO: Implement messages() method.
        return [
            'uid.required'=>Service::UID_REQUIRED,
            'uid.integer' => Service::UID_TYPE_ERR,
            'channel.required'=>Service::MSG_CHANNEL_REQUIRED,
            'content.required'=>Service::MSG_CONTENT_REQUIRED,
            'content.max'=>Service::MSG_CONTENT_SIZE_ERROR
        ];
    }

    public function rules()
    {
        // TODO: Implement rules() method.
        return [
            'uid'=>'required|integer',
            'channel'=>'required',
            'content'=>'required|max:256'
        ];
    }
}