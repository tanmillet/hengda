<?php
namespace  Requests;
/**
 * Class UpNewsTypeValidator
 * User: Terry Lucas
 * @package App\Http\Controllers\Admin\Requests
 */
class UpBannerValidator extends FormRequest
{

    public function getValidateRules()
    {
        return
            [
                'bannerzhTitle' => 'required',
            ];
    }


    public function getValidateReturnMsg()
    {
        return
            [
                'bannerzhTitle' => '幻灯片标题',
            ];
    }

}