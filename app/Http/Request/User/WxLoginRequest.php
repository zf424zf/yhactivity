<?php

namespace App\Http\Request\User;

use App\Http\Request\ApiRequest;
use App\Http\Service\Service;

class WxLoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'encrypted_data' => 'required',
            'iv'             => 'required',
        ];
    }

    public function messages()
    {
        return [
            'encrypted_data.required' => Service::WX_ENCRYPT_DATA_NOT_EXISTS,
            'iv.required'       => Service::WX_IV_NOT_EXISTS,
        ];
    }
}
