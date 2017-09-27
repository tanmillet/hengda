<?php

namespace  Requests;

/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpNewsTypeValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'newsTypesZhName' => 'required',
                'newsTypesEnName' => 'required',
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'newsTypesZhName' => '新闻类型中文名称',
                'newsTypesEnName' => '新闻类型英文名称',
            ];
    }

}