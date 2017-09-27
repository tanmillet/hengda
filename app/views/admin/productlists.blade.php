@extends('admin.layout.adminapp')

@section('content')

    <fieldset style="font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">产品列表</a></legend>
    </fieldset>

    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <form action="#" method="get">
                <div class="layui-input-inline">
                    <input type="text" value="{{ isset($req['productName']) ? $req['productName'] : '' }}" placeholder="产品名称" class="layui-input search_input" name="productName">
                </div>
                <div class="layui-input-inline" style="width: 420px;">
                        <select name="productType" lay-verify="required">
                            <option value="0">全部产品类型</option>
                            @foreach($productTypes as $productType)
                                <option value="{{$productType->id}}" {{(isset($req['productType']) && $req['productType'] == $productType->id) ? 'selected' : ''}}>{{$productType->type_zhname .'/' . $productType->type_enname}}</option>
                            @endforeach
                        </select>
                </div>
                <button type="submit" class="layui-btn search_btn"><i class="layui-icon">
                        &#xe615;</i> 查询</button>
            </form>
        </div>
        <div class="layui-inline">
            <a class="layui-btn" href="{{getRouteDeUrl()}}/hdadmin/product/up"><i class="layui-icon"></i>产品</a>
        </div>
    </blockquote>

    <div class="layui-form news_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>产品名称</th>
                <th>产品图片</th>
                {{--<th>产品特征</th>--}}
                <th>产品类型</th>
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
                    <td>{{$list->product_name}}</td>
                    <td>
                        <img src="{{$list->product_img}}" width="30px" height="30px">
                    </td>
                    {{--<td>--}}
                        {{--@foreach(getProductFeature() as $key=>$feature)--}}
                            {{--@if($list->product_feature == $key)--}}
                                {{--<span style="{{$feature['css']}}">{{$feature['name']}}</span>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</td>--}}
                    <td>{{ $list->product_type_name}}</td>
                    <td>{{$list->publish_at}}</td>
                    <td>
                        @if($list->product_top == 1) <span
                                style="background-color: #1AA094;color: white">置顶</span> @else <span
                                style="color: #FF5722">未设置</span> @endif
                    </td>
                    <td>{{$list->product_sort}}</td>
                    <td>{{$list->updated_at}}</td>
                    <td>
                        @if($list->product_status == 0)
                            <span style="background-color: #1AA094;color: white">正常</span>
                        @else
                            <span style="color:#FF5722;">禁用</span>
                        @endif
                    </td>
                    <td>
                        <a class="layui-btn layui-btn layui-btn-small" href="{{getRouteDeUrl()}}/hdadmin/product/up/{{$list->id}}"><i
                                    class="iconfont icon-edit"></i>编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-small delProduct"
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
{{--            {{ $lists->links() }}--}}
        </div>
    </div>

@endsection

@section('custscript')
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/products.js"></script>
@endsection

