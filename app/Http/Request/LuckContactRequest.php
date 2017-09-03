<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/3
 * Time: 15:56
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class LuckContactRequest extends ApiRequest
{

    public function messages()
    {
        // TODO: Implement messages() method.
        return [
            'win_id.required' => Service::LUCKY_WIN_ID_REQUIRED,
            'win_id.integer' => Service::LUCKY_WIN_ID_ERR,
            'win_id.exists' => Service::LUCKY_WIN_ID_NOT_EXIST,
            'name.required' => Service::LUCKY_CONTACT_NAME_REQUIRED,
            'tel.required' => Service::LUCKY_CONTACT_TEL_REQUIRED,
            'address.required' => Service::LUCKY_CONTACT_ADDRESS_REQUIRED
        ];
    }

    public function rules()
    {
        // TODO: Implement rules() method.
        return [
            'win_id' => 'required|integer|exists:win,id',
            'name' => 'required',
            'tel' => 'required',
            'address' => 'required'
        ];
    }
}