<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"E:\workplace\mc/application/index\view\ad\detail.html";i:1528256903;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>微同城</title>
    <link rel="stylesheet" href="/static/mui/css/mui.css">
</head>

<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF;"></a>
    <h1 class="mui-title">广告详情</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <p>广告标题</p>
        <h4><?php echo $data['title']; ?></h4>
        <p>广告类型</p>
        <h4><?php echo $data['type_name']; ?></h4>
        <p>广告金额</p>
        <h4><?php echo $data['amount']; ?>元</h4>
        <p>广告时间</p>
        <h4><?php echo $data['months']; ?>天</h4>
        <p>状态</p>
        <h4>
            <?php switch($data['status']): case "0": ?> 未审核 <?php break; case "1": ?> 审核通过 <?php break; case "2": ?> 审核驳回 <?php break; endswitch; ?>
        </h4>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
</body>
</html>