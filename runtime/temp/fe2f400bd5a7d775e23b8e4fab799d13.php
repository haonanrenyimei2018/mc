<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"F:\workplace\mc/application/index\view\login\index.html";i:1528899633;s:58:"F:\workplace\mc/application/index\view\public\_header.html";i:1528290617;s:58:"F:\workplace\mc/application/index\view\public\_footer.html";i:1528290617;}*/ ?>
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
    <h1 class="mui-title">登陆</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded" style="margin-top: 1em;">
        <button type="button" id="tongcheng" class="mui-btn mui-btn-primary mui-btn-block mui-btn-outlined">微同城</button>
        <button type="button" id="quancheng" class="mui-btn mui-btn-danger mui-btn-block mui-btn-outlined">微全城</button>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    $(document).ready(function () {
        mui.init();
        //微全城
        $('#quancheng').click(function () {
            window.location.href = '/index/login/login.html';
        });
        //微同城
        $('#tongcheng').click(function () {
            window.location.href = 'http://e.cnsg.cc';
        });
    });
</script>
</body>
</html>