<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"E:\workplace\mc/application/index\view\login\register_2.html";i:1527673647;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527650438;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527670571;}*/ ?>
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
    <h1 class="mui-title">注册</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <form name="add" id="add" method="post" action="register_2">
            <div class="mui-input-group">
                <div class="mui-input-row">
                    <label>用户名</label>
                    <input type="text" name="username" id="username" placeholder="请输入用户名">
                </div>
                <div class="mui-input-row">
                    <label>密码</label>
                    <input type="password" name="password" id="password" placeholder="请输入密码">
                </div>
                <div class="mui-input-row">
                    <label>确认密码</label>
                    <input type="password" id="re_password" placeholder="请再次输入密码">
                </div>
            </div>
            <div class="mui-input-group">
                <div class="mui-input-row">
                    <label>姓名</label>
                    <input type="text" name="name" id="name" placeholder="请输入姓名">
                </div>
                <div class="mui-input-row">
                    <label>手机号</label>
                    <input type="phone" name="phone" id="phone" placeholder="请输入手机号">
                </div>
                <div class="mui-input-row">
                    <label>身份证号</label>
                    <input type="text" name="idn" id="idn" placeholder="请输入身份证号">
                </div>
                <div class="mui-input-row">
                    <label>微信号</label>
                    <input type="text" name="wechat" id="wechat" placeholder="请输入微信号">
                </div>
                <div class="mui-input-group">
                    <div class="mui-button-row">
                        <button class="mui-btn mui-btn-primary" type="submit" >确认</button>&nbsp;&nbsp;
                        <button class="mui-btn mui-btn-danger" type="button">取消</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="type" value="<?php echo $type; ?>">
        </form>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    $(function () {
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
    });
    function checkForm() {
        var username = $('#username').val(),
            password = $('#password').val(),
            re_password = $('#re_password').val(),
            name = $('#name').val(),
            phone = $('#phone').val(),
            idn = $('#idn').val(),
            wechat = $('#wechat').val();
        if(username == '') {
            mui.toast('用户名不能为空!');
            return false;
        }
        if(password == '') {
            mui.toast('密码不能为空!');
            return false;
        }
        if(re_password != password) {
            mui.toast('两次密码不一致!');
            return false;
        }
        if(name == '') {
            mui.toast('请输入姓名!');
            return false;
        }
        if(phone == '') {
            mui.toast('请输入手机号!');
            return false;
        }
        if(idn == '') {
            mui.toast('请输入身份证号');
            return false;
        }
        if(wechat == '') {
            mui.toast('请输入微信号!');
            return false;
        }
    }
    function complete(res) {
        if(res.code == 1) {
            otcms.success(res.msg,res.url);
        }else {
            otcms.error(res.msg);
        }
    }



</script>
</body>
</html>