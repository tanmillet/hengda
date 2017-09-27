layui.config({
    base: "/adminsrc/js/"
}).use(['layer', 'jquery'], function () {
    var layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
    var deurl = (true) ? '/newhd/public/index.php' : '';

    $('.msgStatus').click(function () {
        var me = this;
        var operId = $(me).attr('data-val');

        var index = layer.msg('提交中，请稍候', {icon: 16, time: false, shade: 0.8});
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: deurl + '/hdadmin/consult/up', type: 'post', data: {'consultId':operId,'action':'up'}, dataType: 'json', success: function (rsp) {
                layer.close(index);
                layer.msg(rsp.info.msg);
                if(rsp.status == 'succeed'){
                    window.location.href = deurl + '/hdadmin/consult/lists';
                }
            },
            error: function () {
                layer.close(index);
                layer.msg("网络不稳定，请稍后再试！");
            }
        })
    });
})
