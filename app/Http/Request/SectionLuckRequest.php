<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/3
 * Time: 10:46
 */

namespace App\Http\Request;


use App\Http\Service\Service;

class SectionLuckRequest extends ApiRequest
{

    public function messages()
    {
        // TODO: Implement messages() method.
        return [
            'section.required' => Service::LUCKY_SECTION_REQUIRED
        ];
    }

    public function rules()
    {
        // TODO: Implement rules() method.
        return [
            'section' => 'required'
        ];
    }
}