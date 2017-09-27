<?php

namespace  Requests;

/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpProductTypeValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'productTypesZhName' => 'required',
                'productTypesEnName' => 'required',
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'productTypesZhName' => '产品类型中文名称',
                'productTypesEnName' => '产品类型英文名称',
            ];
    }

}