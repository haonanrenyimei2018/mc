<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"E:\workplace\mc/application/index\view\shop\detail.html";i:1528363601;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    body {
    }
    h4 {
        margin-left: 15px;
        font-size: 20px;
    }
    .label {
        width: 100%;
        margin-top: 10px;
        /*background-color: #FFFFFF;*/
        text-align: center;
        color: #A8A297;
    }
    .content {
        background-color: #FFFFFF;
        margin-top: 5px;
        padding: 5px 10px;
    }
</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF"></a>
    <h1 class="mui-title">商品详情</h1>
</header>
<nav class="mui-bar mui-bar-tab" style="background-color: #FFFFFF;line-height: 40px;">
    <span style="float: left;margin-left: 10px;">所需积分:<?php echo $info['sources']; ?></span>
    <span style="float: right;margin-right: 10px;">
        <?php if($user_score > $info['sources']): ?>
            <button type="button" class="mui-btn mui-btn-primary mui-btn-outlined" onclick="doAction()">立即兑换</button>
        <?php else: ?>
            <button type="button" class="mui-btn mui-btn-outlined">立即兑换</button>
        <?php endif; ?>
    </span>
</nav>
<div class="mui-content" style="padding-bottom: 10px;">
    <div id="slider" class="mui-slider" style="margin: 10px 10px 10px 0px;" >
        <div class="mui-slider-group mui-slider-loop">
            <div class="mui-slider-item">
                <a href="#">
                    <img src="<?php echo $info['images']; ?>">
                </a>
            </div>
        </div>
    </div>
    <h4>
        <?php echo $info['name']; ?>
    </h4>
</div>
<div class="label">--产品详情--</div>
<div class="content">
    <?php echo $info['content']; ?>
</div>
<input type="hidden" id="id" value="<?php echo $info['id']; ?>">
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    //立即兑换
    function doAction() {
        var data = {
            id : $('#id').val()
        };
        $.post('/index/shop/buy.html',data,function (res) {
            if(res.code == 1) {
                otcms.success(res.msg,res.url);
            }else {
                otcms.error(res.msg);
            }
        },'JSON');
    }
</script>
</body>
</html>