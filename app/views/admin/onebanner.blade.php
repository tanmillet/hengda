@extends('admin.layout.adminapp')

@section('content')
    <fieldset style="    font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">更新/添加幻灯片信息</a></legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">浏览权限</label>
            <div class="layui-input-block">
                <input type="radio" name="bannerStatus" value="0"
                       title="开放" {{($banner->banner_status == 0) ? 'checked' : ''}}>
                <input type="radio" name="bannerStatus" value="1"
                       title="禁用" {{($banner->banner_status == 1) ? 'checked' : ''}}>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">显示位置</label>
            <div class="layui-input-block">
                <select name="bannerLocation" lay-verify="required" class="bannerLocation">
                    <option value="0">选择显示位置</option>
                    @foreach(getBannerLocations() as $key=>$bannerLocation)
                        <option value="{{$key}}" {{($key == $banner->banner_location)  ? 'selected' : ''}}>{{$bannerLocation}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">中文标题</label>
            <div class="layui-input-block">
                <input type="text" name="bannerzhTitle" lay-verify="required" placeholder="请输入中文标题" class="layui-input"
                       value="{{$banner->banner_zhtitle}}" {{ (!empty($banner->banner_zhtitle) ? 'disabled' : '') }}>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">英文标题</label>
            <div class="layui-input-block">
                <input type="text" name="bannerenTitle" placeholder="请输入英文标题" class="layui-input"
                       value="{{$banner->banner_entitle}}" {{ (!empty($banner->banner_entitle) ? 'disabled' : '') }}>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">中文描述</label>
            <div class="layui-input-block">
                <input type="text" name="bannerZhdesc" placeholder="请输入幻灯片中文描述" class="layui-input"
                       value="{{ $banner->banner_zhdesc }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">英文描述</label>
            <div class="layui-input-block">
                <input type="text" name="bannerEndesc" placeholder="请输入幻灯片英文描述" class="layui-input"
                       value="{{ $banner->banner_endesc }}">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">中文图片</label>
                <div class="layui-input-block">
                    <input type="file" name="fileZhImg" id="zhImg" class="layui-upload-file" value="">
                </div>
            </div>
            <div class="layui-inline">
                @if($banner->banner_zhimg)
                    <img id="imgzHPath" src="{{$banner->banner_zhimg}}" width="65px" height="65px;">
                @else
                    <img id="imgzHPath" src="">
                @endif
                <input type="hidden" id="fileZhImg" name="bannerZhimg" value="{{$banner->banner_zhimg}}">
                <input type="hidden" id="fileSZhImg" name="bannerZhSimg" value="{{$banner->banner_szhimg}}">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">英文图片</label>
                <div class="layui-input-block">
                    <input type="file" name="fileEnImg" id="enImg" class="layui-upload-file" value="">
                </div>
            </div>
            <div class="layui-inline">
                @if($banner->banner_enimg)
                    <img id="imgeNPath" src="{{$banner->banner_enimg}}" width="65px" height="65px;">
                @else
                    <img id="imgeNPath" src="">
                @endif
                <input type="hidden" id="fileEnImg" name="bannerEnimg" value="{{$banner->banner_enimg}}">
                <input type="hidden" id="fileSEnImg" name="bannerSEnimg" value="{{$banner->banner_senimg}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">发布时间</label>
            <div class="layui-input-inline">
                <input type="text" name="publishAt" class="layui-input newsTime" lay-verify="date"
                       onclick="layui.laydate({elem:this})"
                       value="{{($banner->publish_at) ? $banner->publish_at: date('Y-m-d')}}">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">是否置顶</label>
            <div class="layui-input-block">
                <input type="radio" name="bannerTop" value="0"
                       title="否" {{($banner->banner_top == 0) ? 'checked' : ''}}>
                <input type="radio" name="bannerTop" value="1"
                       title="是" {{($banner->banner_top == 1) ? 'checked' : ''}}>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">排序值</label>
            <div class="layui-input-block">
                <input type="number" name="bannerSort" class="layui-input" lay-verify="required"
                       value="{{(empty($banner->banner_sort)) ? 0 : $banner->banner_sort}}">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn">预览</a>
                <button class="layui-btn" lay-submit lay-filter="addBanner">立即提交</button>
            </div>
        </div>
        <input type="hidden" name="operId" value="{{$banner->id}}">
    </form>
@endsection

@section('custscript')
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/bannerAdd.js"></script>
@endsection