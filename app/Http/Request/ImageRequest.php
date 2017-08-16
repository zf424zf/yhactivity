<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 16:37
 */

namespace App\Http\Request;


use App\Http\Api\PhotoChild;
use App\Http\Service\Service;

class ImageRequest extends ApiRequest
{

    public function messages()
    {
        // TODO: Implement messages() method.
        return [
            'uid.required' => Service::UID_REQUIRED,
            'uid.integer' => Service::UID_TYPE_ERR,
            'module.required' => Service::IMAGE_MODULE_REQUIRED,
            'module.in' => Service::IMAGE_MODULE_VALUE_ERR,
            'path.required' => Service::IMAGE_PATH_REQUIRED,
            'info.json' => Service::IMAGE_INFO_MUST_JSON
        ];
    }

    public function rules()
    {
        $childRef = new \ReflectionClass(PhotoChild::class);
        // TODO: Implement rules() method.
        return [
            'uid' => 'required|integer',
            'module' => 'required|in:' . implode(',', $childRef->getConstants()),
            'path' => 'required',
            'info' => 'json'
        ];
    }
}