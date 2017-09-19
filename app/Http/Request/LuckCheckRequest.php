<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/19
 * Time: 13:46
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class LuckCheckRequest extends ApiRequest
{

    public function messages()
    {
        // TODO: Implement messages() method.
        return [
            'uid.required'=>Service::UID_REQUIRED,
            'uid.exists'=>Service::USER_NOT_FOUND
        ];
    }

    public function rules()
    {
        // TODO: Implement rules() method.
        return [
            'uid'=>'required|exists:users,id'
        ];
    }
}