<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"F:\workplace\mc/application/index\view\course\index.html";i:1528461024;s:58:"F:\workplace\mc/application/index\view\public\_header.html";i:1528290617;s:58:"F:\workplace\mc/application/index\view\public\_footer.html";i:1528290617;}*/ ?>
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
    <h1 class="mui-title">培训课程</h1>
</header>
<div class="mui-content">
    <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): ?>
    <div class="mui-card" style="margin-bottom: 15px;">
        <ul class="mui-table-view" id="lists">
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$val): ?>
            <li class="mui-table-view-cell">
                <a href="detail.html?id=<?php echo $val['id']; ?>" class="mui-navigate-right">
                    <?php if($val['type'] == '1'): ?>
                        <span style="color: red;">[未读]</span>
                    <?php endif; ?>
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