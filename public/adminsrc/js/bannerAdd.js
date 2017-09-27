layui.config({
    base: "/adminsrc/js/"
}).use(['form', 'layer', 'jquery', 'laydate', 'upload'], function () {
    var form = layui.form(),
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
    var deurl = (true) ? '/newhd/public/index.php' : '';

    form.on("submit(addBanner)", function (data) {
        var index = top.layer.msg('数据提交中，请稍候', {icon: 16, time: false, shade: 0.8});
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: deurl + '/hdadmin/banner/up', type: 'post', data: data.field, dataType: 'json', success: function (rsp) {
                layer.close(index);
                layer.msg(rsp.info.msg);
                if (rsp.status == 'succeed') {
                    window.location.href = deurl +'/hdadmin/banner/lists';
                }
            },
            error: function () {
                layer.close(index);
                layer.msg("网络不稳定，请稍后再试！");
            }
        })

        return false;
    });


    layui.upload({
        url: deurl +'/hdadmin/uploadfile'
        , ext: 'jpg|png|gif|jpeg'
        ,elem: '#enImg'
        , success: function (res) {
            $('#fileEnImg').attr('value', res.data.srcmaster);
            $('#fileSEnImg').attr('value', res.data.src);
            $("#imgeNPath").attr('src', res.data.src);
            $("#imgeNPath").attr('width', '65px');
            $("#imgeNPath").attr('height', '65px');
        }
    });

    layui.upload({
        url: deurl +'/hdadmin/uploadfile'
        , ext: 'jpg|png|gif|jpeg'
        ,elem: '#zhImg'
        , success: function (res) {
            $('#fileZhImg').attr('value', res.data.srcmaster);
            $('#fileSZhImg').attr('value', res.data.src);
            $("#imgzHPath").attr('src', res.data.src);
            $("#imgzHPath").attr('width', '65px');
            $("#imgzHPath").attr('height', '65px');
        }
    });

})
