@extends('admin.layout.adminapp')

@section('content')
    <fieldset style="    font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">更新/添加新闻信息</a></legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">新闻语言</label>
                <div class="layui-input-block">
                    <select name="newsLang" lay-verify="required" class="newsLang">
                        <option value="0" {{($news->news_lang == 0) ? 'selected' : ''}}>中文</option>
                        <option value="1" {{($news->news_lang == 1) ? 'selected' : ''}}>英文</option>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">浏览权限</label>
                <div class="layui-input-block">
                    <input type="radio" name="newsStatus" value="0"
                           title="开放" {{($news->news_status == 0) ? 'checked' : ''}}>
                    <input type="radio" name="newsStatus" value="1"
                           title="禁用" {{($news->news_status == 1) ? 'checked' : ''}}>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">新闻类型</label>
                <div class="layui-input-block">
                    <select name="newsType" lay-verify="required">
                        <option value="0">选择新闻类型</option>
                        @foreach($newsTypes as $newsType)
                            <option value="{{$newsType->id}}" {{($news->news_type == $newsType->id) && ($news->news_lang == 0) ? 'selected' : ''}}>{{$newsType->news_type_zhname}}</option>
                            <option value="{{$newsType->id}}" {{($news->news_type == $newsType->id) && ($news->news_lang == 1) ? 'selected' : ''}}>{{$newsType->news_type_enname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">新闻标题</label>
            <div class="layui-input-block">
                <input type="text" name="newsTitle" lay-verify="required" placeholder="请输入新闻标题" class="layui-input"
                       value="{{$news->news_title}}" {{ (!empty($news->news_title) ? 'disabled' : '') }}>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" name="newsKeywords" placeholder="请输入新闻关键字"
                       lay-verify="required" value="{{$news->news_keywords}}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">发布时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="publishAt" class="layui-input newsTime" lay-verify="date"
                           onclick="layui.laydate({elem:this})"
                           value="{{($news->publish_at) ? $news->publish_at: date('Y-m-d')}}">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">是否置顶</label>
                <div class="layui-input-block">
                    <input type="radio" name="newsTop" value="0"
                           title="否" {{($news->news_top == 0) ? 'checked' : ''}}>
                    <input type="radio" name="newsTop" value="1"
                           title="是" {{($news->news_top == 1) ? 'checked' : ''}}>
                </div>
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序值</label>
            <div class="layui-input-block">
                <input type="number" name="newsSort" class="layui-input" lay-verify="required"
                       value="{{(empty($news->news_sort)) ? 0 : $news->news_sort}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">产品内容</label>
            <div class="layui-input-block">
                <script id="editor" type="text/plain" style="height:500px;">   <?php echo htmlspecialchars_decode($news->news_desc)?></script>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn">预览</a>
                <button class="layui-btn" lay-submit lay-filter="addNews">立即提交</button>
            </div>
        </div>
        <input type="hidden" name="operNewsId" value="{{$news->id}}">
    </form>
@endsection

@section('custscript')
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{getSrcUrl()}}/adminsrc/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">UE.getEditor('editor'); </script>
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/newsAdd.js"></script>
@endsection