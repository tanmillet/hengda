<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{$seo->desc}}"/>
    <meta name="keywords" content="{{$seo->keyw}}"/>
    <title>{{$seo->title}}</title>
    <link rel="stylesheet" type="text/css" href="{{getSrcUrl()}}/front/css/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{getSrcUrl()}}/front/css/style.css"/>
    <script>
        var _hmt = _hmt || [];
        (function() {

            var hm = document.createElement("script");

            hm.src = "https://hm.baidu.com/hm.js?556766d271ac97a700da73b95ead933e";

            var s = document.getElementsByTagName("script")[0];

            s.parentNode.insertBefore(hm, s);

        })();
    </script>
</head>

<body>
<div class="header">
    <div class="in-logo"><img src="{{getSrcUrl()}}/front/images/logo.png"></div>
    <div class="in-nav">
        <ul>
            @foreach($programa as $key=>$pro)
                <li class="{{(($key + 1) == count($programa)) ? 'mar' : ''}}"><a href="{{$pro['url']}}" style="{{ isUrl($pro['url']) ? 'border-bottom: solid 2px #599bf8; color: #599bf8;' : '' }}">{{$pro['name']}}</a></li>
            @endforeach
                <li class="link"><a class="{{isset($lang) && ($lang == 'en') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/zh">中文版</a></li>
                <li class="link"><a class="{{isset($lang) && ($lang == 'zh') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/en">English</a></li>
        </ul>
    </div>
</div>
<div class="banner03" style="background: url({{$bannerUrl}}"></div>
<div class="page02 main">
    <div class="le" style="margin-bottom: 100px;">
        <ul>
            @forelse($productTypes as $key=>$productType)
                <li><a style="font-family: 微软雅黑;" class="{{$key == 0 ? 'focu' : ''}}" href="{{getRouteDeUrl()}}/product/{{$lang}}/{{$productType->id}}">{{$productType->name}}</a></li>
            @empty

            @endforelse

        </ul>
        {{--<div class="searchBox01">--}}
            {{--<form action="{{getRouteDeUrl()}}/product/{{$lang}}" method="post">--}}
                {{--<input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品 查询 ...' : 'product search ...' }}"  name="selProductName" value="">--}}
                {{--<input type="hidden" name="searchTag" value="searchTag">--}}
                {{--<button type="submit" value=""></button>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
    <div class="ri02">
        <div class="contactBox">
            <div class="box01">
                <h1>东莞市恒达布业有限公司</h1>
                <p>电话：0769-82001842/82779158</p>
                <p>传真：0769-82001843</p>
                <p>E-Mail：hendar@hendar.com.cn</p>
                <p>地址：东莞市塘厦镇莲湖狮头路102号（莲湖中心市场后面）</p>
            </div>
            <div class="box02" id="dituContent"></div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="main"><img src="{{getSrcUrl()}}/front/images/in-img03.jpg"></div>
</div>
{{--<div class="footer">--}}
    {{--<ul class="ul01 main">--}}
        {{--<li class="li01"><img src="{{getSrcUrl()}}/front/images/footer-logo.png"></li>--}}
        {{--<li class="line"></li>--}}
        {{--<li class="li02">--}}
            {{--<div class="text">--}}
                {{--<p class="p01">{{isset($footer['address']) ? $footer['address'] : ''}}</p>--}}
                {{--<p class="p02">{{isset($footer['tel']) ? $footer['tel'] : ''}}</p>--}}
                {{--<p class="p03">{{isset($footer['email']) ? $footer['email'] : ''}}</p>--}}
            {{--</div>--}}
        {{--</li>--}}
        {{--<li class="line"></li>--}}
        {{--<li class="li03">--}}
            {{--<span>{{isset($footer['copyright']) ? $footer['copyright'] : ''}}</span>--}}
            {{--<em>Copyright © 2017 DongGuan Hendar Cloth Co., Ltd. </em>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</div>--}}
<script type="text/javascript" src="http://api.map.baidu.com/api?ak=92F24dq9l2AgKwphMdinsg8jGyQYCT64&v=1.1&services=true"></script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(114.111837,22.82896);//定义一个中心点坐标
        map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
        var marker = new BMap.Marker(point);// 创建标注
        map.addOverlay(marker);             // 将标注添加到地图中
        window.map = map;//将map变量存储在全局
    }
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
        var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_PAN});
        map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
        var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
        map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
        var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
        map.addControl(ctrl_sca);
    }
    initMap();//创建和初始化地图
</script>
</body>

</html>