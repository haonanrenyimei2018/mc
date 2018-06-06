<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"F:\workplace\mc/application/index\view\finance\index.html";i:1528293009;s:58:"F:\workplace\mc/application/index\view\public\_header.html";i:1528290617;s:58:"F:\workplace\mc/application/index\view\public\_footer.html";i:1528290617;}*/ ?>
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
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF"></a>
    <h1 class="mui-title">财务管理</h1>
</header>
<div class="mui-content">
    <div class="mui-card">
        <ul class="mui-table-view">
            <li class="mui-table-view-cell">
                累计业绩
                <span class="mui-badge mui-badge-primary"><?php echo $info['performance']; ?></span>
            </li>
            <li class="mui-table-view-cell">
                可提现金额
                <span class="mui-badge mui-badge-primary"><?php echo $info['money']; ?></span>
            </li>
            <li class="mui-table-view-cell">
                累计佣金
                <span class="mui-badge mui-badge-primary"><?php echo $info['commission']; ?></span>
            </li>
            <li class="mui-table-view-cell">
                累计积分
                <span class="mui-badge mui-badge-primary"><?php echo $info['score']; ?></span>
            </li>
        </ul>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
</body>
</html>