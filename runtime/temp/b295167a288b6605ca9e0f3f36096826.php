<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"E:\workplace\mc/application/admin\view\ranking\index.html";i:1530326383;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
            <h5>排行</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <form id="search" name="search" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label class="col-sm-3 control-label">开始时间:<input type="text" id="start_time" class="form-control" readonly onclick="laydate()" name="start_time" value="<?php echo $startTime; ?>" placeholder="请选择开始时间" /></label>
                                <label class="col-sm-3 control-label">结束时间:<input type="text" id="end_time" readonly class="form-control" onclick="laydate()" name="end_time" value="<?php echo $endTime; ?>" placeholder="请选择结束时间" /></label>
                                <label class="col-sm-3 control-label">前:<input type="text" id="limits" class="form-control" name="limits" value="<?php echo $limits; ?>" placeholder="输入位数" /></label>

                                <span class="input-group-btn">
                                    <button type="button" onclick="static()" class="btn btn-primary"><i class="fa fa-search"></i> 统计</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($isQuery == '1'): ?>
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th style="width: 5%">代理姓名</th>
                            <th style="width: 10%;text-align: left;">佣金(元)</th>
                        </tr>
                        </thead>
                        <tbody id="list-content">
                        <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$val): ?>
                            <tr class="long-td">
                                <td style="width: 5%"><?php echo $val['member']; ?></td>
                                <td style="text-align: left;"><?php echo $val['amount']; ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; else: ?>
                            <td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
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
    });
    function static() {
        var startTime = $('#start_time').val(),
            endTime = $('#endTime').val();
        if(startTime == '') {
            otcms.error('请输入开始时间!');
            return false;
        }
        if(endTime == '') {
            otcms.error('请选择结束时间!');
            return false;
        }
        $('#search').submit();
    }
</script>
</body>
</html>