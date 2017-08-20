<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/19
 * Time: 13:54
 */

namespace App\Http\Request;


use App\Http\Api\PhotoChild;
use App\Http\Service\Service;

class ChallengeRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'module.required' => Service::IMAGE_MODULE_REQUIRED,
            'module.in' => Service::IMAGE_MODULE_VALUE_ERR,
            'page.integer'=>Service::PAGE_VALUE_ERR,
            'pagesize.integer'=>Service::PAGE_SIZE_VALUE_ERR
        ];
    }

    public function rules()
    {
        $childRef = new \ReflectionClass(PhotoChild::class);
        return [
            'module' => 'integer|in:' . implode(',',$childRef->getConstants()),
            'page' => 'integer',
            'pagesize' => 'integer'
        ];
    }
}