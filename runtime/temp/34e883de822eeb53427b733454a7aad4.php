<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\workplace\mc/application/index\view\login\login.html";i:1527662488;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>登陆</title>
    <link rel="stylesheet" href="/static/index/css/login.css" />
</head>
<body>
<div class="loginmain">
    <form name="login" id="login" action="doLogin" method="post">
        <ul>
            <li class="li_tel"><input type="text" class="txtipnput tel" name="username" id="user_name" placeholder="手机/邮箱"></li>
            <li class="li_pwd"><input type="password" class="txtipnput pwd" name="userPwd" id="userPwd" placeholder="密码"></li>
            <li>
                <input type="submit" class="btn submit" value="登录">
                <input type="button" class="btn regbtn" id="regbtn" value="注册">
            </li>
            <!--<li style="text-align:right; line-height:30px;"><a href="">还没有账号,立即注册？</a></li>-->
        </ul>
    </form>
</div>
<div class="xy">登录即代表您已同意我们的 <a href="">服务协议</a> 和 <a href="">隐私政策</a></div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    $(document).ready(function () {
        $('#login').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
        $('#regbtn').click(function () {
            window.location.href = '/index/login/register.html';
        });
    });

    function checkForm() {
        var user_name = $('#user_name').val(),
            password = $('#userPwd').val();
        if(user_name == '') {
            otcms.error('用户名/手机号不能为空!');
            return false;
        }
        if(password == ''){
            otcms.error('请输入密码!');
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