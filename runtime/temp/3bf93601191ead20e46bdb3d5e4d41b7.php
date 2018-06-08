<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"E:\workplace\mc/application/index\view\money\index.html";i:1528335089;s:58:"E:\workplace\mc/application/index\view\public\_header.html";i:1527832634;s:58:"E:\workplace\mc/application/index\view\public\_footer.html";i:1527832640;}*/ ?>
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
    <h1 class="mui-title">资金记录</h1>
</header>
<div class="mui-content">
    <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): ?>
    <ul class="mui-table-view mui-table-view-striped mui-table-view-condensed" id="lists">
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$val): ?>
            <li class="mui-table-view-cell">
                <div class="mui-table">
                    <div class="mui-table-cell mui-col-xs-10">
                        <h4 class="mui-ellipsis">
                            <?php if($val['model'] == '1'): ?>
                                <?php echo $val['amount']; ?>元
                            <?php else: ?>
                                -<?php echo $val['amount']; ?>元
                            <?php endif; ?>
                        </h4>
                        <h5>类型:<?php echo $return_type[$val['type']]; ?></h5>
                        <p class="mui-h6 mui-ellipsis">
                            <?php echo $val['summary']; ?>
                            <span style="float: right;"><?php echo date('Y-m-d H:i',$val['date']); ?></span>
                        </p>
                    </div>
                </div>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php if($pageCount > '1'): ?>
        <span id="more" onclick="getdata()" class="mui-btn mui-btn-link" style="width: 90%;margin-left:5%;border: solid 1px darkgray;color: #A8A297;color: black">
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
        pageCount = '<?php echo $pageCount; ?>',
        return_type = {};

    function getdata() {
        page++;
        if(page == pageCount) {
            $('#more').hide();
        }
        var data = {
            page : page
        };
        $.post('/index/money/getdata.html',data,function (res) {
            return_type = res.return_type;
            var datas = res.data;
            var html = '';
            for(var i=0;i<datas.length;++i) {
                html += '<li class="mui-table-view-cell">';
                html += '<div class="mui-table">';
                html += '<div class="mui-table-cell mui-col-xs-10">';
                html += '<h4 class="mui-ellipsis">涉及金额:￥'+datas[i].amount+'</h4>';
                html += '<h5>类型:'+return_type[datas[i].type]+'</h5>';
                html += '<p class="mui-h6 mui-ellipsis">'+datas[i].summary+'<span style="float: right;">'+datas[i].date+'</span></p>';
                html += '</div>';
                html += '</div>';
                html += '</li>';
            }
            $('#lists').append(html);
        },'JSON');
    }
</script>



</body>
</html>