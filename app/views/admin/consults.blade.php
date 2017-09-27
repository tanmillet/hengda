@extends('admin.layout.adminapp')

@section('content')

    <fieldset style="font-size: 18px;border: none;border-top: 1px solid #009688;">
        <legend><a name="use">网上咨询</a></legend>
    </fieldset>

    <blockquote class="layui-elem-quote news_search">
        <div class="layui-inline">
            <form action="#" method="get">
                <div class="layui-input-inline">
                    <input type="text" value="{{ isset($req['companyName']) ? $req['companyName'] : '' }}"
                           placeholder="公司名称" class="layui-input search_input" name="companyName">
                </div>
                <div class="layui-input-inline">
                    <input type="text" value="{{ isset($req['productName']) ? $req['productName'] : '' }}"
                           placeholder="产品名称" class="layui-input search_input" name="productName">
                </div>
                <div class="layui-input-inline">
                    <input type="text" value="{{ isset($req['userName']) ? $req['userName'] : '' }}"
                           placeholder="客户名称" class="layui-input search_input" name="userName">
                </div>
                <button type="submit" class="layui-btn search_btn"><i class="layui-icon">
                        &#xe615;</i> 查询
                </button>
            </form>
        </div>
    </blockquote>

    <div class="layui-form banner_list">
        <table class="layui-table">
            <thead>
            <tr>
                <th>公司名称</th>
                <th>客户信息</th>
                <th>产品信息</th>
                <th>咨询时间</th>
                <th>是否处理</th>
                <th>信息处理</th>
            </tr>
            </thead>
            <tbody>
            @forelse($lists as $list)
                <tr>
                    <td>{{$list->company_name}}</td>
                    <td>
                        <textarea class="layui-textarea">【客户名称】：{{$list->username}} 【客户电话】：{{$list->phone}}
                            【客户邮件】：{{$list->email}} 【客户地址】：{{$list->address}}</textarea>
                    </td>
                    <td>
                        <textarea class="layui-textarea">【产品名称】：{{$list->product_name}} 【产品尺寸】：{{$list->product_size}}
                            【产品材料】：{{$list->product_material}} 【产品厚度】：{{$list->product_thickness}}
                            【印刷颜色】：{{$list->product_color}} 【物品数量】：{{$list->product_num}}</textarea>
                    </td>
                    <td>{{$list->created_at}}</td>
                    <td>
                        @if($list->msg_status == 0)
                            待处理
                        @else
                            已处理
                        @endif
                    </td>
                    <td>
                        <a class="layui-btn layui-btn msgStatus" href="javascript:void 0;" data-val="{{$list->id}}">处理咨询信息</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">为查询对应的结果</td>
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
    <script type="text/javascript" src="{{getSrcUrl()}}/adminsrc/js/consults.js"></script>
@endsection