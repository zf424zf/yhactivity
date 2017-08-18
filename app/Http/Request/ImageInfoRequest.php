<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/18
 * Time: 14:47
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class ImageInfoRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'id.required'=>Service::IMAGE_ID_REQUIRED,
            'id.integer'=>Service::IMAGE_ID_VALUE_ERR,
            'id.exists'=>Service::IMAGE_ID_NOT_FOUND,
            'uid.integer'=>Service::IMAGE_UID_VALUE_ERR,
            'uid.exists'=>Service::IMAGE_UID_NOT_FOUND
        ];
    }

    public function rules()
    {
        return [
            'id'=>'required|integer|exists:image,id',
            'uid'=>'integer|exists:users,id'
        ];
    }
}