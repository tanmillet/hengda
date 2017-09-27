<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ErrorController extends BaseController
{
    //
    public function error404()
    {
        return '404';
    }
}
