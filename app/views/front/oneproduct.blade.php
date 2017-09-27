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
                <li class="{{(($key + 1) == count($programa)) ? 'mar' : ''}}"><a href="{{$pro['url']}}" style="{{ isUrl($pro['url'] , $lang) ? 'border-bottom: solid 2px #599bf8; color: #599bf8;' : '' }}">{{$pro['name']}}</a></li>
            @endforeach
                <li class="link"><a class="{{isset($lang) && ($lang == 'en') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/zh">中文版</a></li>
                <li class="link"><a class="{{isset($lang) && ($lang == 'zh') ? '' : 'focu'}}" href="{{getRouteDeUrl()}}/index/en">English</a></li>
        </ul>
    </div>
</div>
<div class="banner03" style="background: url({{$bannerUrl}}"></div>
<div class="page02 main">
    <div class="le">
        <ul>
            @forelse($productTypes as $productType)
                <li><a style="font-family: 微软雅黑;" class="{{($productType->id == $product->product_type)? 'focu' : ''}}" href="{{getRouteDeUrl()}}/product/{{$lang}}/{{$productType->id}}">
                        @if(isset($productType->name))
                            {{(mb_strlen($productType->name , 'UTF8') >= 12) ?
                            mb_substr($productType->name,0,12,'UTF8') . '..'
                            : $productType->name}}
                        @endif
                    </a></li>
            @empty

            @endforelse

        </ul>
        <div class="searchBox01" style="padding-top: 40px;">
            <form action="{{getRouteDeUrl()}}/product/{{$lang}}" method="post">
                <input type="text" style="font-size: 12px;height: 30px;" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品 查询 ...' : 'product search ...' }}"  name="selProductName" value="">
                <input type="hidden" name="searchTag" value="searchTag" >
                <button type="submit" value="" style="height: 32px;"></button>
            </form>
        </div>
    </div>
    <div class="ri mar" id="page_cx" style="padding: 50px 100px 25px !important; width: 864px!important;line-height: 26px!important;">
        <?php echo htmlspecialchars_decode($product->product_content)?>
            <span style="padding: 0% 48%;"><a href="{{getRouteDeUrl()}}/product/{{$lang}}/{{$product->product_type}}">返回</a></span>
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
<script src="{{getSrcUrl()}}/front/js/jquery.min.js"></script>
<script type="text/javascript">
    var dNodes = $("#page_cx").children();
    function rsetBackgroundColor(item) {
        $(item).each(function (index, val) {
            $(val).css('background-color', '');
        });
    }
    rsetBackgroundColor(dNodes);

    $("#page_cx span").css('background-color', '');
    $("#page_cx p").css('background-color', '');
    $("#page_cx strong").css('background-color', '');

</script>
</body>

</html>