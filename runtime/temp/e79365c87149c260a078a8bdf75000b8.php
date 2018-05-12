<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"E:\workplace\mc/application/admin\view\area\add.html";i:1526007596;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加行政区域</h5>
                </div>
                <div class="ibox-content">
                    <form name="add" id="add" method="post" action="add">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">省</label>
                            <div class="input-group col-sm-4">
                                <select name="provinceCode" id="province" class="form-control" onchange="provinceChange(this)">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($provinceData) || $provinceData instanceof \think\Collection || $provinceData instanceof \think\Paginator): if( count($provinceData)==0 ) : echo "" ;else: foreach($provinceData as $key=>$val): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">市</label>
                            <div class="input-group col-sm-4">
                                <select name="cityCode" id="city" class="form-control" onchange="cityChange()" ></select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">区县</label>
                            <div class="input-group col-sm-4">
                                <select name="areaCode" id="area" class="form-control" onchange="areaChange()"></select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">编码</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">名称</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/otcms.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
<script>
    $(function () {
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
    });

    function checkForm() {
        var province = $('#province').val(),
            code = $('#code').val(),
            name = $('#name').val();
        if(province == 0) {
            otcms.error('请选择省份!');
            return false;
        }
        if(code == '') {
            otcms.error('编码必须填写!');
            return false;
        }
        if(name == ''){
            otcms.error('名称不能为空!');
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
    //获取城市
    function provinceChange(obj) {
        var data = {
            'province' : $(obj).val()
        }
        $('#code').val($(obj).val());
        $.post('getRegion.html',data,function (res) {
            var html = '<option value="">--请选择--</option>';
            for(var c in res) {
                html += '<option value="'+c+'">'+res[c]+'</option>';
            }
            $('#city').html(html);
        },'JSON');
    }
    //获取区县
    function cityChange() {
        var province = $('#province').val(),
            city = $('#city').val();
        var data = {
            'province' : province,
            'city' : city
        }
        $('#code').val(city);
        $.post('getRegion.html',data,function (res) {
            var html = '<option value="">--请选择--</option>';
            for(var c in res) {
                html += '<option value="'+c+'">'+res[c]+'</option>';
            }
            $('#area').html(html);
        },'JSON');
    }
    function areaChange() {
        var area = $('#area').val();
        $('#code').val(area);
    }


</script>
</body>
</html>