<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group([], function ($router) {
    $router->get('/', 'FrontController@index1');
});

Route::group([
    'prefix' => 'hdadmin',
], function ($router) {
    $router->match(array('GET', 'POST'), '/main', 'AdminController@main');
    $router->match(array('GET', 'POST'), '/login', 'AdminController@dologin');
    $router->match(array('GET', 'POST'), '/logout', 'AdminController@dologout');
    //操作新闻类型
    $router->match(array('GET', 'POST'), '/news/types', 'NewsController@newsTyeps');
    $router->match(array('GET', 'POST'), '/news/typeup/{newstypeid?}', 'NewsController@oneNewsType');
    $router->match(array('GET', 'POST'), '/news/typedel', 'NewsController@delNewsType');
    $router->match(array('GET', 'POST'), '/news/lists', 'NewsController@news');
    $router->match(array('GET', 'POST'), '/news/up/{newsid?}', 'NewsController@oneNews');
    $router->match(array('GET', 'POST'), '/news/del', 'NewsController@delNews');

    //操作产品类型
    $router->match(array('GET', 'POST'), '/product/types', 'ProductController@productTyeps');
    $router->match(array('GET', 'POST'), '/product/typeup/{productypeid?}', 'ProductController@oneProductType');
    $router->match(array('GET', 'POST'), '/product/typedel', 'ProductController@delProductType');
    $router->match(array('GET', 'POST'), '/product/lists', 'ProductController@products');
    $router->match(array('GET', 'POST'), '/product/up/{productid?}', 'ProductController@oneProduct');
    $router->match(array('GET', 'POST'), '/product/del', 'ProductController@delProduct');

    //幻灯片管理
    $router->match(array('GET', 'POST'), '/banner/lists', 'BannerController@banners');
    $router->match(array('GET', 'POST'), '/banner/up/{bannerid?}', 'BannerController@oneBanner');
    $router->match(array('GET', 'POST'), '/banner/del', 'BannerController@delBanner');

    //操作接口
    $router->match(array('GET', 'POST'), '/productypes', 'ProductController@getProductTypeByLang');
    $router->match(array('GET', 'POST'), '/uploadfile', 'ProductController@upLoadFile');

    //基础配置设置
    $router->match(array('GET', 'POST'), '/baseset', 'AdminController@baseset');
    $router->match(array('GET', 'POST'), '/seo/up', 'AdminController@upSeoInfo');

    //网上咨询
    $router->match(array('GET', 'POST'), '/consult/lists', 'AdminController@consults');
    $router->match(array('GET', 'POST'), '/consult/up/{consultid?}', 'AdminController@oneConsult');
});

Route::group([], function ($router) {
    $router->match(array('GET', 'POST'), '/index/{lang}', 'FrontController@index');
    $router->match(array('GET', 'POST'), '/about/{lang}', 'FrontController@about');
    $router->match(array('GET', 'POST'), '/news/{lang}/{newsid?}', 'FrontController@news');
    $router->match(array('GET', 'POST'), '/newsinfo/{lang}/{newsid}', 'FrontController@oneNews');
    $router->match(array('GET', 'POST'), '/online/{lang}', 'FrontController@online');
    $router->match(array('GET', 'POST'), '/contact/{lang}', 'FrontController@contact');
    $router->match(array('GET', 'POST'), '/product/{lang}/{productypeid?}', 'FrontController@products');
    $router->match(array('GET', 'POST'), '/productinfo/{lang}/{productid}', 'FrontController@oneProduct');
    $router->match(array('GET', 'POST'), '/consult/{lang}', 'FrontController@oneConsult');
});