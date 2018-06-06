<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"F:\workplace\mc/application/index\view\index\index.html";i:1528292410;s:58:"F:\workplace\mc/application/index\view\public\_header.html";i:1528290617;s:58:"F:\workplace\mc/application/index\view\public\_footer.html";i:1528290617;}*/ ?>
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
<!-- header -->
<header class="mui-bar mui-bar-nav">
    <h1 class="mui-title">首页</h1>
</header>
<!-- 图片轮播 -->
<div id="slider" class="mui-slider" >
    <div class="mui-slider-group mui-slider-loop">

    </div>
</div>
<div class="mui-content">
    <ul class="mui-table-view mui-grid-view mui-grid-9">
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
            <a href="/index/notice/index.html">
                <img src="/static/index/images/notice.png" width="64px" height="64px">
                <div class="mui-media-body">公司公告</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
            <a href="#">
                <img src="/static/index/images/cursor.png" width="64px" height="64px">
                <div class="mui-media-body">培训课程</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
            <a href="/index/ad/index.html">
                <img src="/static/index/images/ad.png" width="64px" height="64px">
                <div class="mui-media-body">我的广告</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
            <a href="/index/finance/index.html">
                <img src="/static/index/images/caiwu.png" width="64px" height="64px">
                <div class="mui-media-body">财务管理</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
            <a href="/index/money/index.html">
                <img src="/static/index/images/zijin2.png" width="64px" height="64px">
                <div class="mui-media-body">资金记录</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4">
            <a href="/index/shop/index.html">
                <img src="/static/index/images/shop.png" width="64px" height="64px">
                <div class="mui-media-body">积分商城</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="float: right;">
            <a href="/index/login/loginout.html">
                <img src="/static/index/images/quite.png" width="64px" height="64px">
                <div class="mui-media-body">退出系统</div>
            </a>
        </li>
    </ul>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    mui.init();
</script>
</body>
</html>