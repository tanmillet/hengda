@extends('admin.layout.adminapp')
@section('content')
    <fieldset style="    font-size: 20px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">更新/添加产品类型</a></legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">中文名称</label>
            <div class="layui-input-block">
                <input type="text" name="productTypesZhName" class="layui-input" lay-verify="required"
                       placeholder="请输中文产品类型名称" value="{{$productType->type_zhname}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">中文简介</label>
            <div class="layui-input-block">
                <textarea type="text" name="productTypesZhTitle" class="layui-textarea" lay-verify="required"
                          placeholder="请输中文产品类型简介">{{$productType->type_zhtitle}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">英文名称</label>
            <div class="layui-input-block">
                <input type="text" name="productTypesEnName" placeholder="请输英文产品类型名称"  class="layui-input" lay-verify="required"  value="{{$productType->type_enname}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">英文简介</label>
            <div class="layui-input-block">
                 <textarea type="text" name="productTypesEnTitle"  placeholder="请输英文产品类型简介"   class="layui-textarea" lay-verify="required">{{$productType->type_entitle}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">类型图片</label>
                <div class="layui-input-block">
                    <input type="file" name="fileProduct" class="layui-upload-file" value="">
                </div>
            </div>
            <div class="layui-inline">
                @if($productType->type_img)
                    <img id="imgPath" src="{{$productType->type_img}}" width="65px" height="65px;">
                @else
                    <img id="imgPath" src="">
                @endif
                <input type="hidden" id="fileProductPath" name="fileProductPath" value="{{$productType->type_img}}">
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">类型状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="productTypesStatus" value="0"
                           title="正常" {{($productType->type_status == 0) ? 'checked' : ''}}>
                    <input type="radio" name="productTypesStatus" value="1"
                           title="禁用" {{($productType->type_status == 1) ? 'checked' : ''}}>
                </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="number" name="productTypeSort" class="layui-input" lay-verify="required"
                       placeholder="请输产品排序" value="{{($productType->type_sort) ? $productType->type_sort : 0}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否置顶</label>
            <div class="layui-input-block">
                <input type="radio" name="productTypeTop" value="0"
                       title="否" {{($productType->type_top == 0) ? 'checked' : ''}}>
                <input type="radio" name="productTypeTop" value="1"
                       title="是" {{($productType->type_top == 1) ? 'checked' : ''}}>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">中文介绍</label>
            <div class="layui-input-block">
                <script id="editor" type="text/plain" style="height:500px;" name="editorValue1">
                    <?php echo htmlspecialchars_decode($productType->type_zhdesc)?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">英文介绍</label>
            <div class="layui-input-block">
                <script id="eneditor" type="text/plain" style="height:500px;" name="editorValue2">
                    <?php echo htmlspecialchars_decode($productType->type_endesc)?>
                </script>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a href="/hdadmin/product/types" class="layui-btn layui-btn-primary">返回列表</a>
                <button class="layui-btn" lay-submit="" lay-filter="addProduct">确认提交</button>
            </div>
        </div>
        <input type="hidden" name="operTypeId" value="{{$productType->id}}">
    </form>
@endsection

@section('custscript')
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">UE.getEditor('editor'); UE.getEditor('eneditor'); </script>
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/productTypeAdd.js"></script>
@endsection