<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"E:\workplace\mc/application/index\view\ad\add.html";i:1528701565;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">发布广告</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <form name="addForm" id="addForm" method="post" action="add">
            <p>广告标题</p>
            <div class="mui-input-row mui-password">
                <input type="text" class="mui-input-password" id="title" name="title" data-input-password="5">
            </div>
            <p>广告类型</p>
            <div class="mui-input-row mui-password">
                <!--<input type="number" class="mui-input-password" id="type" name="type" data-input-password="3">-->
                <select name="type" id="type" class="mui-input-password" style="text-align: center;">
                    <option value="">--请选择--</option>
                    <?php if(is_array($adType) || $adType instanceof \think\Collection || $adType instanceof \think\Paginator): if( count($adType)==0 ) : echo "" ;else: foreach($adType as $key=>$val): ?>
                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <p>广告金额</p>
            <div class="mui-input-row mui-password">
                <input type="number" class="mui-input-password" id="amount" style="width: 95%" name="amount" data-input-password="3">元
            </div>
            <p>广告时间</p>
            <div class="mui-input-row mui-password">
                <input type="number" class="mui-input-password" style="width: 95%" id="months" name="months" data-input-password="3">天
            </div>
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
        var title = $('#title').val(),
            amount = $('#amount').val(),
            type = $('#type').val(),
            months = $('#months').val();

        if(title == '') {
            mui.toast('请输入广告标题');
            return false;
        }
        if(type == '') {
            mui.toast('请选择广告标题');
            return false;
        }
        if(amount == '' || amount <= 0) {
            mui.toast('请输入广告金额');
            return false;
        }
        if(months == '') {
            mui.toast('请输入广告投放时间');
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