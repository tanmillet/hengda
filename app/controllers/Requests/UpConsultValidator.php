<?php

namespace  Requests;

/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpConsultValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'companyName' => 'required',
                'userName' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'productName' => 'required',
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'companyName' => '公司名称',
                'userName' => '客户名称',
                'phone' => '联系方式',
                'email' => '邮箱',
                'productName' => '产品名称',
            ];
    }

}