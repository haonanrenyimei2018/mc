<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"E:\workplace\mc/application/index\view\withdraw\add.html";i:1529051247;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">提现</h1>
</header>
<div class="mui-content" style="margin-top: 10px;">
    <div class="mui-content-padded">
        <form name="addForm" id="addForm" method="post" action="add" >
            <h5>提现金额</h5>
            <div class="mui-input-row mui-password">
                <input type="number" name="amount" id="amount" class="mui-input-password" data-input-password="5">
                <span style="color: #9e9e9e;background-color: #ffffff;">
                    <span style="float: left;font-size: 16px">可用余额:<?php echo $info['money']; ?></span>
                    <span style="float: right;color: #0e9aef;">
                        全部提现
                    </span>
                </span>
            </div>
            <div class="mui-button-row">
                <button type="button" class="mui-btn mui-btn-primary mui-btn-block">提现</button>
            </div>
        </form>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
</body>
</html>