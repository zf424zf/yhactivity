<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/24
 * Time: 11:38
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class ShareImageRequest extends ApiRequest
{
    public function messages()
    {
        return [
            'uid.required' => Service::UID_REQUIRED,
            'uid.integer' => Service::UID_TYPE_ERR,
            'path.required' => Service::IMAGE_PATH_REQUIRED,
            'info.json' => Service::IMAGE_INFO_MUST_JSON,
        ];
    }

    public function rules()
    {
        return [
            'uid' => 'required|integer',
            'path' => 'required',
            'info' => 'json',
        ];
    }
}