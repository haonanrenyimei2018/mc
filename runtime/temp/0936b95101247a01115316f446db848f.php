<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"F:\workplace\mc/application/admin\view\ad\check.html";i:1528726805;s:57:"F:\workplace\mc/application/admin\view\public\header.html";i:1508205842;s:57:"F:\workplace\mc/application/admin\view\public\footer.html";i:1508205842;}*/ ?>
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
                    <h5>广告审核</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="add" id="add" method="post" action="add">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">广告标题</label>
                            <div class="input-group col-sm-4">
                                <span class="form-control"><?php echo $info['title']; ?></span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">广告类型</label>
                            <div class="input-group col-sm-4">
                                <span class="form-control"><?php echo $info['type_name']; ?></span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">广告金额</label>
                            <div class="input-group col-sm-4">
                                <span class="form-control"><?php echo $info['amount']; ?></span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">广告期限</label>
                            <div class="input-group col-sm-4">
                                <span class="form-control"><?php echo $info['months']; ?>天</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" onclick="check(1)"><i class="fa fa-save"></i> 审核</button>&nbsp;&nbsp;
                                <button class="btn btn-danger" type="button" onclick="check(-1)"><i class="fa fa-save"></i> 驳回</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                        <input type="hidden" id="id" value="<?php echo $info['id']; ?>">
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
    function check(state) {
        var data = {
            id : $('#id').val(),
            state : state
        };
        layer.confirm('确认执行此操作吗?', {icon: 3, title:'提示'}, function(index){
            $.post('check.html',data,function (res) {
                if(res.code == 1){
                    otcms.success(res.msg,res.url);
                }else {
                    otcms.error(res.msg);
                }
            },'JSON');
        });
    }
</script>
</body>
</html>