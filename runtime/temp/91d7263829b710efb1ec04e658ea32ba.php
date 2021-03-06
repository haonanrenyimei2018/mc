<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"E:\workplace\mc/application/admin\view\course\detail.html";i:1532484372;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
                    <h5>课程详情</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">标题</label>
                            <div class="input-group col-sm-4">
                                <span class="form-control"><?php echo $info['title']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: right">类型</label>
                        <div class="input-group col-sm-4">
                            <span class="form-control">
                                <?php if($info['model'] == '1'): ?>
                                    图文
                                <?php else: ?>
                                    图片
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" style="text-align: right">分类</label>
                        <div class="input-group col-sm-4">
                            <span class="form-control"><?php echo $types[$info['type']]; ?></span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <?php if($info['model'] == '1'): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">内容</label>
                            <div class="input-group col-sm-6">
                                <span class="form-control"><?php echo $types[$info['type']]; ?></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">图片</label>
                            <div class="input-group col-sm-9" id="loans_images">
                                <?php if(is_array($images) || $images instanceof \think\Collection || $images instanceof \think\Paginator): if( count($images)==0 ) : echo "" ;else: foreach($images as $key=>$val): ?>
                                <span style="width: 100px;height: 100px;display: block;float: left;margin-left: 10px;position:relative;">
                                    <img src="<?php echo $val['images']; ?>" width="100px" height="100px" style="margin-right: 10px;" />
                                </span>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="input-group col-sm-4 col-sm-offset-3">
                            <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                        </div>
                    </div>
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

</script>
</body>
</html>