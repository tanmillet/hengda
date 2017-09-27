<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

/**
 * Class NewsController
 * User: Terry Lucas
 * @package App\AppHD\Http\Admin
 */
class NewsController extends BaseController
{
    use \Traits\NewsTrait;

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function newsTyeps()
    {
        $lists = NewsTypes::query()->orderBy('news_type_status')->get();

        return view('admin.newstypelists', compact('lists'));
    }

    /**
     * User: Terry Lucas
     * @return array|mixed
     */
    public function oneNewsType()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpNewsTypeValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $in = $inputs->getValidatorResMsg();
            if (!empty($in)) {
                return $this->setAjaxResponse('failed','customermsg', $inputs->getValidatorResMsg());
            }

            $operTypeId = isset($data['operTypeId']) ? $data['operTypeId'] : 0;
            $where = (empty($operTypeId))
                ? [
                    'news_type_zhname' => isset($data['newsTypesZhName']) ? $data['newsTypesZhName'] : '',
                    'news_type_enname' => isset($data['newsTypesEnName']) ? $data['newsTypesEnName'] : '',
                ]
                : [
                    'id' => $operTypeId
                ];

            $update = [
                'news_type_zhname' => isset($data['newsTypesZhName']) ? $data['newsTypesZhName'] : '',
                'news_type_enname' => isset($data['newsTypesEnName']) ? $data['newsTypesEnName'] : 0,
                'news_type_status' => isset($data['newsTypesStatus']) ? $data['newsTypesStatus'] : 0,
            ];

            try {
                $isRstZH = NewsTypes::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                return $this->setAjaxResponse('failed', 'upNewsTypeFailed01');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }

        $urlParams = Request::segments();
        $newsType = (isset($urlParams[3]) && !empty($urlParams[3])) ? NewsTypes::find($urlParams[3]) : new NewsTypes();
        $newsType = (is_null($newsType)) ? new NewsTypes() : $newsType;

        return view('admin.onenewstype', compact('newsType'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function delNewsType()
    {
        $operTypeId = Request::get('typeId', 0);
        if (!isset($operTypeId)) return $this->setAjaxResponse('succeed', 'delNewsTypeFailed01');

        if (Request::isMethod('POST') && Request::ajax()) {
            $operAction = ['del', 'up'];
            $action = Request::get('action', '');
            if (!in_array($action, $operAction)) return $this->setAjaxResponse('succeed', 'delNewsTypeFailed03');

            $newsType = NewsTypes::find($operTypeId);
            if (is_null($newsType)) return $this->setAjaxResponse('succeed', 'delNewsTypeFailed01');

            if ($action == 'del') {
                $rst = $newsType->delete();
            } elseif ($action == 'up') {
                $currentStatus = $newsType->news_type_status;
                $upStatus = ($currentStatus == 0) ? 1 : 0;
                $newsType->news_type_status = $upStatus;
                $rst = $newsType->save();
            } else {
                return $this->setAjaxResponse('succeed', 'delNewsTypeFailed03');
            }

            return ($rst) ? $this->setAjaxResponse('succeed', 'succeed') : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'delNewsTypeFailed02');
    }


    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function news()
    {
        $lists = News::query()->orderBy('news_status')->orderBy('news_top', 'DESC')->orderBy('news_sort', 'DESC');
        $req = Request::all();

        if(isset($req['newsTitle']) && !empty($req['newsTitle'])) {
            $lists = $lists->where('news_title' , 'like' , '%'.$req['newsTitle'].'%');
        }
        if(isset($req['newsType']) && !empty($req['newsType'])) {
            $lists = $lists->where('news_type' , '=' , $req['newsType']);
        }

        // $lists = $lists->paginate(10);
        $lists = $lists->get();

        $newsTypes = $this->getNewsType();
        foreach ($lists as $list){
            $list->news_type_name = '';
            foreach ($newsTypes as $newsType) {
                if($list->news_type == $newsType->id) $list->news_type_name = $newsType->news_type_zhname . '/' . $newsType->news_type_enname;
            }
        }

        return view('admin.newslists', compact('lists' , 'newsTypes','req'));
    }


    /**
     * User: Terry Lucas
     * @return array|mixed
     */
    public function oneNews()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpNewsValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $in = $inputs->getValidatorResMsg();
            if (!empty($in)) {
                return $this->setAjaxResponse('failed', 'customermsg', $inputs->getValidatorResMsg());
            }
            $operNewsId = isset($data['operNewsId']) ? $data['operNewsId'] : 0;
            $where = (empty($operNewsId))
                ? [
                    'news_title' => isset($data['newsTitle']) ? $data['newsTitle'] : '',
                ]
                : [
                    'id' => $operNewsId
                ];
            $update = [
                'news_lang' => isset($data['newsLang']) ? $data['newsLang'] : '',
                'news_status' => isset($data['newsStatus']) ? $data['newsStatus'] : 0,
                'news_type' => isset($data['newsType']) ? $data['newsType'] : 0,
                'news_title' => isset($data['newsTitle']) ? $data['newsTitle'] : 0,
                'news_keywords' => isset($data['newsKeywords']) ? $data['newsKeywords'] : '',
                'publish_at' => isset($data['publishAt']) ? $data['publishAt'] : 0,
                'news_top' => isset($data['newsTop']) ? $data['newsTop'] : 0,
                'news_sort' => isset($data['newsSort']) ? $data['newsSort'] : 0,
                'news_desc' => isset($data['editorValue']) ? $data['editorValue'] : '',
            ];

            try {
                $isRstZH = News::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                return $this->setAjaxResponse('failed', 'upNewsFailed01');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }

        $urlParams = Request::segments();
        $news = (isset($urlParams[3]) && !empty($urlParams[3])) ? News::find($urlParams[3]) : new News();
        $news = (is_null($news)) ? new News() : $news;
        $newsTypes = $this->getNewsType();

        return view('admin.onenews', compact('news', 'newsTypes'));
    }


    /**
     * User: Terry Lucas
     * @return array
     */
    public function delNews()
    {
        $operNewsId = Request::get('newsId', 0);
        if (!isset($operNewsId)) return $this->setAjaxResponse('failed', 'delNewsFailed01');

        if (Request::isMethod('POST') && Request::ajax()) {
            $isNews = News::find($operNewsId);
            if (is_null($isNews)) return $this->setAjaxResponse('failed', 'delNewsFailed01');
            $rst = $isNews->delete();

            return ($rst) ? $this->setAjaxResponse('succeed', 'succeed') : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'delNewsFailed02');
    }


    /**
     * User: Terry Lucas
     * @param $id
     * @return mixed
     */
    public function previewNews($id)
    {
        $news = new  News();

        return redirect('/hdfront/preview/new/', compact('news'));
    }

}
