<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 21:26
 */

namespace App\Http\Request;


use App\Http\Api\PhotoChild;
use App\Http\Api\Module;
use App\Http\Service\Service;

class LikeRequest extends ApiRequest
{

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'uid.required'=>Service::UID_REQUIRED,
            'uid.integer' => Service::UID_TYPE_ERR,
            'module.required'=>Service::LK_MODULE_REQUIRED,
            'module.in' => Service::LK_MODULE_VALUE_ERR,
            'child.required'=>Service::LK_CHILD_REQUIRED,
            'child.in' => Service::LK_CHILD_VALUE_ERR,
            'target.required'=>Service::LK_TARGET_REQUIRED,
            'target.exists'=>Service::LK_TARGET_VALUE_ERR

        ];
        // TODO: Implement messages() method.
    }

    public function rules()
    {
        $moduleRef = new \ReflectionClass(Module::class);
        $childRef = new \ReflectionClass(PhotoChild::class);
        return [
            'uid'=>'required|integer',
            'module'=>'required|in:'.implode(',',$moduleRef->getConstants()),
            'child' =>'required|in'.implode(',',$childRef->getConstants()),
            'target'=>'required|exists:like,target_id'
        ];
        // TODO: Implement rules() method.
    }
}