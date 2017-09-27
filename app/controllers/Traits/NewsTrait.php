<?php
namespace  Traits;

/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/4
 * Time: 14:03
 */
trait NewsTrait
{
    public function getNewsType()
    {
        return \NewsTypes::where('news_type_status', '=', 0)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }
}