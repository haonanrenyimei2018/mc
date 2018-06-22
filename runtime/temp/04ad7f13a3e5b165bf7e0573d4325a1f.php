<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"F:\workplace\mc/application/admin\view\score_roles\edit.html";i:1529421701;s:57:"F:\workplace\mc/application/admin\view\public\header.html";i:1508205842;s:57:"F:\workplace\mc/application/admin\view\public\footer.html";i:1508205842;}*/ ?>
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
                    <h5>编辑积分规则</h5>
                </div>
                <div class="ibox-content">
                    <form name="add" class="form-horizontal" id="add" method="post" action="edit.html">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">类型</label>
                            <div class="input-group col-sm-4">
                                <select name="model" id="model" class="form-control">
                                    <?php if(is_array($model) || $model instanceof \think\Collection || $model instanceof \think\Paginator): if( count($model)==0 ) : echo "" ;else: foreach($model as $key=>$val): ?>
                                    <option value="<?php echo $key; ?>" <?php if($data['model'] == $key): ?> selected <?php endif; ?> ><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">规则</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo $data['title']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">积分</label>
                            <div class="input-group col-sm-4">
                                <input type="number" name="amount" id="amount" class="form-control" value="<?php echo $data['amount']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
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
    $(function () {
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
    });
    function checkForm() {
        var title = $('#title').val(),
            amount = $('#amount').val();
        if(title == '') {
            otcms.error('规则不能为空!');
            return false;
        }
        if(amount == '' || amount <= 0) {
            otcms.error('积分必须大于0');
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