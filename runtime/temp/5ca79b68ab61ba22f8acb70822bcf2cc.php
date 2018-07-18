<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"E:\workplace\mc/application/index\view\login\jump.html";i:1531925131;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1531230408;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1531230408;}*/ ?>
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
    <h1 class="mui-title">输入邀请码</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <div class="mui-input-group">
            <div class="mui-input-row">
                <label>邀请码</label>
                <input type="text" name="code" id="code" placeholder="请输入邀请码">
            </div>
        </div>
        <button type="button" class="mui-btn mui-btn-primary mui-btn-block" onclick="check()" style="margin-top: 10px;">确定</button>
        <input type="hidden" name="type" id="type" value="<?php echo $type; ?>">
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
function check(){
    var code = $('#code').val();
    if(code == ''){
        mui.toast('请输入邀请码');
        return false;
    }
    $.getJSON('/index/login/checkCode.html',{'code' : code},function (res) {
        var type = $('#type').val();
        if(res.code == 1) {
            window.location.href = '/index/login/register_1.html?type=' + type;
        }else {
            otcms.error(res.msg);
            return false;
        }
    });
}
function btn_cancle(){
    window.history.back(-1);
}




</script>
</body>
</html>