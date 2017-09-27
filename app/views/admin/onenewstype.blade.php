@extends('admin.layout.adminapp')
@section('content')
    <fieldset style="    font-size: 20px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">更新/添加新闻类型</a></legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">类型名称</label>
            <div class="layui-input-block">
                <input type="text" name="newsTypesZhName" class="layui-input newsTypesZhName" lay-verify="required"
                       placeholder="请输中文新闻类型名称" value="{{$newsType->news_type_zhname}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类型名称</label>
            <div class="layui-input-block">
                <input type="text" name="newsTypesEnName" class="layui-input newsTypesEnName" lay-verify="required"
                       placeholder="请输英文新闻类型名称" value="{{$newsType->news_type_enname}}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">类型状态</label>
                <div class="layui-input-inline">
                    <select name="newsTypesStatus" class="newsTypesStatus" lay-filter="newsTypesStatus">
                        <option value="0" {{($newsType->news_type_status == 0) ? 'selected' : ''}}>正常</option>
                        <option value="1" {{($newsType->news_type_status == 1) ? 'selected' : ''}}>禁用</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                {{--<i class="layui-icon"></i>--}}
                <a href="/hdadmin/news/types" class="layui-btn layui-btn-primary layui-btn-small">返回列表</a>
                <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="addNews">确认提交</button>
            </div>
        </div>
        <input type="hidden" name="operTypeId" value="{{$newsType->id}}">
    </form>
@endsection

@section('custscript')
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/newsTypeAdd.js"></script>
@endsection
