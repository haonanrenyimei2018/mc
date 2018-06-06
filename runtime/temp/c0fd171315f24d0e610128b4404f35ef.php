<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"E:\workplace\mc/application/index\view\notice\detail.html";i:1528169360;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">公司公告</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <h4><?php echo $data['title']; ?></h4>
        <h5>作者: <?php echo $members[$data['user']]; ?>&nbsp;发布时间:<?php echo date('Y-m-d',$data['date']); ?>&nbsp;</h5>
        <div>
            <?php echo $data['content']; ?>
        </div>
        <h5>人气:<?php echo $data['times']; ?></h5>
    </div>
</div>







<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
</body>
</html>