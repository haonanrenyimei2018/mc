<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"E:\workplace\mc/application/index\view\shop\index.html";i:1527845072;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">积分商城</h1>
</header>
<div id="pullrefresh" class="mui-content mui-scroll-wrapper">
    <div class="mui-scroll mui-table-view">
        <?php if(is_array($datas) || $datas instanceof \think\Collection || $datas instanceof \think\Paginator): if( count($datas)==0 ) : echo "" ;else: foreach($datas as $key=>$val): ?>
        <div class="mui-card">
            <div class="mui-card-header"><?php echo $val['name']; ?></div>
            <div class="mui-card-content">
                <img src="<?php echo $val['images']; ?>" alt="" width="100%">
            </div>

            <div class="mui-card-content">
                <div class="mui-card-content-inner">
                    <p>库存:<?php echo $val['amount']; ?></p>
                    <p style="color: #333;"><?php echo $val['intro']; ?></p>
                </div>
            </div>
            <div class="mui-card-footer">
                <a class="mui-card-link"></a>
                <a class="mui-card-link">查看详情</a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/mui/js/mui.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/otcms.js"></script>
<script>
    var page = 1,
        pageSize = 15,
        pageCount = '<?php echo $pageCount; ?>';

    $(function () {
        mui.init({
            pullRefresh: {
                container: '#pullrefresh',
                up: {
                    contentrefresh: '正在加载...',
                    callback: pullupRefresh
                }
            }
        });
    });
    function pulldownRefresh() {
    }
    /**
     * 上拉加载具体业务实现
     */
    function pullupRefresh() {
        alert(3);
        if(page >= pageCount) {
            mui('#pullrefresh').pullRefresh().endPullupToRefresh(true);
            return false;
        }
        page++;
        var data = {
            page : page,
            pageSize : pageSize
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
                html += '<a class="mui-card-link"></a><a class="mui-card-link">查看详情</a>';
                html += '</div>';
                html += '</div>';
            }
            mui('#pullrefresh').pullRefresh().endPullupToRefresh();
            $('.mui-table-view').append(html);
        },'JSON');
        // setTimeout(function() {
        //     mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 2)); //参数为true代表没有更多数据了。
        //     var table = document.body.querySelector('.mui-table-view');
        //     var cells = document.body.querySelectorAll('.mui-table-view-cell');
        //     for (var i = cells.length, len = i + 5; i < len; i++) {
        //         var li = document.createElement('li');
        //         li.className = 'mui-table-view-cell';
        //         li.innerHTML = '<a class="mui-navigate-right">Item ' + (i + 1) + '</a>';
        //         table.appendChild(li);
        //     }
        // }, 1500);
    }


</script>
</body>
</html>