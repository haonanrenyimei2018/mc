<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"F:\workplace\mc/application/index\view\addr\index.html";i:1529600939;s:58:"F:\workplace\mc/application/index\view\public\_header.html";i:1528290617;s:58:"F:\workplace\mc/application/index\view\public\_footer.html";i:1528290617;}*/ ?>
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

<body class="gray-bg">
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF;"></a>
    <h1 class="mui-title">我的收货地址</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <form name="addForm" id="addForm" method="post" action="index">
            <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): ?>
                <p>收货地址</p>
                <div class="mui-input-row mui-password">
                    <input type="text" class="mui-input-password" id="addr" name="addr" data-input-password="5" value="<?php echo $data['addr']; ?>">
                </div>
                <p>联系电话</p>
                <div class="mui-input-row mui-password">
                    <input type="text" class="mui-input-password" id="phone" name="phone" data-input-password="5" value="<?php echo $data['phone']; ?>">
                </div>
                <p>衣服号码</p>
                <div class="mui-input-row mui-password">
                    <input type="text" class="mui-input-password" id="size" name="size" data-input-password="5" value="<?php echo $data['size']; ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <?php else: ?>
                <p>收货地址</p>
                <div class="mui-input-row mui-password">
                    <input type="text" class="mui-input-password" id="addr" name="addr" data-input-password="5">
                </div>
                <p>联系电话</p>
                <div class="mui-input-row mui-password">
                    <input type="text" class="mui-input-password" id="phone" name="phone" data-input-password="5">
                </div>
                <p>衣服号码</p>
                <div class="mui-input-row mui-password">
                    <input type="text" class="mui-input-password" id="size" name="size" data-input-password="5">
                </div>
                <input type="hidden" name="id" value="0">
            <?php endif; ?>

            <div class="mui-button-row">
                <button type="submit" class="mui-btn mui-btn-primary">确认</button>&nbsp;&nbsp;
                <button type="button" class="mui-btn mui-action-back mui-btn-danger">取消</button>
            </div>

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
        var addr = $('#addr').val(),
            phone = $('#phone').val(),
            size = $('#size').val();

        if(addr == '') {
            mui.toast('请输入收货地址');
            return false;
        }
        if(phone == '') {
            mui.toast('请输入联系电话');
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