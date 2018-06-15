<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"E:\workplace\mc/application/index\view\withdraw\index.html";i:1529049924;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">提现记录</h1>
</header>
<nav class="mui-bar mui-bar-tab" style="background-color: white;height: 60px;padding-top: 10px;">
    <a href="add.html" class="mui-btn mui-btn-danger mui-btn-block">我要提现</a>
</nav>
<div class="mui-content">
    <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): ?>
    <div class="mui-card" style="margin-bottom: 15px;">
        <ul class="mui-table-view" id="lists">
            <?php if(is_array($datas) || $datas instanceof \think\Collection || $datas instanceof \think\Paginator): if( count($datas)==0 ) : echo "" ;else: foreach($datas as $key=>$val): ?>
            <li class="mui-table-view-cell">
                <a href="detail.html?id=<?php echo $val['id']; ?>" class="mui-navigate-right">
                    <?php echo $val['title']; ?>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <?php if($pageCount > '1'): ?>
    <span id="more" class="mui-btn mui-btn-link" style="width: 90%;margin-left:5%;border: solid 1px darkgray;color: #A8A297;color: black">
            查看更多
        </span>
    <?php endif; else: ?>
    <p style="text-align: center;margin-top: 20px;font-size: 1.5em;">--暂无数据--</p>
    <?php endif; ?>



</div>




<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
</body>
</html>