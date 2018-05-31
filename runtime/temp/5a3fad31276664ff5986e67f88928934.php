<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"E:\workplace\mc/application/index\view\login\register_1.html";i:1527670613;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527650438;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527670571;}*/ ?>
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
    .content p {
        display:block;
        word-break:break-all;
        color: black;
    }
</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">同意协议</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <fieldset style="display: block;background-color: white;">
            <legend style="font-size: 0.9em">协议内容</legend>
            <div class="content" style="height: 300px;"><?php echo $type['agreement']; ?></div>
            <div style="text-align: center;padding-bottom: 0px;">
                <label><input type="checkbox" id="agree" checked>同意协议</label>
            </div>
            <div style="text-align: center;margin-top: 10px;">
                <button type="button" id="next" class="mui-btn mui-btn-link">
                    下一步<span class="mui-icon mui-icon-forward"></span>
                </button>
            </div>
        </fieldset>
    </div>
</div>
<input type="hidden" id="type" value="<?php echo $type['id']; ?>">
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    $(function () {
        mui.init({
            swipeBack:true //启用右滑关闭功能
        });
        var h = window.screen.height - $('header').height();
        $('.content').height(h*0.75);
        $(window).resize(function () {
            var h = window.screen.height - $('header').height();
            $('.content').height(h*0.75);
        });
        $('#next').click(function () {
            var ch = $('#agree').prop('checked');
            if(ch == false) {
                mui.toast('请先同意协议!');
                return false;
            }
            var type = $('#type').val();
            window.location.href = '/index/login/register_2.html?type=' + type;
        });
    });
</script>
</body>
</html>