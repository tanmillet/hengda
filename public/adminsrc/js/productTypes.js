layui.config({
    base: "/adminsrc/js/"
}).use(['layer', 'jquery'], function () {
    var layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
    var deurl = (true) ? '/newhd/public/index.php' : '';
    $('.upProductTypeStatus').click(function () {
        var me = this;
        var operId = $(me).attr('data-val');
        layer.open({
            type: 1
            ,title: false //不显示标题栏
            ,closeBtn: false
            ,area: '300px;'
            ,shade: 0.8
            ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
            ,resize: false
            ,btn: ['确认更新', '取消操作']
            ,btnAlign: 'c'
            ,moveType: 1 //拖拽模式，0或者1
            ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">确认进行更新产品类型状态吗？</div>'
            ,yes: function(){
                layer.closeAll();
                var index = layer.msg('提交中，请稍候', {icon: 16, time: false, shade: 0.8});
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: deurl + '/hdadmin/product/typedel', type: 'post', data: {'typeId':operId,'action':'up'}, dataType: 'json', success: function (rsp) {
                        layer.close(index);
                        layer.msg(rsp.info.msg);
                        if(rsp.status == 'succeed'){
                            window.location.href = deurl + '/hdadmin/product/types';
                        }
                    },
                    error: function () {
                        layer.close(index);
                        layer.msg("网络不稳定，请稍后再试！");
                    }
                })
            }
        });
    });

    $('.delProductTypeStatus').click(function () {
        var me = this;
        var operId = $(me).attr('data-val');
        layer.open({
            type: 1
            ,title: false //不显示标题栏
            ,closeBtn: false
            ,area: '300px;'
            ,shade: 0.8
            ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
            ,resize: false
            ,btn: ['确认删除', '取消操作']
            ,btnAlign: 'c'
            ,moveType: 1 //拖拽模式，0或者1
            ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">确认进行删除产品类型吗？</div>'
            ,yes: function(){
                layer.closeAll();
                var index = layer.msg('提交中，请稍候', {icon: 16, time: false, shade: 0.8});
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: deurl + '/hdadmin/product/typedel', type: 'post', data: {'typeId':operId,'action':'del'}, dataType: 'json', success: function (rsp) {
                        layer.close(index);
                        layer.msg(rsp.info.msg);
                        if(rsp.status == 'succeed'){
                            window.location.href = deurl + '/hdadmin/product/types';
                        }
                    },
                    error: function () {
                        layer.close(index);
                        layer.msg("网络不稳定，请稍后再试！");
                    }
                })
            }
        });
    });
})
