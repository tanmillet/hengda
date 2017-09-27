<?php
if (!function_exists('config')) {
    function config($key)
    {
        return \Illuminate\Support\Facades\Config::get($key);
    }
}

if (!function_exists('view')) {
    /**
     * @param $path
     * @param array $data
     * @return mixed
     */
    function view($path, array $data = [])
    {
        return \Illuminate\Support\Facades\View::make($path, $data);
    }
}

if (!function_exists('getAsysConf')) {
    function getAsysConf($key = '')
    {
        $asys = config('asys');

        return (isset($asys[$key])) ? $asys[$key] : '';
    }
}


if (!function_exists('isUrl')) {
    function isUrl($compareUrl , $lang = 'zh')
    {
        $currentUrl = \Illuminate\Support\Facades\Request::getRequestUri();
        if(strstr($currentUrl , 'newsinfo')){
            $currentUrl = getRouteDeUrl() . '/news/' . $lang;
        }
        if(strstr($currentUrl , 'productinfo')){
            $currentUrl = getRouteDeUrl() . '/product/' . $lang;
        }

        $falg = false;
        if (is_string($compareUrl)) {
            $falg = ($currentUrl == $compareUrl) || (strstr($currentUrl, $compareUrl)) ? true : false;
        }

        if (is_array($compareUrl)) {
            $falg = (in_array($currentUrl, $compareUrl)) ? true : false;
            if (!$falg) {
                foreach ($compareUrl as $val) {
                    if (strstr($currentUrl, $val)) {
                        $falg = true;
                        break;
                    }
                }
            }
        }

        return $falg;
    }
}

if (!function_exists('getProductFeature')) {
    function getProductFeature()
    {
        return [
            1 => [
                'name' => '普通产品',
                'css' => 'color:#FF5722',
            ],
            2 => [
                'name' => '优惠产品',
                'css' => 'background-color: #1AA094;color: white',
            ],
        ];
    }
}


if (!function_exists('getPrograma')) {
    function getPrograma($lang = '')
    {
        if (empty($lang)) return config('fsys')['zh']['programa'];

        return config('fsys')[$lang]['programa'];
    }
}

if (!function_exists('getFooter')) {
    function getFooter()
    {
        return config('fsys')['footer'];
    }
}


if (!function_exists('getBannerLocations')) {
    function getBannerLocations()
    {
        return [
            'index' => '首页',
            'about' => '关于恒达',
            'news' => '新闻动态',
            'product' => '产品展示',
            'online' => '网上咨询',
            'contract' => '联系我们',
        ];
    }
}

if (!function_exists('getAboutMenus')) {
    function getAboutMenus($lang = 'zh')
    {
        return ($lang == 'zh') ? ['公司介绍', '经营理念', '生产设备', '企业资质', '我们的优势'] : ['Company Introduction', 'Business Philosophy', 'Production Equipment', 'Enterprise Qualification', 'Our Advantages'];
    }
}

if (!function_exists('getRouteDeUrl')) {
    function getRouteDeUrl()
    {
        $isAdd = false;
        return ($isAdd == true) ? '/newhd/public/index.php' : '';
    }
}

if (!function_exists('getSrcUrl')) {
    function getSrcUrl()
    {
        $isAdd = false;
        return ($isAdd == true) ? '/newhd/public' : '';
    }
}
