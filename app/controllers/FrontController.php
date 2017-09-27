<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class FrontController
 * User: Terry Lucas
 * @package App\Http\Controllers\Front
 */
class FrontController extends BaseController
{
    /**
     * @author: Terry Lucas
     * FrontController constructor.
     */
    public function __construct()
    {

        $this->beforeFilter(function () {
            Session::put('websitelang', '');
            $prams = Request::segments();
            if (count($prams) < 2) return redirect('/index/zh');
            $lang = isset($prams[1]) ? $prams[1] : '';
            if (empty($lang) || !in_array($lang, ['zh', 'en'])) return redirect('/index/zh');
            Session::put('websitelang', $lang);
        }, ['except' => 'index1']);
    }

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function index1()
    {
        Session::flush();

        return $this->index();
    }

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function index()
    {
        //获取基础数据
        list($lang, $programa, $footer, $seo) = $this->getBasicConf();

        //幻灯片
        $banners = Banners::where('banner_status', '=', 0)
            ->where('publish_at', '<=', date('Y-m-d'))
            ->where('banner_location', '=', 'index')
            ->orderBy('banner_top', 'DESC')
            ->orderBy('banner_sort', 'DESC')
            ->skip(0)->take(5)
            ->get();
        foreach ($banners as $banner) {
            $banner->title = ($lang == 'zh') ? $banner->banner_zhtitle : $banner->banner_entitle;
            $banner->img = ($lang == 'zh') ? $banner->banner_zhimg : $banner->banner_enimg;
        }

        //获取产品类型
        $productTypes = ProductTypes::where('type_status', '=', 0)
            ->orderBy('type_top', 'DESC')
            ->orderBy('type_sort', 'DESC')
            ->skip(0)->take(15)
            ->get();
        foreach ($productTypes as $productType) {
            $productType->title = ($lang == 'zh') ? $productType->type_zhtitle : $productType->type_entitle;
            $productType->typename = ($lang == 'zh') ? $productType->type_zhname : $productType->type_enname;
        }

        return view('front.index', compact('programa', 'banners', 'lang', 'footer', 'seo', 'productTypes'));
    }


    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function about()
    {
        //获取基础数据
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('about');

        return view('front.about', compact('programa', 'lang', 'footer', 'seo', 'bannerUrl'));
    }


    /**
     * User: Terry Lucas
     * @param string $lang
     * @param string $selProductTypeId
     * @return mixed
     */
    public function products($lang = 'zh', $selProductTypeId = '')
    {
        //获取是否是全局查询
        $searchTag = \Illuminate\Support\Facades\Request::get('searchTag', '');
        $selProductName = \Illuminate\Support\Facades\Request::get('selProductName', '');
        //获取基础数据
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('product');
        //产品列表
        $productLists = [];
        //产品类型描述
        $desc = '';
        //获取产品类型
        $productTypes = ProductTypes::where('type_status', '=', 0)
            ->orderBy('type_top', 'DESC')
            ->orderBy('type_sort', 'DESC')
            ->skip(0)->take(15)
            ->get();
        foreach ($productTypes as $productType) {
            $productType->name = ($lang == 'zh') ? $productType->type_zhname : $productType->type_enname;
            $productType->desc = ($lang == 'zh') ? $productType->type_zhdesc : $productType->type_endesc;
            if ($selProductTypeId == $productType->id) {
                $productLang = ($lang == 'zh') ? 0 : 1;
                $productLists = Products::where('product_type', '=', $selProductTypeId)
                    ->where('prodcut_lang', '=', $productLang)
                    ->where('publish_at', '<=', date('Y-m-d'))
                    ->orderBy('product_top', 'DESC')
                    ->orderBy('product_sort', 'DESC')
                    ->get();
                $desc = $productType->desc;
            }
        }

        //位指定那个产品类型则显示第一个
        if (empty($productLists) && empty($searchTag) && !empty($productTypes)) {
            $productType = $productTypes->toArray()[0];
            if (!is_null($productType)) {
                $productLang = ($lang == 'zh') ? 0 : 1;
                $productLists = Products::where('product_type', '=', $productType['id'])
                    ->where('prodcut_lang', '=', $productLang)
                    ->where('publish_at', '<=', date('Y-m-d'))
                    ->orderBy('product_top', 'DESC')
                    ->orderBy('product_sort', 'DESC')
                    ->get();
                $selProductTypeId = $productType['id'];
                $desc = $productType['desc'];
            }
        }

        //查询全局产品列表 TODO 分页
        if (!empty($searchTag)) {
            $productLang = ($lang == 'zh') ? 0 : 1;
            $productLists = Products::where('prodcut_lang', '=', $productLang)
                ->where('publish_at', '<=', date('Y-m-d'))
                ->where('product_name', 'like', '%' . $selProductName . '%')
                ->orderBy('product_top', 'DESC')
                ->orderBy('product_sort', 'DESC')
                ->get();
        }

        return view('front.product', compact('programa', 'lang', 'footer', 'seo', 'productLists', 'productTypes', 'selProductTypeId', 'desc', 'bannerUrl'));
    }

    /**
     * User: Terry Lucas
     * @param string $lang
     * @param string $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function oneProduct($lang = 'zh', $productId = '')
    {
        //获取基础数据
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('product');
        //产品类型描述
        $desc = '';
        //获取产品类型
        $productTypes = ProductTypes::where('type_status', '=', 0)
            ->orderBy('type_top', 'DESC')
            ->orderBy('type_sort', 'DESC')
            ->skip(0)->take(15)
            ->get();
        foreach ($productTypes as $productType) {
            $productType->name = ($lang == 'zh') ? $productType->type_zhname : $productType->type_enname;
        }
        $productLang = ($lang == 'zh') ? 0 : 1;
        $product = Products::where('id', '=', $productId)
            ->where('prodcut_lang', '=', $productLang)
            ->where('product_status', '=', 0)
            ->where('publish_at', '<=', date('Y-m-d'))
            ->orderBy('product_top', 'DESC')
            ->orderBy('product_sort', 'DESC')
            ->first();

        return view('front.oneproduct', compact('programa', 'lang', 'footer', 'seo', 'product', 'productTypes', 'desc', 'bannerUrl'));
    }

    /**
     * User: Terry Lucas
     * @return string
     */
    public function online()
    {
        //获取基础数据
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('online');
        //获取产品类型
        $productTypes = ProductTypes::where('type_status', '=', 0)
            ->orderBy('type_top', 'DESC')
            ->orderBy('type_sort', 'DESC')
            ->skip(0)->take(15)
            ->get();
        foreach ($productTypes as $productType) {
            $productType->name = ($lang == 'zh') ? $productType->type_zhname : $productType->type_enname;
        }

        return view('front.feedback', compact('programa', 'lang', 'footer', 'seo', 'productTypes', 'bannerUrl'));
    }

    /**
     * User: Terry Lucas
     * @return string
     */
    public function contact()
    {
        //获取基础数据
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('contract');
        //获取产品类型
        $productTypes = ProductTypes::where('type_status', '=', 0)
            ->orderBy('type_top', 'DESC')
            ->orderBy('type_sort', 'DESC')
            ->skip(0)->take(15)
            ->get();
        foreach ($productTypes as $productType) {
            $productType->name = ($lang == 'zh') ? $productType->type_zhname : $productType->type_enname;
        }

        return view('front.contact', compact('programa', 'lang', 'footer', 'seo', 'productTypes', 'bannerUrl'));
    }

    /**
     * User: Terry Lucas
     * @param string $selNewsTypeId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news($lang = 'zh', $selNewsTypeId = '')
    {
        //获取基础数据
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('news');
        //新闻列表
        $newsLists = [];
        //获取新闻类型
        $newsTypes = NewsTypes::where('news_type_status', '=', 0)
            ->get();
        foreach ($newsTypes as $newsType) {
            $newsType->name = ($lang == 'zh') ? $newsType->news_type_zhname : $newsType->news_type_enname;
            if ($selNewsTypeId == $newsType->id) {
                $newsLang = ($lang == 'zh') ? 0 : 1;
                $newsLists = News::where('news_type', '=', $selNewsTypeId)
                    ->where('news_lang', '=', $newsLang)
                    ->where('news_status', '=', 0)
                    ->where('publish_at', '<=', date('Y-m-d'))
                    ->orderBy('news_top', 'DESC')
                    ->orderBy('news_sort', 'DESC')
                    ->get();
            }
        }
        //位指定那个产品类型则显示第一个
        if (empty($newsLists) && !empty($newsTypes)) {
            $newsType = $newsTypes->toArray()[0];
            if (!is_null($newsType)) {
                $newsLang = ($lang == 'zh') ? 0 : 1;
                $newsLists = News::where('news_type', '=', $newsType['id'])
                    ->where('news_lang', '=', $newsLang)
                    ->where('news_status', '=', 0)
                    ->where('publish_at', '<=', date('Y-m-d'))
                    ->orderBy('news_top', 'DESC')
                    ->orderBy('news_sort', 'DESC')
                    ->get();
                $selNewsTypeId = $newsType['id'];
            }
        }

        return view('front.news', compact('programa', 'lang', 'footer', 'seo', 'news', 'newsTypes', 'newsLists', 'selNewsTypeId', 'bannerUrl'));
    }

    /**
     * User: Terry Lucas
     * @param string $lang
     * @param string $newsId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function oneNews($lang = 'zh', $newsId = '')
    {
        //获取基础数据
        $selNewsTypeId = '';
        list($lang, $programa, $footer, $seo, $bannerUrl) = $this->getBasicConf('news');

        //获取新闻类型
        $newsTypes = NewsTypes::where('news_type_status', '=', 0)->get();
        foreach ($newsTypes as $newsType) {
            $newsType->name = ($lang == 'zh') ? $newsType->news_type_zhname : $newsType->news_type_enname;
        }

        //获取指定新闻内容
        $newsLang = ($lang == 'zh') ? 0 : 1;
        $news = News::where('id', '=', $newsId)
            ->where('news_status', '=', 0)
            ->where('news_lang', '=', $newsLang)
            ->first();

        $news = is_null($news) ? new News() : $news;

        $selNewsTypeId = $news->news_type;

        return view('front.onenews', compact('programa', 'lang', 'footer', 'seo', 'newsTypes', 'news', 'bannerUrl','selNewsTypeId'));
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function oneConsult()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpConsultValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $s = $inputs->getValidatorResMsg();
            if (!empty($s)) {
                return $this->setAjaxResponse('failed', 'customermsg', $inputs->getValidatorResMsg());
            }

            $where = [
                'company_name' => isset($data['companyName']) ? $data['companyName'] : '',
                'product_name' => isset($data['productName']) ? $data['productName'] : '',
            ];

            $update = [
                'company_name' => isset($data['companyName']) ? $data['companyName'] : '',
                'username' => isset($data['userName']) ? $data['userName'] : '',
                'phone' => isset($data['phone']) ? $data['phone'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'postcode' => isset($data['postcode']) ? $data['postcode'] : 0,
                'product_name' => isset($data['productName']) ? $data['productName'] : '',
                'product_size' => isset($data['productSize']) ? $data['productSize'] : 0,
                'product_material' => isset($data['productMaterial']) ? $data['productMaterial'] : '',
                'product_thickness' => isset($data['productThickness']) ? $data['productThickness'] : '',
                'product_color' => isset($data['productColor']) ? $data['productColor'] : '',
                'product_num' => isset($data['productNum']) ? $data['productNum'] : 0,
                'msg_status' => isset($data['msgStatus']) ? $data['msgStatus'] : 0,
            ];

            try {
                $isRstZH = Consults::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                return $this->setAjaxResponse('failed', 'upConsultFailed03');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'failed');
    }

    /**
     * User: Terry Lucas
     * @return array
     */
    protected function getBasicConf($bannerLocation = '')
    {
        //判定显示网站类型
        $lang = Session::get('websitelang');
        //兼容首页地址
        $lang = (empty($lang)) ? 'zh' : $lang;
        //header 名称
        $programa = getPrograma($lang);
        //footer 名称
        $footer = getFooter($lang);
        //获取seo设置
        $seo = SeoInfo::first();
        $seo = (is_null($seo)) ? new SeoInfo() : $seo;
        $seo->title = ($lang == 'zh') ? $seo->seo_zhtitle : $seo->seo_entitle;
        $seo->desc = ($lang == 'zh') ? $seo->seo_zhdesc : $seo->seo_endesc;
        $seo->keyw = ($lang == 'zh') ? $seo->seo_zhkey : $seo->seo_enkey;

        $banner = Banners::where('banner_status', '=', 0)
            ->where('publish_at', '<=', date('Y-m-d'))
            ->where('banner_location', '=', $bannerLocation)->first();
        $bannerUrl = '';
        if (!is_null($banner)) {
            $bannerUrl = ($lang == 'zh') ? $banner->banner_zhimg : $banner->banner_enimg;
            if (empty($bannerUrl)) {
                $bannerUrl = ($lang == 'zh') ? $banner->banner_enimg : $banner->banner_zhimg;
            }
        }

        return [$lang, $programa, $footer, $seo, $bannerUrl];
    }
}
