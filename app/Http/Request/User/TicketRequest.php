<?php

namespace App\Http\Requests\User;

use App\Http\Request\ApiRequest;
use App\Http\Service\Service;

class TicketRequest extends ApiRequest
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
            'code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => Service::WX_CODE_NOT_EXISTS,
        ];
    }
}
