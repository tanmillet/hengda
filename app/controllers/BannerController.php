<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class BannerController extends BaseController
{
    /**
     * User: Terry Lucas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function banners()
    {
        $lists = Banners::query()->orderBy('banner_status')->orderBy('banner_top', 'DESC')->orderBy('banner_sort', 'DESC')
            ->get();
            // ->paginate(10);

        return view('admin.bannerlists', compact('lists' , $lists));
    }

    /**
     * User: Terry Lucas
     * @return array|View
     */
    public function oneBanner()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpBannerValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $in = $inputs->getValidatorResMsg();
            if (!empty($in)) {
                return $this->setAjaxResponse('failed', 'customermsg', $inputs->getValidatorResMsg());
            }
            $operId = isset($data['operId']) ? $data['operId'] : 0;
            $where = (empty($operId))
                ? [
                    'banner_zhtitle' => isset($data['bannerzhTitle']) ? $data['bannerzhTitle'] : '',
                ]
                : [
                    'id' => $operId
                ];

            $update = [
                'banner_status' => isset($data['bannerStatus']) ? $data['bannerStatus'] : 1,
                'banner_zhtitle' => isset($data['bannerzhTitle']) ? $data['bannerzhTitle'] : '',
                'banner_entitle' => isset($data['bannerenTitle']) ? $data['bannerenTitle'] : '',
                'banner_zhdesc' => isset($data['bannerZhdesc']) ? $data['bannerZhdesc'] : '',
                'banner_endesc' => isset($data['bannerEndesc']) ? $data['bannerEndesc'] : '',
                'banner_zhimg' => isset($data['bannerZhimg']) ? $data['bannerZhimg'] : '',
                'banner_szhimg' => isset($data['bannerZhSimg']) ? $data['bannerZhSimg'] : '',
                'banner_enimg' => isset($data['bannerEnimg']) ? $data['bannerEnimg'] : '',
                'banner_senimg' => isset($data['bannerSEnimg']) ? $data['bannerSEnimg'] : '',
                'banner_location' => isset($data['bannerLocation']) ? $data['bannerLocation'] : '',
                'publish_at' => isset($data['publishAt']) ? $data['publishAt'] : '',
                'banner_top' => isset($data['bannerTop']) ? $data['bannerTop'] : 0,
                'banner_sort' => isset($data['bannerSort']) ? $data['bannerSort'] : 0,
            ];

            try {
                $isRstZH = Banners::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                return $this->setAjaxResponse('failed', 'upBannerFailed01');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }

        $urlParams = Request::segments();
        $banner = (isset($urlParams[3]) && !empty($urlParams[3])) ? Banners::find($urlParams[3]) : new Banners();
        $banner = (is_null($banner)) ? new Banners() : $banner;

        return view('admin.onebanner', compact('banner'));
    }

    /**
     * User: Terry Lucas
     * @param Request $request
     * @return array
     */
    public function delBanner()
    {
        $operBannerId = Request::get('bannerId', 0);
        if (!isset($operBannerId)) return $this->setAjaxResponse('failed', 'delBannerFailed01');

        if (Request::isMethod('POST') && Request::ajax()) {
            $isBanner = Banners::find($operBannerId);
            if (is_null($isBanner)) return $this->setAjaxResponse('failed', 'delBannerFailed01');
            $rst = $isBanner->delete();

            return ($rst) ? $this->setAjaxResponse('succeed', 'succeed') : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'delBannerFailed02');
    }
}
