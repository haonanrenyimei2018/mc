<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"E:\workplace\mc/application/index\view\ad\index.html";i:1528255458;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">我的广告</h1>
</header>
<nav class="mui-bar mui-bar-tab" style="background-color: white;height: 60px;padding-top: 10px;">
    <a href="add.html" class="mui-btn mui-btn-danger mui-btn-block">发布广告</a>
</nav>
<div class="mui-content">
    <?php if(!(empty($datas) || (($datas instanceof \think\Collection || $datas instanceof \think\Paginator ) && $datas->isEmpty()))): ?>
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
<script>
    var page = 1,
        pageCount = '<?php echo $pageCount; ?>';
    $(document).ready(function () {
    });
    function getData() {
        page ++;
        if(page == pageCount){
            $('#more').hide();
        }
        var data = {
            'page' : page
        }
        $.post('/index/ad/getdata.html',data,function (res) {
            var html = '';
            for(var i=0;i<res.length;++i) {
                html += '<li class="mui-table-view-cell"><a class="mui-navigate-right">'+res[i].title+'</a></li>';
            }
            $('#lists').append(html);
        },'JSON');
    }
</script>
</body>
</html>