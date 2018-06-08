<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:51:"E:\workplace\mc/application/index\view\shop\my.html";i:1528425771;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
<header class="mui-bar mui-bar-nav" >
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color: #FFFFFF;"></a>
    <h1 class="mui-title">我兑换的产品</h1>
</header>
<div id="pullrefresh" class="mui-content mui-scroll-wrapper" style="overflow: auto">
    <div class="mui-scroll mui-table-view">
        <?php if(is_array($datas) || $datas instanceof \think\Collection || $datas instanceof \think\Paginator): if( count($datas)==0 ) : echo "" ;else: foreach($datas as $key=>$val): ?>
        <div class="mui-card" style="margin: 0;">
            <div class="mui-card-header"><?php echo $val['product']['name']; ?></div>
            <div class="mui-card-content">
                <img src="<?php echo $val['product']['images']; ?>" alt="" width="100%">
            </div>
            <div class="mui-card-content">
                <div class="mui-card-content-inner">
                    <p style="color: #333;"><?php echo $val['product']['intro']; ?></p>
                </div>
            </div>
            <div class="mui-card-footer">
                <a class="mui-card-link"></a>
                <a href="detail.html?id=<?php echo $val['product']['id']; ?>" class="mui-card-link">查看详情</a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php if($pageCount > '1'): ?>
    <span id="more" onclick="getdata()" class="mui-btn mui-btn-link" style="width: 90%;margin-left:5%;border: solid 1px darkgray;color: #A8A297;color: black">
        查看更多
    </span>
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

    $(function () {
    });
    function getdata() {
        page++;
        if(page == pageCount) {
            $('#more').hide();
        }
        var data = {
            page : page
        }
        $.get('/index/shop/getdata.html',data,function (res) {
            var html = '';
            for(var i=0;i<res.length;++i) {
                html += '<div class="mui-card">';
                html += '<div class="mui-card-header">'+ res[i].name +'</div>';
                html += '<div class="mui-card-content">';
                html += '<img src="'+ res[i].images +'" alt="" width="100%">';
                html += '</div>';
                html += '<div class="mui-card-content">';
                html += '<div class="mui-card-content-inner">';
                html += '<p>库存:' +res[i].amount+ '</p>';
                html += '<p style="color: #333;">'+ res[i].intro +'</p>';
                html += '</div>';
                html += '</div>';
                html += '<div class="mui-card-footer">';
                html += '<a href="detail.html?id='+res[i].id+'" class="mui-card-link"></a><a class="mui-card-link">查看详情</a>';
                html += '</div>';
                html += '</div>';
            }
            $('.mui-table-view').html(html);
        },'JSON');
    }
</script>

</body>
</html>