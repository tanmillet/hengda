<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{$seo->desc}}"/>
    <meta name="keywords" content="{{$seo->keyw}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                <li><a style="font-family: 微软雅黑;" class="{{$key == 0 ? 'focu' : ''}}"
                       href="{{getRouteDeUrl()}}/product/{{$lang}}/{{$productType->id}}">{{$productType->name}}</a></li>
            @empty

            @endforelse

        </ul>
        {{--<div class="searchBox01">--}}
            {{--<form action="/product/{{$lang}}" method="post">--}}
                {{--<input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品 查询 ...' : 'product search ...' }}" name="selProductName" value="">--}}
                {{--<input type="hidden" name="searchTag" value="searchTag">--}}
                {{--<button type="submit" value=""></button>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
    <div class="ri02">
        <div class="contactBox" style="padding: 80px 0px 0px 240px;">
            <div class="box03">
                <form action="" method="post" id="consultForm">
                    <ul class="ul01">
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '公司名称' : 'Company Name'}}:</span>
                            <input  type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '公司名称' : 'Company Name'}}" name="companyName">
                            <em>*</em>
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '客户名称' : 'Customer Name'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '客户名称' : 'Customer Name'}}" name="userName">
                            <em>*</em>
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '联系方式' : 'Customer Phone'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '联系方式' : 'Customer Phone'}}" name="phone">
                            <em>*</em>
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '联系邮箱' : 'Customer Name'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '联系邮箱' : 'Customer Email'}}" name="email">
                            <em>*</em>
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '公司邮编' : 'PostCode'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '公司邮编' : 'postcode'}}" name="postcode">
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '产品名称' : 'Product Name'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品名称' : 'Product Name'}}" name="productName">
                            <em>*</em>
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '产品大小' : 'Product Size'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品大小' : 'Product Size'}}" name="productSize">
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '产品材料' : 'Product Material'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品材料' : 'Product Material'}}" name="productMaterial">
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '产品厚度' : 'Product Thickness'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品厚度' : 'Product Thickness'}}" name="productThickness">
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '产品颜色' : 'Product Color'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品颜色' : 'Product Color'}}" name="productColor">
                        </li>
                        <li>
                            <span style="font-size: 16px;">{{(isset($lang) && $lang == 'zh') ? '产品数量' : 'Product Number'}}:</span>
                            <input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品数量' : 'Product Number'}}" name="productNum">
                        </li>
                        <li>
                            <span style="font-size: 16px;"></span>
                            <input class="btn" type="button" value="{{(isset($lang) && $lang == 'zh') ? '提交' : 'Submit'}}" id="btnForm">
                        </li>
                    </ul>
                </form>
            </div>
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
<script src="{{getSrcUrl()}}/front/js/jquery.min.js"></script>
<script type="text/javascript">

    $('#btnForm').click(function () {
        var companyName = $("input[name='companyName']").val(),
            userName = $("input[name='userName']").val(),
            phone = $("input[name='phone']").val(),
            email = $("input[name='email']").val(),
            productName = $("input[name='productName']").val();
        var data = $("#consultForm").serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/newhd/public/index.php/consult/zh',
            data: data,
            success: function (rsp) {
                alert(rsp.info.msg);
                window.location.reload();
            },
            dataType: 'json',
            error: function () {
                alert('网络异常，请稍后再试！谢谢！');
            }
        });
    });

</script>
</body>
</html>