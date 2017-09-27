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
<div class="banner02" style="background: url({{$bannerUrl}}"></div>

<div class="page02 main">
    <div class="le">
        <ul>
            @foreach(getAboutMenus($lang) as $key=>$getAboutMenu)
                <li><a style="font-family: 微软雅黑;" class="{{($key==0) ? 'focu' : ''}}" href="javascript:" onclick="navTab(this)">{{$getAboutMenu}}</a></li>
            @endforeach
        </ul>
        {{--<div class="searchBox01">--}}
            {{--<form action="{{getRouteDeUrl()}}/product/{{$lang}}" method="post">--}}
                {{--<input type="text" placeholder="{{(isset($lang) && $lang == 'zh') ? '产品 查询 ...' : 'product search ...' }}" name="selProductName" value="">--}}
                {{--<input type="hidden" name="searchTag" value="searchTag">--}}
                {{--<button type="submit" value=""></button>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
    <div id="navTabBox" class="ri">
        <div class="text" style="display:block">
            @if(isset($lang) && $lang == 'zh')
                <h2>恒达起源</h2>
                <p> 由几位非织造材料专业人士共同发起，东莞市恒达布业有限公司成立于2007年，是一家民营股份制企业。公司致力于无纺布行业的产品研发与市场开拓，为客户提供全面解决方案。历经十年迅速发展，并赢得国内外市场良好口碑。集团旗下关系企业遍布广东，湖南，湖北及江苏等地。</p>
                <h2>经营范围</h2>
                <p>本公司产品主要有PP纺粘，PET涤纶纺粘，SMS，熔喷，水剌，针剌，热风，热轧等无纺布材料。同时提供无纺布淋膜与印花深加工，全方位为客户服务。</p>
                <h2>产品应用</h2>
                <p>本公司材料广泛应用于口罩及过滤，医疗卫材，美容护理，手袋箱包，家居收纳，婴儿童车，家私床垫，汽车内饰及护套，防水建材及土建工程，房屋装修（墙）地膜，农业丰收，墙纸及喷绘画布等行业。</p>
                <h2>企业愿景</h2>
                <p>以客户的需求为导向，提供全面解决方案。致力成为无纺布行业最具专业性服务与活力的公司。</p>
                <dl class="dl01">
                    <dt>企业文化</dt>
                    <dd>
                        <span>恪守<br/>诚信</span>
                        <span class="s2">严谨<br/>专业</span>
                        <span>合作<br/>共赢</span>
                    </dd>
                </dl>
            @elseif(isset($lang) && $lang == 'en')
                <h2>Origin of Hengda</h2>
                <p>Co sponsored by several nonwovens professionals, Dongguan Hengda Textile Co. Ltd. was founded in 2007, is a private joint-stock enterprises. The company is committed to the non-woven fabric industry product development and market development, to provide customers with comprehensive solutions. After ten years of rapid development, and won the good reputation at home and abroad market. The group's relationships are located in Guangdong, Hunan, Hubei and Jiangsu.</p>
                <h2>Scope of business</h2>
                <p>The company's main products are PP spunbond, PET polyester spunbond, SMS, melt spray, water, needle, hot air, hot rolling and other non-woven materials. At the same time provide non-woven lamination and printing processing, a full range of customer service.</p>
                <h2>Product application</h2>
                <p>The materials are widely used in masks and filters, medical care materials, beauty care, handbags, Home Furnishing storage, baby stroller, car interiors and furniture and mattress, jacket, waterproof building materials and civil engineering, housing decoration (wall) plastic film, agricultural harvest, wallpaper and spray painting cloth etc..</p>
                <h2>Enterprise vision</h2>
                <p>Provide comprehensive solutions to customer needs. To become the most professional non-woven service industry and vitality of the company.</p>
                <dl class="dl01">
                    <dt>Corporate culture</dt>
                    <dd>
                        <span>Abide<br/>Sincerity</span>
                        <span class="s2">Rigorous<br/>Professional</span>
                        <span>cooperation<br/>Win-win</span>
                    </dd>
                </dl>
            @endif
        </div>
        <div class="aboutText text">
            @if(isset($lang) && $lang == 'zh')
                <p style="font-weight: bold;font-size: 20px;">ISO管理的中心原则是以客户为关注焦点，我们的口号是：以客户的需求为导向，提供全面解决方案。只要客户需求无纺布，就能想到恒达！</p>
                <h2>恪守诚信</h2>
                <p>恒达公司从不出售伪劣产品，而且实行无条件退货，极大的保证了客户的利益。很多客户都是在长达十年的合作中感受到了我们的诚信经营，并且不断的口口相传，给我们介绍了新的客户。就是凭着这条理念，使我们能在激烈的市场竟争中占有一席之地。</p>
                <h2>创新求变</h2>
                <p>市场在不断的变化，客户的要求也越来越高。如何有效降低成本，将最好的产品奉献给客户，成为了我们的重大责任。为了能提高竞争力，并且降低生产成本维持公司的正常运作，公司没有偷工减料以次充好，而是狠抓管理，不断引进新的生产技术和设备，开发新产品来配合市场，赢得更多的客户。</p>
                <h2>严谨专业</h2>
                <p>社会日新月异的发展，市场竞争也日益增强。遇事洞察力不强，视问题不见，只能使问题愈演愈烈，最终酿成严重恶果，使个人、企业蒙受损失。因此，要想提高企业的竟争力，就必须要做到“第一时间”发现问题，“一次性”地从根本解决问题，最终杜绝质量问题流入市场。</p>
                <h2>合作共赢</h2>
                <p>企业宗旨即企业的根本目标是要盈利，企业是一个经济实体，要实现持续性盈利，就要和客户一起“双盈”。要认识到：只有客户发展壮大了，我们作为供应商才能同步发展壮大，我们的市场才能随之拓宽。因此，为客户提供稳定的产品质量，用持久可靠的企业信誉为客户服务，是对客户利益的保障，也是对我们自身利益的保障。</p>
            @elseif(isset($lang) && $lang == 'en')
                <p style="font-weight: bold;font-size: 20px;">ISO A central tenet of management is based on customer focus, our slogan is: to customer demand as the guidance, to provide comprehensive solutions.As long as the customer need non-woven fabric, you can think of hengda！</p>
                <h2>Integrity</h2>
                <p>Hengda company never sells inferior products, and implements unconditional return, which greatly guarantees the interests of customers. Many customers feel our honesty in ten years of cooperation, and the word of mouth, introduces us to new customers. It is with this concept that we can have a place in the fierce market competition.</p>
                <h2>Innovation and Change</h2>
                <p>The market is constantly changing, and the requirements of customers are getting higher and higher. How to effectively reduce costs, the best products dedicated to customers, has become our major responsibility. In order to improve the competitiveness and reduce the production cost to maintain the normal operation of the company, the company did not cut corners but shoddy, pay close attention to management, and constantly introduce new production technology and equipment, develop new products to meet the market, to win more customers.</p>
                <h2>Rigorous Professional</h2>
                <p>With the rapid development of society, the market competition is also increasing. Failing insight is not strong, depending on the problem, can only make the problem intensified, and eventually lead to serious consequences, so that individuals and enterprises suffer losses. Therefore, in order to improve the competitiveness of enterprises, it is necessary to do the first time found the problem "," disposable "to fundamentally solve the problem, and ultimately eliminate quality problems into the market.</p>
                <h2>Win-win Cooperation</h2>
                <p>The enterprise tenet is that the basic goal of the enterprise is to make profit, and the enterprise is an economic entity, and to achieve sustained profitability, it is necessary to "double profit" with the customer". We should realize that only when customers grow up, can we develop as a supplier at the same time and expand our market. Therefore, to provide customers with stable product quality and reliable and reliable customer service is the guarantee of the interests of customers and the protection of our own interests.</p>
            @endif
        </div>
        <div class="aboutText">
            @if(isset($lang) && $lang == 'zh')
                <ul class="ul02">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0201.jpg"></div>
                        <a href="#">气流成网水剌无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0202.jpg"></div>
                        <a href="#">进口SMS无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0203.jpg"></div>
                        <a href="#">PP纺粘无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0204.jpg"></div>
                        <a href="#">水剌无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0205.jpg"></div>
                        <a href="#">高速水剌无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0206.jpg"></div>
                        <a href="#">SMS无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0207.jpg"></div>
                        <a href="#">进口PP纺粘无纺布生产线</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0208.jpg"></div>
                        <a href="#">高速无纺布淋膜设备</a>
                    </li>
                </ul>
            @elseif(isset($lang) && $lang == 'en')
                <ul class="ul02">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0201.jpg"></div>
                        <a href="#">Imported SMS non-woven production line</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0202.jpg"></div>
                        <a href="#">Air net forming water jet non-woven fabric production line</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0203.jpg"></div>
                        <a href="#">Water proof non-woven fabric production line</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0204.jpg"></div>
                        <a href="#">PP Spunbond non-woven fabric production line</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0205.jpg"></div>
                        <a href="#">SMS Non-woven fabric production line</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0206.jpg"></div>
                        <a href="#">High speed water jet non-woven fabric production line</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0207.jpg"></div>
                        <a href="#">High-speed non-woven laminating equipment</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0208.jpg"></div>
                        <a href="#">Imported PP spunbond non-woven fabric production line</a>
                    </li>
                </ul>
            @endif
        </div>
        <div class="aboutText">
            @if(isset($lang) && $lang == 'zh')
                <ul class="ul02 ul03">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0101.jpg"></div>
                        <a href="#">17年ROSH测试报告SGS </a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0102.jpg"></div>
                        <a href="#">2017年SVHC SGS</a>
                    </li>
                </ul>
                <ul class="ul02 ul03">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0103.jpg"></div>
                        <a href="#">GBT+32610-2016+日常防护型口罩技术规范 (1)</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0104.jpg"></div>
                        <a href="#">ISO证书（中文版） (1)</a>
                    </li>
                </ul>
                <ul class="ul02 ul03">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0105.jpg"></div>
                        <a href="#">ISO证书（英文版）</a>
                    </li>
                </ul>
            @elseif(isset($lang) && $lang == 'en')
                <ul class="ul02 ul03">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0101.jpg"></div>
                        <a href="#">17年ROSH Test reportSGS </a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0102.jpg"></div>
                        <a href="#">2017年SVHC SGS</a>
                    </li>
                </ul>
                <ul class="ul02 ul03">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0103.jpg"></div>
                        <a href="#">GBT+32610-2016+Technical specification for daily protective mask (1)</a>
                    </li>
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0104.jpg"></div>
                        <a href="#">ISOCertificate（Chinese version） (1)</a>
                    </li>
                </ul>
                <ul class="ul02 ul03">
                    <li>
                        <div class="img"><img src="{{getSrcUrl()}}/front/images/about-img0105.jpg"></div>
                        <a href="#">ISOCertificate（English Edition）</a>
                    </li>
                </ul>
            @endif
        </div>
        <div class="aboutText text">
            @if(isset($lang) && $lang == 'zh')
                <h2>我们的优势</h2>
                <p>集合非织造材料（无纺布）行业20年的专业经验，拥有一流的各类型人才，为客户提供一站式服务！</p>
            @elseif(isset($lang) && $lang == 'en')
                <h2>Our Advantages</h2>
                <p>Set non-woven fabric (non-woven fabric) industry for 20 years of professional experience, with first-class talents of all types, to provide one-stop service to customers！</p>
            @endif
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
    function navTab(e) {
        var index = $(e).parent("li").index();
        //console.log(index);
        $(e).parent("li").siblings("li").find("a").removeClass("focu");
        $(e).addClass("focu");
        $("#navTabBox").children("div").hide();
        //console.log($("#navTabBox").children("div"));
        $("#navTabBox").children("div").eq(index).show();
    }
</script>
</body>

</html>