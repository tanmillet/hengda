@extends('admin.layout.adminapp')

@section('content')

    <fieldset style="font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">新闻列表</a></legend>
    </fieldset>

    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <form action="#" method="get">
                <div class="layui-input-inline">
                    <input type="text" value="{{ isset($req['newsTitle']) ? $req['newsTitle'] : '' }}" placeholder="新闻标题" class="layui-input search_input" name="newsTitle">
                </div>
                <div class="layui-input-inline" style="width: 420px;">
                        <select name="newsType" lay-verify="required">
                            <option value="0">全部类型</option>
                            @foreach($newsTypes as $newsType)
                                <option value="{{$newsType->id}}" {{(isset($req['newsType']) && $req['newsType'] == $newsType->id) ? 'selected' : ''}}>{{$newsType->news_type_zhname . '/' . $newsType->news_type_enname}}</option>
                            @endforeach
                        </select>
                </div>
                <button type="submit" class="layui-btn search_btn"><i class="layui-icon">
                        &#xe615;</i> 查询</button>
            </form>
        </div>
        <div class="layui-inline">
            <a class="layui-btn" href="{{getRouteDeUrl()}}/hdadmin/news/up"><i class="layui-icon"></i>新闻</a>
        </div>
    </blockquote>

    <div class="layui-form news_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>新闻标题</th>
                <th>新闻类型</th>
                <th>发布日期</th>
                <th>是否置顶</th>
                <th>显示排序值</th>
                <th>更新时间</th>
                <th>产品状态</th>
                <th>后台操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse($lists as $list)
                <tr>
                    <td>{{$list->news_title}}</td>
                    <td>{{ $list->news_type_name}}</td>
                    <td>{{$list->publish_at}}</td>
                    <td>
                        @if($list->news_top == 1) <span
                                style="background-color: #1AA094;color: white">置顶</span> @else <span
                                style="color: #FF5722">未设置</span> @endif
                    </td>
                    <td>{{$list->news_sort}}</td>
                    <td>{{$list->updated_at}}</td>
                    <td>
                        @if($list->news_status == 0)
                            <span style="background-color: #1AA094;color: white">正常</span>
                        @else
                            <span style="color:#FF5722;">禁用</span>
                        @endif
                    </td>
                    <td>
                        <a class="layui-btn layui-btn layui-btn-small" href="{{getRouteDeUrl()}}/hdadmin/news/up/{{$list->id}}"><i
                                    class="iconfont icon-edit"></i>编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-small delNews"
                           data-val="{{$list->id}}"><i class="layui-icon"></i>删除</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">为查询对应的结果</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mright_page">
            {{--{{ $lists->links() }}--}}
        </div>
    </div>

@endsection

@section('custscript')
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/news.js"></script>
@endsection

