<?php

namespace  Requests;

/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpNewsValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'newsTitle' => 'required',
                'newsKeywords' => 'required',
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'newsTitle' => '新闻标题',
                'newsKeywords' => '新闻关键字',
            ];
    }

}