<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/11
 * Time: 21:46
 */

namespace App\Http\Request;


use App\Http\Api\PhotoChild;
use App\Http\Service\Service;

class RemoveRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'uid.required'=>Service::UID_REQUIRED,
            'uid.extends'=>Service::UID_TYPE_ERR,
            'uid.integer'=>Service::UID_TYPE_ERR,
            'module.required'=>Service::LIST_MODULE_REQUIRED,
            'module.in'=>Service::MODULE_ERROR,
            'target.required'=>Service::LK_TARGET_REQUIRED,
            'target.integer'=>Service::LK_TARGET_VALUE_ERR
        ];
    }

    public function rules()
    {
        $childRef = new \ReflectionClass(PhotoChild::class);
        return [
            'uid'=>'required|exists:users,id|integer',
            'module' => 'required|in:' . implode(',', $childRef->getConstants()),
            'target'=>'required|integer'
        ];
    }
}