layui.config({
    base: "/adminsrc/js/"
}).use(['form', 'layer', 'jquery', 'laydate', 'upload'], function () {
    var form = layui.form(),
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
    var deurl = (true) ? '/newhd/public/index.php' : '';

    form.on("submit(addNews)", function (data) {
        var index = top.layer.msg('数据提交中，请稍候', {icon: 16, time: false, shade: 0.8});
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: deurl + '/hdadmin/news/up', type: 'post', data: data.field, dataType: 'json', success: function (rsp) {
                layer.close(index);
                layer.msg(rsp.info.msg);
                if (rsp.status == 'succeed') {
                    window.location.href = deurl + '/hdadmin/news/lists';
                }
            },
            error: function () {
                layer.close(index);
                layer.msg("网络不稳定，请稍后再试！");
            }
        })

        return false;
    });
})
