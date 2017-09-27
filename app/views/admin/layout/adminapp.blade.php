<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{getAsysConf('sysname')}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ getSrcUrl()}}/adminsrc/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="{{ getSrcUrl()}}/adminsrc/css/font_eolqem241z66flxr.css" media="all"/>
    <link rel="stylesheet" href="{{getSrcUrl()}}/adminsrc/css/main.css" media="all"/>
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main">
            <a href="#" class="logo">{{getAsysConf('sysname')}}</a>
            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <li class="layui-nav-item" mobile>
                    <a href="javascript:;"><i class="iconfont icon-loginout"></i> 退出</a>
                </li>
                <li class="layui-nav-item" pc>
                    <a href="javascript:;">
                        <img src="{{getSrcUrl()}}/adminsrc/images/face.jpg" class="layui-circle" width="35" height="35">
                        <cite>{{\Illuminate\Support\Facades\Session::get('username') }}</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{getRouteDeUrl()}}/hdadmin/logout"><i class="iconfont icon-shezhi1"
                                                                            data-icon="icon-shezhi1"></i><cite>退出</cite></a>
                        </dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
        <div class="user-photo">
            <a class="img" title="我的头像"><img src="{{getSrcUrl()}}/adminsrc/images/face.jpg"></a>
            <p>你好！<span class="userName">{{\Illuminate\Support\Facades\Session::get('username') }}</span>, 欢迎登录</p>
        </div>
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item {{(isUrl('/hdadmin/main') ? 'layui-this' : '')}}"><a
                            href="{{getRouteDeUrl()}}/hdadmin/main"><i
                                class="iconfont icon-computer" data-icon="icon-computer"></i><cite>恒达首頁</cite></a></li>
                <li class="layui-nav-item {{(isUrl('/hdadmin/baseset') ? 'layui-this' : '')}}"><a
                            href="{{getRouteDeUrl()}}/hdadmin/baseset"><i
                                class="iconfont icon-text" data-icon="icon-text"></i><cite>网站信息设置</cite></a></li>
                <li class="layui-nav-item {{(isUrl(['/hdadmin/banner/lists' , '/hdadmin/banner/up']) ? 'layui-this' : '')}}">
                    <a href="{{getRouteDeUrl()}}/hdadmin/banner/lists"><i
                                class="iconfont icon-text" data-icon="icon-text"></i><cite>幻灯片管理</cite></a></li>
                <li class="layui-nav-item {{(isUrl(['/hdadmin/consult/lists' , '/hdadmin/consult/up']) ? 'layui-this' : '')}}">
                    <a href="{{getRouteDeUrl()}}/hdadmin/consult/lists"><i
                                class="iconfont icon-text" data-icon="icon-text"></i><cite>网上咨询管理</cite></a></li>
                <li class="layui-nav-item {{(isUrl('/hdadmin/product') ? 'layui-nav-itemed' : '')}}"><a
                            href="javascript:;">
                        <i class="layui-icon" data-icon=""></i><cite>产品管理</cite><span
                                class="layui-nav-more"></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{getRouteDeUrl()}}/hdadmin/product/types"
                               class="{{(isUrl(['/hdadmin/product/types' , '/hdadmin/product/typeup' ,'/hdadmin/product/typedel']) ? 'layui-this' : '')}}"><i
                                        class="layui-icon"
                                        data-icon=""></i><cite>产品类型</cite></a></dd>
                        <dd><a href="{{getRouteDeUrl()}}/hdadmin/product/lists"
                               class="{{(isUrl(['/hdadmin/product/lists' , '/hdadmin/product/up' ,'/hdadmin/product/del']) ? 'layui-this' : '')}}"><i
                                        class="layui-icon"
                                        data-icon=""></i><cite>产品列表</cite></a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item {{(isUrl('/hdadmin/news') ? 'layui-nav-itemed' : '')}}"><a
                            href="javascript:;">
                        <i class="layui-icon" data-icon=""></i><cite>新闻管理</cite><span
                                class="layui-nav-more"></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{getRouteDeUrl()}}/hdadmin/news/types"
                               class="{{(isUrl(['/hdadmin/news/types' , '/hdadmin/news/typeup' ,'/hdadmin/news/typedel']) ? 'layui-this' : '')}}"><i
                                        class="layui-icon"
                                        data-icon=""></i><cite>新闻类型</cite></a></dd>
                        <dd><a href="{{getRouteDeUrl()}}/hdadmin/news/lists"
                               class="{{(isUrl(['/hdadmin/news/lists' , '/hdadmin/news/up' ,'/hdadmin/news/del']) ? 'layui-this' : '')}}"><i
                                        class="layui-icon"
                                        data-icon=""></i><cite>新闻列表</cite></a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div style="padding: 30px;">


            @yield('content')

        </div>

    </div>
    <!-- 底部 -->
    <div class="layui-footer footer">
        <p>copyright @2017</p>
    </div>
</div>
<script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/layui/layui.js"></script>
<script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/bodyTab.js"></script>
<script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/index.js"></script>
@yield('custscript')
</body>
</html>