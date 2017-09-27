<?php
return [
    //页面尾部配置
    'footer' => [
        'address' => '地址:东莞市塘厦镇莲湖狮头路102号',
        'tel' => 'Tel:0769-82001842   82779158  ',
        'email' => 'E-Mail:hendar@hendar.com.cn',
        'copyright' => '东莞市恒达布业有限公司  版权所有',
    ],

    //配置中文网站
    'zh' => [

        //页面头部
        'programa' => [
            [
                'sort' => 1,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/index/zh',
                'name' => "首页",
            ], [
                'sort' => 2,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/about/zh',
                'name' => "关于恒达",
            ], [
                'sort' => 3,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/news/zh',
                'name' => "新闻动态",
            ], [
                'sort' => 4,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/product/zh',
                'name' => "产品展示",
            ], [
                'sort' => 5,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/online/zh',
                'name' => "网上咨询",
            ], [
                'sort' => 6,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/contact/zh',
                'name' => "联系我们",
            ]
        ],
    ],

    //配置英文网站
    'en' => [
        'programa' => [
            [
                'sort' => 1,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/index/en',
                'name' => "Index",
            ], [
                'sort' => 2,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/about/en',
                'name' => "About",
            ], [
                'sort' => 3,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/news/en',
                'name' => "News Lasts",
            ], [
                'sort' => 4,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/product/en',
                'name' => "Product Display",
            ], [
                'sort' => 5,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/online/en',
                'name' => "Online Consultation",
            ], [
                'sort' => 6,
                'stuats' => true,
                'url' => getRouteDeUrl() . '/contact/en',
                'name' => "Contact",
            ]
        ],
    ]
];
