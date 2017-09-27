@extends('admin.layout.adminapp')

@section('content')

    <fieldset style="font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">幻灯片列表</a></legend>
    </fieldset>

    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <a class="layui-btn" href="{{getRouteDeUrl()}}/hdadmin/banner/up"><i class="layui-icon"></i>幻灯片</a>
        </div>
    </blockquote>

    <div class="layui-form banner_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>中文/英文标题</th>
                <th>中文/英文图片</th>
                <th>发布日期</th>
                <th>是否置顶</th>
                <th>显示排序值</th>
                <th>更新时间</th>
                <th>幻灯片状态</th>
                <th>后台操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse($lists as $list)
                <tr>
                    <td>{{$list->banner_zhtitle  . '/' . $list->banner_entitle}}</td>
                    <td>
                        <img src="{{$list->banner_szhimg}}" width="30px" height="30px" alt="无">
                        <img src="{{$list->banner_senimg}}" width="30px" height="30px" alt="无">
                    </td>
                    <td>{{$list->publish_at}}</td>
                    <td>
                        @if($list->banner_top == 1) <span
                                style="background-color: #1AA094;color: white">置顶</span> @else <span
                                style="color: #FF5722">未设置</span> @endif
                    </td>
                    <td>{{$list->banner_sort}}</td>
                    <td>{{$list->updated_at}}</td>
                    <td>
                        @if($list->banner_status == 0)
                            <span style="background-color: #1AA094;color: white">正常</span>
                        @else
                            <span style="color:#FF5722;">禁用</span>
                        @endif
                    </td>
                    <td>
                        <a class="layui-btn layui-btn layui-btn-small" href="{{getRouteDeUrl()}}/hdadmin/banner/up/{{$list->id}}"><i
                                    class="iconfont icon-edit"></i>编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-small delBanner"
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
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/banners.js"></script>
@endsection

