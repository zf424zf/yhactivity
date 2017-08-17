<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 22:10
 */

namespace App\Http\Request;


use App\Http\Api\Module;
use App\Http\Api\PhotoChild;
use App\Http\Service\Service;

class ListRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'module.required' => Service::LIST_MODULE_REQUIRED,
            'module.in' => Service::LIST_MODULE_VALUE_ERR,
            'child.in' => Service::LIST_CHILD_VALUE_ERR,
            'sort.in' => Service::LIST_SORT_VALUE_ERR,
            'order.in' => Service::LIST_ORDER_VALUE_ERR,
            'uid.integer' => Service::UID_TYPE_ERR
        ];
    }

    public function rules()
    {
        $moduleRef = new \ReflectionClass(Module::class);
        $childRef = new \ReflectionClass(PhotoChild::class);
        return [
            'module' => 'required|in:' . implode(',', $moduleRef->getConstants()),
            'child' => 'in:' . implode(',', $childRef->getConstants()),
            'sort' => 'in:' . implode(',', ['new', 'like']),
            'order' => 'in:' . implode(',', ['desc', 'asc']),
            'uid' => 'integer'
        ];
    }
}