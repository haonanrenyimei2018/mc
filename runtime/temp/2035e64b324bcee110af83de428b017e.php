<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"E:\workplace\mc/application/admin\view\area\index.html";i:1525946250;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
            <h5>行政区域列表</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <div  class="col-sm-2" style="width: 100px">
                        <div class="input-group" >
                            <button class="btn btn-outline btn-primary" onclick="add()" type="button">添加行政区域</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="long-tr">
                            <th>ID</th>
                            <th style="text-align: left;">区域名称</th>
                            <th>区域编码</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($datas) || $datas instanceof \think\Collection || $datas instanceof \think\Paginator): if( count($datas)==0 ) : echo "" ;else: foreach($datas as $key=>$val): ?>
                        <tr class="long-td">
                            <td><?php echo $key+1; ?></td>
                            <td style="text-align: left;">
                                <span onclick="index(<?php echo $val['code']; ?>)"><?php echo $val['name']; ?></span>
                            </td>
                            <td><?php echo $val['code']; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="province" id="province" value="<?php echo $province; ?>">
<input type="hidden" name="city" id="city" value="<?php echo $city; ?>">
<input type="hidden" name="area" id="area">
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
    function index(code) {
        var province = $('#province').val(),
            city = $('#city').val(),
            area = $('#area').val();
        if(province == 0) {
            province = code;
        }else {
            if(city == 0) {
                city = code;
            }else {
                if(area == 0) {
                    area = code;
                }
            }
        }
        window.location.href = 'index.html?province=' + province + '&city=' + city + '&county=' + area;
    }
    function add() {
        var province = $('#province').val(),
            city = $('#city').val(),
            area = $('#area').val();
        window.location.href = 'add.html?province=' + province + '&city=' + city + '&county=' + area;
    }
</script>



</body>
</html>