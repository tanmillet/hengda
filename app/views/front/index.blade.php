<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{$seo->desc}}"/>
    <meta name="keywords" content="{{$seo->keyw}}"/>
    <title>{{$seo->title}}</title>
    <link rel="stylesheet" type="text/css" href="{{getSrcUrl()}}/front/css/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{getSrcUrl()}}/front/css/style.css"/>
    <style type="text/css">
        body, html, div, ul, li, h1, h2, h3, h4, h5, h6, span, em, i, dl, dt, dd {
            padding: 0;
            margin: 0;
            font-size: 12px;
            font-family: "微软雅黑";
            color: #333
        }
    </style>
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
                <li class="{{(($key + 1) == count($programa)) ? 'mar' : ''}}"><a href="{{$pro['url']}}"
                                                                                 style="{{ isUrl($pro['url']) ? 'border-bottom: solid 2px #599bf8; color: #599bf8;' : '' }}">{{$pro['name']}}</a>
                </li>
            @endforeach
                <li class="link"><a class="{{isset($lang) && ($lang == 'en') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/zh">中文版</a></li>
                <li class="link"><a class="{{isset($lang) && ($lang == 'zh') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/en">English</a></li>

        </ul>
    </div>
</div>
<!-- Swiper -->
<div class="swiper-container bannerBox">
    <div class="swiper-wrapper">
        @forelse($banners as $banner)
            <div class="swiper-slide"
                 style="background: url({{isset($banner->img) ? $banner->img : ''}}) center center no-repeat;"></div>
        @empty
            <div class="swiper-slide bannerSub01"></div>
        @endforelse
    </div>
    <div class="swiper-pagination"></div>
</div>
<!-- Swiper end-->
<div class="page01">
    <div class="main"><img src="{{getSrcUrl()}}/front/images/in-img02.jpg"></div>
    <div class="box02">
        <dl class="dl02">
            <dt class="in-tite">
            <h2>Our Product</h2>
            <p style="display: block">
                <span>我们的产品</span>
                <em><!--修饰块--></em>
            </p>
            </dt>
            <dd>
                <ul class="ul02 clear">

                    @forelse($productTypes as $productType)
                        <li>
                            <div class="title">
                                <a href="{{getRouteDeUrl()}}/product/{{$lang}}/{{$productType->id}}">
                                    <div class="img">
                                        <img src="{{isset($productType->type_img) ? $productType->type_img : ''}}"
                                             title="产品" style="width: 101px;height: 101px;">
                                    </div>
                                </a>
                                <div class="shadow"></div>
                            </div>
                            <div class="text">
                                <a href="{{getRouteDeUrl()}}/product/{{$lang}}/{{$productType->id}}"
                                   style="height: 80px;">
                                    <span style="font-weight: bold;color: white;font-size: 13px;">{{$productType->typename}}</span>
                                    @if(isset($productType->title))
                                        {{(mb_strlen($productType->title , 'UTF8') >= 70) ?
                                        mb_substr($productType->title,0,70,'UTF8') . '...'
                                        : $productType->title}}
                                    @endif
                                </a>
                            </div>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </dd>
        </dl>
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
<script src="{{getSrcUrl()}}/front/js/swiper.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplayDisableOnInteraction: false,
        autoplay: 5000,
        loop: true,
    });
</script>
</body>

</html>