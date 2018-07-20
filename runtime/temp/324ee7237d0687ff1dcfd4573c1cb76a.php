<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"E:\workplace\mc/application/index\view\course\detail.html";i:1532070039;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    .content {
        /*word-break: break-all;*/
        word-wrap: break-word;
        /*white-space: pre-wrap;*/
    }
</style>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF;"></a>
    <h1 class="mui-title">培训资料详情</h1>
</header>
<div class="mui-content">
    <div class="mui-content-padded">
        <?php if($info['model'] == '1'): ?>
        <h4><?php echo $info['title']; ?></h4>
        <h5>作者: <?php echo $members[$info['user']]; ?>&nbsp;发布时间:<?php echo date('Y-m-d',$info['date']); ?>&nbsp;</h5>
        <div class="content">
            <?php echo $info['content']; ?>
        </div>
        <h5>人气:<?php echo $info['times']; ?></h5>
        <?php else: if(is_array($images) || $images instanceof \think\Collection || $images instanceof \think\Paginator): if( count($images)==0 ) : echo "" ;else: foreach($images as $key=>$val): if($key == '0'): ?>
                    <span style="display: block;margin: 10px;" name="images" id="image_<?php echo $key; ?>">
                        <img width="100%" height="100%"  src="<?php echo $val['images']; ?>" >
                    </span>
                    <?php else: ?>
                    <span style="display: none;margin: 10px;" name="images" id="image_<?php echo $key; ?>">
                        <img width="100%" height="100%"  src="<?php echo $val['images']; ?>" >
                    </span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <span style="margin-bottom: 10px;text-align: center;width: 100%">
                <select style="width: 40px;margin-left: 40%" id="pages" onchange="change()">
                    <?php if(is_array($images) || $images instanceof \think\Collection || $images instanceof \think\Paginator): if( count($images)==0 ) : echo "" ;else: foreach($images as $key=>$val): ?>
                        <option value="<?php echo $key; ?>"><?php echo $key + 1; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </span>
        <?php endif; ?>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    function change() {
        $('span[name="images"]').hide();
        var id = $('#pages').val();
        console.log(id);
        $('#image_' + id).show();

    }



</script>
</body>
</html>