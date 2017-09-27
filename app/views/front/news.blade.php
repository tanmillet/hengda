<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{$seo->desc}}"/>
    <meta name="keywords" content="{{$seo->keyw}}"/>
    <title>{{$seo->title}}</title>
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
                <li class="{{(($key + 1) == count($programa)) ? 'mar' : ''}}"><a href="{{$pro['url']}}" style="{{ isUrl($pro['url'],$lang) ? 'border-bottom: solid 2px #599bf8; color: #599bf8;' : '' }}">{{$pro['name']}}</a></li>
            @endforeach
                <li class="link"><a class="{{isset($lang) && ($lang == 'en') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/zh">中文版</a></li>
                <li class="link"><a class="{{isset($lang) && ($lang == 'zh') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/en">English</a></li>
        </ul>
    </div>
</div>
<div class="banner04"  style="background: url({{$bannerUrl}}"></div>

<div class="page02 main">
    <div class="le">
        <ul>
            @forelse($newsTypes as $newsType)
                <li><a style="font-family: 微软雅黑;" class="{{($selNewsTypeId == $newsType->id) ? 'focu' : ''}}"
                       href="{{getRouteDeUrl()}}/news/{{$lang}}/{{$newsType->id}}">{{$newsType->name}}</a></li>
            @empty
            @endforelse
        </ul>
        {{--<div class="searchBox01">--}}
            {{--<form action="{{getRouteDeUrl()}}/product/{{$lang}}" method="post">--}}
                {{--<input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品 查询 ...' : 'product search ...' }}" value="">--}}
                {{--<button type="submit" value=""></button>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
    <div id="navTabBox" class="ri mar" style="padding-top:25px;">
        <div class="product" style="display: block">
            <ul class="ul02">
                @forelse($newsLists as $newsList)
                    <li>
                        <a href="{{getRouteDeUrl()}}/newsinfo/{{$lang}}/{{$newsList->id}}">
                            {{$newsList->news_title}}
                        </a>
                        <em></em>
                        <i>{{$newsList->publish_at}}</i>
                    </li>
                @empty
                    <li>
                        <a href="javascript:void 0;"> {{(isset($lang) && $lang=='en') ? 'Not release news' :'未发布对应新闻动态'}}</a>
                    </li>
                @endforelse
            </ul>
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
</body>

</html>