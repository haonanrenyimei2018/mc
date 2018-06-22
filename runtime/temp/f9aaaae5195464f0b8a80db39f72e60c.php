<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"F:\workplace\mc/application/index\view\personal\index.html";i:1529599544;s:58:"F:\workplace\mc/application/index\view\public\_header.html";i:1528290617;s:58:"F:\workplace\mc/application/index\view\public\_footer.html";i:1528290617;}*/ ?>
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

<style>
    html,
    body {
        background-color: #efeff4;
    }
    .mui-views,
    .mui-view,
    .mui-pages,
    .mui-page,
    .mui-page-content {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: #efeff4;
    }
    .mui-pages {
        top: 46px;
        height: auto;
    }
    .mui-scroll-wrapper,
    .mui-scroll {
        background-color: #efeff4;
    }
    .mui-page.mui-transitioning {
        -webkit-transition: -webkit-transform 300ms ease;
        transition: transform 300ms ease;
    }
    .mui-page-left {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .mui-ios .mui-page-left {
        -webkit-transform: translate3d(-20%, 0, 0);
        transform: translate3d(-20%, 0, 0);
    }
    .mui-navbar {
        position: fixed;
        right: 0;
        left: 0;
        z-index: 10;
        height: 44px;
        background-color: #f7f7f8;
    }
    .mui-navbar .mui-bar {
        position: absolute;
        text-align: center;
    }
    .mui-android .mui-navbar-inner.mui-navbar-left {
        opacity: 0;
    }
    .mui-ios .mui-navbar-left .mui-left,
    .mui-ios .mui-navbar-left .mui-center,
    .mui-ios .mui-navbar-left .mui-right {
        opacity: 0;
    }
    .mui-navbar .mui-btn-nav {
        -webkit-transition: none;
        transition: none;
        -webkit-transition-duration: .0s;
        transition-duration: .0s;
    }
    .mui-navbar .mui-bar .mui-title {
        display: inline-block;
        width: auto;
    }
    .mui-page-shadow {
        position: absolute;
        right: 100%;
        top: 0;
        width: 16px;
        height: 100%;
        z-index: -1;
        content: '';
    }
    .mui-page-shadow {
        background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
        background: linear-gradient(to right, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
    }
    .mui-navbar-inner.mui-transitioning,
    .mui-navbar-inner .mui-transitioning {
        -webkit-transition: opacity 300ms ease, -webkit-transform 300ms ease;
        transition: opacity 300ms ease, transform 300ms ease;
    }
    .mui-page {
        display: none;
    }
    .mui-pages .mui-page {
        display: block;
    }
    .mui-page .mui-table-view:first-child {
        margin-top: 15px;
    }
    .mui-page .mui-table-view:last-child {
        margin-bottom: 30px;
    }
    .mui-table-view {
        margin-top: 20px;
    }

    .mui-table-view span.mui-pull-right {
        color: #999;
    }
    .mui-table-view-divider {
        background-color: #efeff4;
        font-size: 14px;
    }
    .mui-table-view-divider:before,
    .mui-table-view-divider:after {
        height: 0;
    }
    .head {
        height: 40px;
    }
    #head {
        line-height: 40px;
    }
    .head-img {
        width: 40px;
        height: 40px;
    }
    #head-img1 {
        position: absolute;
        bottom: 10px;
        right: 40px;
        width: 40px;
        height: 40px;
    }
    .update {
        font-style: normal;
        color: #999999;
        margin-right: -25px;
        font-size: 15px
    }
    .mui-fullscreen {
        position: fixed;
        z-index: 20;
        background-color: #000;
    }
    .mui-ios .mui-navbar .mui-bar .mui-title {
        position: static;
    }
</style>
<body class="mui-fullscreen">
<div id="app" class="mui-views">
    <div class="mui-view">
        <div class="mui-navbar">
        </div>
        <div class="mui-pages">
        </div>
    </div>
</div>
<div id="setting" class="mui-page">
    <div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
            <span class="mui-icon mui-icon-left-nav" style="color: #FFFFFF;"></span>
        </button>
        <h1 class="mui-center mui-title">个人中心</h1>
    </div>
    <div class="mui-page-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell mui-media">
                        <a class="mui-navigate-right" href="#account">
                            <img class="mui-media-object mui-pull-left head-img" id="head-img" src="/static/index/images/headImg.png">
                            <div class="mui-media-body">
                                <?php echo $user['name']; ?>
                                <p class='mui-ellipsis'>手机号:<?php echo $user['phone']; ?></p>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <a href="/index/personal/info.html" class="mui-navigate-right">账号与安全</a>
                    </li>
                </ul>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <a href="/index/withdraw/index.html" class="mui-navigate-right">我要提现</a>
                    </li>
                </ul>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <a href="/index/addr/index.html" class="mui-navigate-right">收货地址</a>
                    </li>
                </ul>
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell" style="text-align: center;background-color: red;color: #FFFFFF;">
                        <!--<a type="button" class="mui-btn mui-btn-danger">退出登录</a>-->
                        <a href="/index/login/loginout.html">退出登录</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script src="/static/mui/js/mui.view.js"></script>
<script>
    mui.init();
    //初始化单页view
    var viewApi = mui('#app').view({
        defaultPage: '#setting'
    });
    //初始化单页的区域滚动
    mui('.mui-scroll-wrapper').scroll();
</script>
</body>
</html>