@extends('admin.layout.adminapp')

@section('content')
    <fieldset style="    font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">更新/添加产品信息</a></legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">产品语言</label>
                <div class="layui-input-block">
                    <select name="prodcutLang" lay-verify="required" class="prodcutLang">
                        <option value="0" {{($product->prodcut_lang == 0) ? 'selected' : ''}}>中文</option>
                        <option value="1" {{($product->prodcut_lang == 1) ? 'selected' : ''}}>英文</option>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">浏览权限</label>
                <div class="layui-input-block">
                    <input type="radio" name="prodcutStatus" value="0"
                           title="开放" {{($product->product_status == 0) ? 'checked' : ''}}>
                    <input type="radio" name="prodcutStatus" value="1"
                           title="禁用" {{($product->product_status == 1) ? 'checked' : ''}}>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">产品类型</label>
                <div class="layui-input-block">
                    <select name="productType" lay-verify="required">
                        <option value="0">选择产品类型</option>
                        @foreach($productTypes as $productType)
                            <option value="{{$productType->id}}" {{($product->product_type == $productType->id) && ($product->prodcut_lang == 0) ? 'selected' : ''}}>{{$productType->type_zhname}}</option>
                            <option value="{{$productType->id}}" {{($product->product_type == $productType->id) && ($product->prodcut_lang == 1) ? 'selected' : ''}}>{{$productType->type_enname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">产品名称</label>
            <div class="layui-input-block">
                <input type="text" name="productName" lay-verify="required" placeholder="请输入产品名称" class="layui-input"
                       value="{{$product->product_name}}" {{ (!empty($product->product_name) ? 'disabled' : '') }}>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" name="productKeywords" placeholder="请输入产品关键字"
                       lay-verify="required" value="{{$product->product_keywords}}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">产品图片</label>
                <div class="layui-input-block">
                    <input type="file" name="fileProduct" class="layui-upload-file" value="">
                </div>
            </div>
            <div class="layui-inline">
                @if($product->product_img)
                    <img id="imgPath" src="{{$product->product_img}}" width="65px" height="65px;">
                @else
                    <img id="imgPath" src="">
                @endif
                <input type="hidden" id="fileProductPath" name="fileProductPath" value="{{$product->product_img}}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">发布时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="publishAt" class="layui-input newsTime" lay-verify="date"
                           onclick="layui.laydate({elem:this})"
                           value="{{($product->publish_at) ? $product->publish_at: date('Y-m-d')}}">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">是否置顶</label>
                <div class="layui-input-block">
                    <input type="radio" name="prodcutTop" value="0"
                           title="否" {{($product->product_top == 0) ? 'checked' : ''}}>
                    <input type="radio" name="prodcutTop" value="1"
                           title="是" {{($product->product_top == 1) ? 'checked' : ''}}>
                </div>
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序值</label>
            <div class="layui-input-block">
                <input type="number" name="productTypeSort" class="layui-input" lay-verify="required"
                       value="{{(empty($product->product_sort)) ? 0 : $product->product_sort}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品内容</label>
            <div class="layui-input-block">
                <script id="editor" type="text/plain" style="height:500px;">
                    <?php echo htmlspecialchars_decode($product->product_content)?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn">预览</a>
                <button class="layui-btn" lay-submit lay-filter="addProduct">立即提交</button>
            </div>
        </div>
        <input type="hidden" name="operProductId" value="{{$product->id}}">
    </form>
@endsection

@section('custscript')
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">UE.getEditor('editor'); </script>
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/productAdd.js"></script>
@endsection