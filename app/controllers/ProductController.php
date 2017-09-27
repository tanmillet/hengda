<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class ProductController extends BaseController
{
    use \Traits\ProductTrait;


    public function productTyeps()
    {
        $lists = ProductTypes::query()->orderBy('type_status')->orderBy('type_top', 'DESC')->orderBy('type_sort', 'DESC')->get();

        return view('admin.productypelists', compact('lists'));
    }


    public function oneProductType()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpProductTypeValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $in = $inputs->getValidatorResMsg();
            if (!empty($in)) {
                return $this->setAjaxResponse('failed', 'customermsg', $inputs->getValidatorResMsg());
            }

            $operTypeId = isset($data['operTypeId']) ? $data['operTypeId'] : 0;
            $where = (empty($operTypeId))
                ? [
                    'type_zhname' => isset($data['productTypesZhName']) ? $data['productTypesZhName'] : '',
                    'type_enname' => isset($data['productTypesEnName']) ? $data['productTypesEnName'] : '',
                ]
                : [
                    'id' => $operTypeId
                ];

            $update = [
                'type_zhname' => isset($data['productTypesZhName']) ? $data['productTypesZhName'] : '',
                'type_zhtitle' => isset($data['productTypesZhTitle']) ? $data['productTypesZhTitle'] : '',
                'type_enname' => isset($data['productTypesEnName']) ? $data['productTypesEnName'] : '',
                'type_entitle' => isset($data['productTypesEnTitle']) ? $data['productTypesEnTitle'] : '',
                'type_status' => isset($data['productTypesStatus']) ? $data['productTypesStatus'] : 0,
                'type_img' => isset($data['fileProductPath']) ? $data['fileProductPath'] : '',
                'type_sort' => isset($data['productTypeSort']) ? $data['productTypeSort'] : 0,
                'type_top' => isset($data['productTypeTop']) ? $data['productTypeTop'] : 0,
                'type_zhdesc' => isset($data['editorValue1']) ? $data['editorValue1'] : '',
                'type_endesc' => isset($data['editorValue2']) ? $data['editorValue2'] : '',
            ];

            try {
                $isRstZH = ProductTypes::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                return $this->setAjaxResponse('failed', 'upProductTypeFailed01');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }

        $urlParams = Request::segments();
        $productType = (isset($urlParams[3]) && !empty($urlParams[3])) ? ProductTypes::find($urlParams[3]) : new ProductTypes();
        $productType = (is_null($productType)) ? new ProductTypes() : $productType;

        return view('admin.oneproductype', compact('productType'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function delProductType()
    {
        $operTypeId = Request::get('typeId', 0);
        if (!isset($operTypeId)) return $this->setAjaxResponse('succeed', 'delProductTypeFailed01');

        if (Request::isMethod('POST') && Request::ajax()) {
            $operAction = ['del', 'up'];
            $action = Request::get('action', '');
            if (!in_array($action, $operAction)) return $this->setAjaxResponse('succeed', 'delProductTypeFailed03');

            $productType = ProductTypes::find($operTypeId);
            if (is_null($productType)) return $this->setAjaxResponse('succeed', 'delProductTypeFailed01');

            if ($action == 'del') {
                $rst = $productType->delete();
            } elseif ($action == 'up') {
                $currentStatus = $productType->type_status;
                $upStatus = ($currentStatus == 0) ? 1 : 0;
                $productType->type_status = $upStatus;
                $rst = $productType->save();
            } else {
                return $this->setAjaxResponse('succeed', 'delProductTypeFailed03');
            }

            return ($rst) ? $this->setAjaxResponse('succeed', 'succeed') : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'delProductTypeFailed02');
    }


    public function products()
    {
        $lists = Products::query()->orderBy('product_status')->orderBy('product_top', 'DESC')->orderBy('product_sort', 'DESC');
        $req = Request::all();

        if (isset($req['productName']) && !empty($req['productName'])) {
            $lists = $lists->where('product_name', '=', $req['productName']);
        }
        if (isset($req['productType']) && !empty($req['productType'])) {
            $lists = $lists->where('product_type', '=', $req['productType']);
        }

        // $lists = $lists->paginate(10);
        $lists = $lists->get();

        $productTypes = $this->getProductType();
        foreach ($lists as $list) {
            $list->product_type_name = '';
            foreach ($productTypes as $productType) {
                if ($list->product_type == $productType->id) $list->product_type_name = $productType->type_zhname . '/' . $productType->type_enname;
            }
        }

        return view('admin.productlists', compact('lists', 'productTypes', 'req'));
    }

    public function oneProduct()
    {
        if (Request::isMethod('POST') && Request::ajax()) {
            $validator = new \Requests\UpProductValidator();
            $data = Request::all();
            $inputs = $validator->setValidateParams($data)->valid();
            $in = $inputs->getValidatorResMsg();
            if (!empty($in)) {
                return $this->setAjaxResponse('failed', 'customermsg', $inputs->getValidatorResMsg());
            }
            $operProductId = isset($data['operProductId']) ? $data['operProductId'] : 0;
            $where = (empty($operProductId))
                ? [
                    'product_name' => isset($data['productName']) ? $data['productName'] : '',
                ]
                : [
                    'id' => $operProductId
                ];
            $update = [
                'product_status' => isset($data['prodcutStatus']) ? $data['prodcutStatus'] : '',
                'prodcut_lang' => isset($data['prodcutLang']) ? $data['prodcutLang'] : 0,
                'product_type' => isset($data['productType']) ? $data['productType'] : 0,
                'product_feature' => isset($data['productFeature']) ? $data['productFeature'] : 0,
                'product_name' => isset($data['productName']) ? $data['productName'] : '',
                'product_keywords' => isset($data['productKeywords']) ? $data['productKeywords'] : '',
                'product_img' => isset($data['fileProductPath']) ? $data['fileProductPath'] : '',
                'publish_at' => isset($data['publishAt']) ? $data['publishAt'] : 0,
                'product_top' => isset($data['prodcutTop']) ? $data['prodcutTop'] : 0,
                'product_sort' => isset($data['productTypeSort']) ? $data['productTypeSort'] : 0,
                'product_content' => isset($data['editorValue']) ? $data['editorValue'] : '',
            ];

            try {
                $isRstZH = Products::updateOrCreate($where, $update);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                return $this->setAjaxResponse('failed', 'upProductFailed01');
            }

            return ($isRstZH)
                ? $this->setAjaxResponse('succeed', 'succeed')
                : $this->setAjaxResponse('failed', 'failed');
        }
        $urlParams = Request::segments();
        $product = (isset($urlParams[3]) && !empty($urlParams[3])) ? Products::find($urlParams[3]) : new Products();
        $product = (is_null($product)) ? new Products() : $product;

        $productTypes = $this->getProductType();
        $features = $this->getProductFeatures();

        return view('admin.oneproduct', compact('product', 'productTypes', 'features'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function delProduct()
    {
        $operProductId = Request::get('productId', 0);
        if (!isset($operProductId)) return $this->setAjaxResponse('failed', 'delProductFailed01');

        if (Request::isMethod('POST') && Request::ajax()) {
            $isProduct = Products::find($operProductId);
            if (is_null($isProduct)) return $this->setAjaxResponse('failed', 'delProductFailed01');
            $rst = $isProduct->delete();

            return ($rst) ? $this->setAjaxResponse('succeed', 'succeed') : $this->setAjaxResponse('failed', 'failed');
        }

        return $this->setAjaxResponse('failed', 'delProductFailed02');
    }

    /*************************************提供对应的api接口********************************************/
    public function getProductTypeByLang()
    {
        $lang = Request::get('lang', 0);
        if (empty($lang)) return $this->setAjaxResponse('failed', 'getProductTypeError01');
        if (!in_array($lang, ['zh', 'en'])) return $this->setAjaxResponse('failed', 'getProductTypeError01');

        $types = $this->getProductType();
        if (is_null($types)) return $this->setAjaxResponse('failed', 'getProductTypeError02');

        $data = [];
        collect($types)->each(function ($val, $index) use (&$data, $lang) {
            $data[$index] = [
                'key' => $val->id,
                'name' => ($lang == 'zh') ? $val->type_zhname : $val->type_enname,
            ];
        });

        return $this->setAjaxResponse('succeed', 'succeed', $data);
    }

    /**
     * User: Terry Lucas
     * @param Request $request
     */
    public function upLoadFile()
    {
        $file = '';
        if (Request::hasFile('fileProduct')) {
            $file = Request::file('fileProduct');
        }

        if (Request::hasFile('fileZhImg')) {
            $file = Request::file('fileZhImg');
        }

        if (Request::hasFile('fileEnImg')) {
            $file = Request::file('fileEnImg');
        }

        if (empty($file)) {
            return [
                'code' => false,
                'msg' => "上传失败合理操作！",
                'data' => [
                    'src' => '',
                    'srcmaster' => '',
                ]
            ];
        }

        $entension = $file->getClientOriginalExtension();
        if ($entension && !in_array($entension, ['jpg', 'png', 'gif', 'jpeg'])) return [
            'code' => false,
            'msg' => "上传合理支持的图片格式，目前支持 'jpg|png|gif|jpeg' 这四种格式的图片！",
            'data' => []
        ];

        $imageTempPath = $file->getRealPath();
        if (filesize($imageTempPath) > getAsysConf('filesize')) return [
            'code' => false,
            'msg' => "上传合理图片大小，目前支持小于500KB的图片！",
            'data' => []
        ];

        $clientName = $file->getClientOriginalName();
        $fileName = md5(date('ymdhis') . $clientName) . "." . $entension;
        //文件移动
        $file->move('uploads/product', $fileName);

       new \Traits\ResizeImage('uploads/product/' . $fileName, '210', '210', '0', 'uploads/product/small/' . $fileName);

        return [
            'code' => true,
            'msg' => "上传成功！",
            'data' => [
                'src' => getSrcUrl() . "/uploads/product/small/" . $fileName,
                'srcmaster' => getSrcUrl() . "/uploads/product/" . $fileName,
            ]
        ];
    }
}
