<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"F:\workplace\mc/application/admin\view\ad_score\index.html";i:1529596285;s:57:"F:\workplace\mc/application/admin\view\public\header.html";i:1508205842;s:57:"F:\workplace\mc/application/admin\view\public\footer.html";i:1508205842;}*/ ?>
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
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>设置</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <div  class="col-sm-2" style="width: 120px">
                        <div class="input-group" >
                            <a class="btn btn-outline btn-primary" href="<?php echo url('add'); ?>">添加</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th style="width: 5%">ID</th>
                            <th style="width: 10%;text-align: left;">最小金额</th>
                            <th style="width: 10%;text-align: left;">最大金额</th>
                            <th style="width: 10%;text-align: left;">获得积分</th>
                            <th style="width: 10%;text-align: center;">操作</th>
                        </tr>
                        </thead>
                        <tbody id="list-content">
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$val): ?>
                            <tr class="long-td">
                                <td style="width: 5%"><?php echo $val['id']; ?></td>
                                <td style="text-align: left;"><?php echo $val['begin']; ?></td>
                                <td style="text-align: left;"><?php echo $val['end']; ?></td>
                                <td style="text-align: left;"><?php echo $val['score']; ?></td>
                                <td>
                                    <a href="javascript:;" onclick="edit(<?php echo $val['id']; ?>)" class="btn btn-primary btn-xs">
                                        <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                    <a href="javascript:;" onclick="del(<?php echo $val['id']; ?>)" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>



                    </table>
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
    function edit(id) {
        window.location = 'edit.html?id=' + id;
    }

    function del(id) {
        otcms.confirm(id,'del.html');
    }


</script>
</body>
</html>