<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"E:\workplace\mc/application/index\view\login\register.html";i:1531924454;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1531230408;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1531230408;}*/ ?>
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
        <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): if( count($types)==0 ) : echo "" ;else: foreach($types as $key=>$val): ?>
            <button type="button" name="types" value="<?php echo $val['id']; ?>" class="mui-btn mui-btn-primary mui-btn-block mui-btn-outlined"><?php echo $val['name']; ?></button>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<input type="hidden" name="yaoqing" id="yaoqing" value="<?php echo $yaoqing; ?>">
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    mui.init({
        swipeBack:true //启用右滑关闭功能
    });
    $(function () {
        $('button[name=types]').click(function () {
            var type = $(this).val();
            var yaoqing = $('#yaoqing').val();
            if(yaoqing == '1'){
                alert(1);
                window.location.href = '/index/login/jump.html?type=' + type;
            }else {
                alert(2);
                window.location.href = '/index/login/register_1.html?type=' + type;
            }
            // window.location.href = '/index/login/register_1.html?type=' + type;
            // var type = $(this).val();
            // var btnArray = ['取消', '确定'];
            // mui.prompt('请输入邀请码:', '', '提示', btnArray, function(e) {
            //     if (e.index == 1) {
            //         var code = e.value;
            //         $.getJSON('/index/login/checkCode.html',{'code' : code},function (res) {
            //             if(res.code == 1) {
            //                 window.location.href = '/index/login/register_1.html?type=' + type;
            //             }else {
            //                 otcms.error(res.msg);
            //                 return false;
            //             }
            //         });
            //     }
            // })
        });
    });
</script>
</body>
</html>