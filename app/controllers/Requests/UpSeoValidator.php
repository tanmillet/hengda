<?php

namespace  Requests;

/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpSeoValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'seoId' => 'required',
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'seoId' => 'SEO唯一标识',
            ];
    }

}