<?php

namespace  Requests;

/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpProductValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'productName' => 'required',
                'productKeywords' => 'required',
                'fileProductPath' => 'required'
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'productName' => '产品名称',
                'productKeywords' => '产品关键字',
                'fileProductPath' => '产品图片',
            ];
    }

}