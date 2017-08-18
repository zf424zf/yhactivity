<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/18
 * Time: 17:45
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class VideoInfoRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'id.required'=>Service::VIDEO_ID_REQUIRED,
            'id.integer'=>Service::VIDEO_ID_VALUE_ERR,
            'id.exists'=>Service::VIDEO_ID_NOT_FOUND,
            'uid.integer'=>Service::VIDEO_UID_VALUE_ERR,
            'uid.exists'=>Service::VIDEO_UID_NOT_FOUND
        ];
    }

    public function rules()
    {
        return [
            'id'=>'required|integer|exists:video,id',
            'uid'=>'integer|exists:users,id'
        ];
    }
}