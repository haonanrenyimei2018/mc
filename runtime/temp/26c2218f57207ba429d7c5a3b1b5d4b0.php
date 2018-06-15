<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"E:\workplace\mc/application/index\view\personal\info.html";i:1529035213;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">个人信息</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
    <form name="addForm" id="addForm" method="post" action="info">
        <h5>姓名</h5>
        <div class="mui-input-row mui-password">
            <input type="text" class="mui-input-password" data-input-password="5" id="name" name="name" value="<?php echo $user['name']; ?>" >
        </div>
        <h5>手机号</h5>
        <div class="mui-input-row mui-password">
            <input type="number" class="mui-input-password" data-input-password="5" id="phone" name="phone" value="<?php echo $user['phone']; ?>" >
        </div>
        <h5>身份证号</h5>
        <div class="mui-input-row mui-password">
            <input type="text" class="mui-input-password" data-input-password="5" id="idn" name="idn" value="<?php echo $user['idn']; ?>" >
        </div>
        <h5>微信号</h5>
        <div class="mui-input-row mui-password">
            <input type="text" class="mui-input-password" data-input-password="5" id="wechat" name="wechat" value="<?php echo $user['wechat']; ?>" >
        </div>
        <h5>密码</h5>
        <div class="mui-input-row mui-password">
            <input type="password" class="mui-input-password" data-input-password="5" id="password" name="password" value="" >
        </div>
        <div class="mui-button-row">
            <button type="submit" class="mui-btn mui-btn-primary">确认</button>&nbsp;&nbsp;
            <button type="button" class="mui-btn mui-action-back mui-btn-danger">取消</button>
        </div>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    </form>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    $(document).ready(function () {
        $('#addForm').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
    });

    function checkForm() {
        var name = $('#name').val(),
            phone = $('#phone').val(),
            idn = $('#idn').val(),
            wechat = $('#wechat').val();
        if(name == ''){
            mui.toast('姓名不能为空!');
            return false;
        }
        if(phone == ''){
            mui.toast('手机号不能为空!');
            return false;
        }
        if(idn == ''){
            mui.toast('身份证号不能为空!');
            return false;
        }
        if(wechat == '') {
            mui.toast('微信号不能为空!');
            return false;
        }
    }

    function complete(res) {
        if (res.code == 1) {
            otcms.success(res.msg,res.url);
        }else {
            otcms.error(res.msg);
        }
    }
</script>
</body>
</html>