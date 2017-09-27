@extends('admin.layout.adminapp')

@section('content')

    <fieldset style="    font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">新闻类型列表</a></legend>
    </fieldset>

    <blockquote class="layui-elem-quote news_search">
        {{--<div class="layui-inline">--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" value="" placeholder="请输入关键字" class="layui-input search_input" style="height: 32px;">--}}
            {{--</div>--}}
            {{--<a class="layui-btn search_btn layui-btn-small" href="/hdadmin/news/types"><i class="layui-icon">&#xe615;</i> 查询</a>--}}
        {{--</div>--}}
        <div class="layui-inline">
            <a class="layui-btn layui-btn-small" href="{{getRouteDeUrl()}}/hdadmin/news/typeup"><i class="layui-icon"></i>新闻类型</a>
        </div>
        {{--<div class="layui-inline">--}}
            {{--<a class="layui-btn layui-btn-danger layui-btn-small batchDel"><i class="layui-icon"></i>批量删除</a>--}}
        {{--</div>--}}
    </blockquote>
    <div class="layui-form news_list">
        <table class="layui-table">
            <thead>
            <tr>
                {{--<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>--}}
                <th>类型中文名称</th>
                <th>类型英文文名称</th>
                <th>类型状态</th>
                <th>更新时间</th>
                <th>后台操作</th>
            </tr>
            </thead>
            <tbody class="news_content">
            @forelse($lists as $list)
                <tr>
                    {{--<td><input type="checkbox" name="" lay-skin="primary" lay-filter=""></td>--}}
                    <td>{{$list->news_type_zhname}}</td>
                    <td>{{$list->news_type_enname}}</td>
                    <td>
                        @if($list->news_type_status == 0)
                            <span style="background-color: #1AA094;color: white">正常</span>
                        @else
                            <span style="color:#FF5722;">禁用</span>
                        @endif
                    </td>
                    <td>{{$list->updated_at}}</td>
                    <td>
                        <a class="layui-btn layui-btn layui-btn-small" href="{{getRouteDeUrl()}}/hdadmin/news/typeup/{{$list->id}}"><i class="iconfont icon-edit"></i>编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-small delNewsTypeStatus" data-val="{{$list->id}}"><i class="layui-icon"></i>删除</a>
                    </td>
                </tr>
            @empty
            @endforelse

            </tbody>
        </table>
    </div>

@endsection

@section('custscript')
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/newsTypes.js"></script>
@endsection
