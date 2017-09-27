<?php
namespace Traits;

/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/4
 * Time: 14:03
 */
trait ProductTrait
{
    public function getProductType()
    {
        return \ProductTypes::where('type_status', '=', 0)
            ->orderBy('type_top', 'DESC')
            ->orderBy('type_sort', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function getProductFeatures()
    {
        return [
           '1' => '普通',
           '2' => '优惠',
        ];
    }
}