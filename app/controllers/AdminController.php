<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class AdminController extends BaseController
{
    /**
     * @author: Terry Lucas
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->beforeFilter(function () {
            $isLogined = \Illuminate\Support\Facades\Session::get('isLogined');
            if (!$isLogined) {
                return \Illuminate\Support\Facades\Redirect::to('/hdadmin/login');
            }
        }, ['except' => ['dologout', 'dologin']]);
    }

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function main()
    {
        $seoInfo = SeoInfo::first();

        // $user = Auth::user();

        return View::make('admin.main', compact('seoInfo', 'user'));
    }


    public function baseset()
    {
        $seo = SeoInfo::first();

        return view('admin.baseset', compact('banner', 'seo'));
    }

    public function consults()
    {
        $lists = Consults::query()->orderBy('msg_status');
        $req = Request::all();

        if (isset($req['companyName']) && !empty($req['companyName'])) {
            $lists = $lists->where('company_name', '=', $req['companyName']);
        }
        if (isset($req['productName']) && !empty($req['productName'])) {
            $lists = $lists->where('product_name', '=', $req['productName']);
        }
        if (isset($req['userName']) && !empty($req['userName'])) {
            $lists = $lists->where('username', '=', $req['userName']);
        }

        // $lists = $lists->paginate(30);
        $lists = $lists->get();

        return View::make('admin.consults', compact('lists'));
    }

    public function oneConsult()
    {
        $consultId = Request::get('consultId', 0);
        if (!isset($consultId)) return $this->setAjaxResponse('succeed', 'upConsultFailed01');

        if (Request::isMethod('POST') && Request::ajax()) {
            $operAction = ['del', 'up'];
            $action = Request::get('action', '');
            if (!in_array($action, $operAction)) return $this->setAjaxResponse('succeed', 'upConsultFailed02');

            $consult = Consults::find($consultId);
            if (is_null($consult)) return $this->setAjaxResponse('succeed', 'upConsultFailed01');

            if ($action == 'del') {
                $rst = $consult->delete();
            } elseif ($action == 'up') {
                $currentStatus = $consult->msg_status;
                $upStatus = ($currentStatus == 0) ? 1 : 0;
                $consult->msg_status = $upStatus;
                $rst = $consult->save();
            } else {
                return $this->setAjaxResponse('succeed', 'upConsultFailed02');
            }

            return ($rst) ? $this->setAjaxResponse('succeed', 'succeed') : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'upConsultFailed02');
    }

    /**
     * User: Terry Lucas
     * @return View
     */
    public function passUpdate()
    {

        return view('admin.passup');
    }

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function upSeoInfo()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpSeoValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $s = $inputs->getValidatorResMsg();
            if (!empty($s)) {
                return $this->setAjaxResponse('failed', 'customermsg', $inputs->getValidatorResMsg());
            }
            $where = [
                'id' => $data['seoId']
            ];
            $update = [
                'seo_zhtitle' => isset($data['seozhTitle']) ? $data['seozhTitle'] : '',
                'seo_entitle' => isset($data['seoenTitle']) ? $data['seoenTitle'] : '',
                'seo_endesc' => isset($data['seoenDesc']) ? $data['seoenDesc'] : '',
                'seo_zhdesc' => isset($data['seozhDesc']) ? $data['seozhDesc'] : '',
                'seo_enkey' => isset($data['seozhKeyW']) ? $data['seozhKeyW'] : '',
                'seo_zhkey' => isset($data['seoenKeyW']) ? $data['seoenKeyW'] : '',
            ];

            try {
                $isRstZH = SeoInfo::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                return $this->setAjaxResponse('failed', 'upSeoFailed02');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'upSeoFailed01');
    }

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function dologout()
    {
        \Illuminate\Support\Facades\Session::put('isLogined', false);
        \Illuminate\Support\Facades\Session::put('username', '');
        return \Illuminate\Support\Facades\Redirect::to('/hdadmin/login');
    }

    /**
     * User: Terry Lucas
     * @return mixed
     */
    public function dologin()
    {
        \Illuminate\Support\Facades\Session::put('error', '');

        if (Request::isMethod('GET')) {
            return view('admin.login');
        }

        if (Request::isMethod('POST')) {
            $username = Request::get('username', '');
            $password = Request::get('password', '');
            $fails = false;
            if ($username == '' || $password == '') {
                $fails = true;
            }
            if ($fails) {
                return \Illuminate\Support\Facades\Redirect::to('hdadmin/login');
            }
            //表单验证通过
            if (Auth::attempt(array('username' => $username, 'password' => $password))) {
                //登录成功后，更新权限缓存
                \Illuminate\Support\Facades\Session::put('isLogined', true);
                \Illuminate\Support\Facades\Session::put('username', $username);
                return \Illuminate\Support\Facades\Redirect::to('/hdadmin/main');
            } else {
                \Illuminate\Support\Facades\Session::put('error', '用户名或密码错误');
                return \Illuminate\Support\Facades\Redirect::to('/hdadmin/login');
            }
        }

    }
}
