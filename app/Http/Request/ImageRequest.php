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
        return [
            'type.required'=>Service::IMAGE_TYPE_REQUIRED,
            'type.in'=>Service::IMAGE_TYPE_VALUE_ERR,
            'module.required' => Service::IMAGE_MODULE_REQUIRED,
            'module.in' => Service::IMAGE_MODULE_VALUE_ERR,
            'path.required' => Service::IMAGE_PATH_REQUIRED,
            'info.json' => Service::IMAGE_INFO_MUST_JSON,
            'origin.required_if'=>Service::IMAGE_ORIGIN_REQUIRED,
            'label.size'=>Service::IMAGE_LABEL_SIZE_ERR,
            'originLabel.size'=>Service::IMAGE_ORIGIN_LABEL_SIZE_ERR
        ];
    }

    public function rules()
    {
        $childRef = new \ReflectionClass(PhotoChild::class);
        return [
            'type' => 'required|in:0,1',
            'module' => 'required|in:' . implode(',', $childRef->getConstants()),
            'path' => 'required',
            'info' => 'json',
            'origin'=>'required_if:type,1|integer',
            'label'=>'max:10',
            'originLabel'=>'max:10'
        ];
    }
}