<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/22
 * Time: 17:40
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class LuckRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'uid.required' => Service::UID_REQUIRED,
            'uid.integer' => Service::UID_TYPE_ERR,
            'path.required' => Service::IMAGE_PATH_REQUIRED
        ];
    }

    public function rules()
    {
        return [
            'uid' => 'required|integer',
            'path' => 'required'
        ];
    }
}