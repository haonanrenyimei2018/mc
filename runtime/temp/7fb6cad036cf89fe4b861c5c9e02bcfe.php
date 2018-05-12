<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"E:\workplace\mc/application/admin\view\agency_type\add.html";i:1525934374;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/style.css">
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加代理类型</h5>
                </div>
                <div class="ibox-content">
                    <form name="add" id="add" method="post" action="add">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: right">代理名称</label>
                        <div class="input-group col-sm-4">
                            <input id="name" type="text" class="form-control" name="name" >
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: right">代理类型</label>
                        <div class="input-group col-sm-4">
                            <input id="type" type="text" class="form-control" name="type" >
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: right">代理费用</label>
                        <div class="input-group col-sm-4">
                            <input id="money" type="number" class="form-control" name="money" >
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: right">代理协议</label>
                        <div class="input-group col-sm-8">
                            <script src="/static/admin/ueditor/ueditor.config.js" type="text/javascript"></script>
                            <script src="/static/admin/ueditor/ueditor.all.js" type="text/javascript"></script>
                            <textarea name="agreement" id="agreement"></textarea>
                            <script type="text/javascript">
                                var editor = new UE.ui.Editor();
                                editor.render("agreement");
                            </script>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                        </div>
                    </div>
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
    $(function() {
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
    });
    function checkForm() {
        var name = $('#name').val(),
            type = $('#type').val(),
            money = $('#money').val();
        if(name == '') {
            otcms.error('代理名称不能为空!');
            return false;
        }
        if(type == '') {
            otcms.error('代理类型不能为空!');
            return false;
        }
        if(money == '' || money == 0){
            otcms.error('代理费用必须大于0!');
            return false;
        }
    }
    function complete(res) {
        if(res.code == 1){
            otcms.success(res.msg,res.url);
        }else {
            otcms.error(res.msg);
        }
    }


</script>



</body>
</html>