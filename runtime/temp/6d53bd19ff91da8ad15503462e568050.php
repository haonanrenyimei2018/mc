<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"F:\workplace\mc/application/admin\view\score\add.html";i:1529506184;s:57:"F:\workplace\mc/application/admin\view\public\header.html";i:1508205842;s:57:"F:\workplace\mc/application/admin\view\public\footer.html";i:1508205842;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加积分记录</h5>
                </div>
                <div class="ibox-content">
                    <form name="add" class="form-horizontal" id="add" method="post" action="add">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">类型</label>
                            <div class="input-group col-sm-4">
                                <select name="type" id="type" class="form-control">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($model) || $model instanceof \think\Collection || $model instanceof \think\Paginator): if( count($model)==0 ) : echo "" ;else: foreach($model as $key=>$val): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">规则</label>
                            <div class="input-group col-sm-4">
                                <select name="roles" id="roles" class="form-control">
                                    <option value="0">--请选择--</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">积分</label>
                            <div class="input-group col-sm-4">
                                <input type="number" id="amount" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">备注</label>
                            <div class="input-group col-sm-4">
                                <textarea name="summary" id="summary" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                        <input type="hidden" name="mid" value="<?php echo $id; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/otcms.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
<script>
    var roles = {};
    $(function () {
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
        $('#type').change(function () {
            $('#roles').html('');
            var data = {
                'model' : $(this).val()
            };
            $.post('/admin/score_roles/getroles.html',data,function (res) {
                var html = '',
                amount = 0;
                for(var i=0;i<res.length;++i) {
                    if(i == 0) {
                        amount = res[i].amount;
                    }
                    roles[res[i].id] = res[i].amount;
                    html += '<option value="'+res[i].id+'">'+res[i].title+'</option>';
                }
                $('#amount').val(amount);
                $('#roles').html(html);
            },'JSON');
        });
        $('#roles').change(function () {
            var id = $('#roles').val();
            if(id > 0) {
                var amount = roles[id];
                $('#amount').val(amount);
            }
        });
    });
    function checkForm() {
        var source = $('#amount').val();
        if(source == '' || source <= 0){
            otcms.error('请填写正确的积分!');
            return false;
        }
    }
    function complete(res) {
        if(res.code == 1) {
            otcms.success(res.msg,res.url);
        }else {
            otcms.error(res.msg);
        }
    }
</script>



</body>
</html>