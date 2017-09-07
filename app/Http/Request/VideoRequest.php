<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 11:26
 */

namespace App\Http\Request;


use App\Http\Api\VideoChild;
use App\Http\Service\Service;

class VideoRequest extends ApiRequest
{

    public function messages()
    {
        return [
            'uid.required' => Service::UID_REQUIRED,
            'uid.integer' => Service::UID_TYPE_ERR,
            'module.required' => Service::VIDEO_MODULE_REQUIRED,
            'module.in' => Service::VIDEO_MODULE_VALUE_ERR,
            'path.required' => Service::VIDEO_PATH_REQUIRED,
            'info.json' => Service::VIDEO_INFO_MUST_JSON,
            'qid.required'=>Service::VIDEO_QID_REQUIRED,
            'qid.exists'=>Service::VIDEO_QID_NOT_EXISTS
        ];
    }

    public function rules()
    {
        $childRef = new \ReflectionClass(VideoChild::class);
        return [
            'uid' => 'required|integer',
            'module' => 'required|in:' . implode(',', $childRef->getConstants()),
            'path' => 'required',
            'info' => 'json',
            'qid'  =>'required|exists:question,id'
        ];
    }
}