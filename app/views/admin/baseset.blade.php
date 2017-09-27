@extends('admin.layout.adminapp')

@section('content')

    <fieldset style="    font-size: 20px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">基础配置</a></legend>
    </fieldset>

    <div class="layui-collapse" lay-accordion>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">网站SEO设置</h2>
            <div class="layui-colla-content layui-show">
                <form class="layui-form">

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">seo标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="seozhTitle" lay-verify="required" placeholder="请输入中文seo标题"
                                   class="layui-input" value="{{$seo->seo_zhtitle}}">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">seo标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="seoenTitle" lay-verify="required" placeholder="请输入英文seo标题"
                                   class="layui-input" value="{{$seo->seo_entitle}}">
                        </div>
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">seo关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="seozhKeyW" lay-verify="required" placeholder="请输入中文seo关键字"
                                   class="layui-input" value="{{$seo->seo_zhkey}}">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">seo关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="seoenKeyW" lay-verify="required" placeholder="请输入英文seo关键字"
                                   class="layui-input" value="{{$seo->seo_enkey}}">
                        </div>
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">seo描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="seozhDesc" lay-verify="required" placeholder="请输入中文seo描述"
                                   class="layui-input" value="{{$seo->seo_zhdesc}}">
                        </div>
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">seo描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="seoenDesc" lay-verify="required" placeholder="请输入英文seo描述"
                                   class="layui-input" value="{{$seo->seo_endesc}}">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="addSeo">立即提交</button>
                        </div>
                    </div>

                    <input type="hidden" name="seoId" value="{{$seo->id}}">
                </form>

            </div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">其它配置</h2>
            <div class="layui-colla-content">
                <form class="layui-form">
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="addBanner">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custscript')
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/basesetAdd.js"></script>
@endsection