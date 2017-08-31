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

class ChallengeDetailRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'id.required' => Service::IMAGE_ID_REQUIRED,
            'id.in' => Service::IMAGE_ID_NOT_FOUND
        ];
    }

    public function rules()
    {
        $childRef = new \ReflectionClass(PhotoChild::class);
        return [
            'module' => 'integer|in:' . implode(',',$childRef->getConstants()),
        ];
    }
}