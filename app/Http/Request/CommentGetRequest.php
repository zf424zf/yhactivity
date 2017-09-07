<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 22:29
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class CommentGetRequest extends ApiRequest
{

    public function messages()
    {
        // TODO: Implement messages() method.
        return [
            'channel.required' => Service::LIVE_ID_REQUIRED
        ];
    }

    public function rules()
    {
        // TODO: Implement rules() method.
        return [
            'channel' => 'required'
        ];

    }
}