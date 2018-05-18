<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"E:\workplace\mc/application/admin\view\member\edit.html";i:1526548285;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
                    <h5>编辑会员信息</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="add" id="add" method="post" action="edit.html">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">姓名</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $member['name']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">手机号</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $member['phone']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">身份证号</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="idn" id="idn" class="form-control" value="<?php echo $member['idn']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">微信号</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="wechat" id="wechat" class="form-control" value="<?php echo $member['wechat']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">代理类型</label>
                            <div class="input-group col-sm-4">
                                <select name="type" id="type" class="form-control">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($agencyType) || $agencyType instanceof \think\Collection || $agencyType instanceof \think\Paginator): if( count($agencyType)==0 ) : echo "" ;else: foreach($agencyType as $key=>$val): ?>
                                        <option value="<?php echo $key; ?>" <?php if($member['type'] == $key): ?> selected <?php endif; ?>><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">所属区域</label>
                            <div class="input-group col-sm-6">
                                <select name="province" id="province" class="form-control" style="width: auto;">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($provinceData) || $provinceData instanceof \think\Collection || $provinceData instanceof \think\Paginator): if( count($provinceData)==0 ) : echo "" ;else: foreach($provinceData as $key=>$val): ?>
                                        <option value="<?php echo $key; ?>" <?php if($member['province'] == $key): ?> selected <?php endif; ?>><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <select name="city" id="city" class="form-control" style="width: auto;">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($cityData) || $cityData instanceof \think\Collection || $cityData instanceof \think\Paginator): if( count($cityData)==0 ) : echo "" ;else: foreach($cityData as $key=>$val): ?>
                                        <option value="<?php echo $key; ?>" <?php if($member['city'] == $key): ?> selected <?php endif; ?>><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <select name="county" id="county" class="form-control" style="width: auto;">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($countyData) || $countyData instanceof \think\Collection || $countyData instanceof \think\Paginator): if( count($countyData)==0 ) : echo "" ;else: foreach($countyData as $key=>$val): ?>
                                    <option value="<?php echo $key; ?>" <?php if($member['county'] == $key): ?> selected <?php endif; ?>><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <select name="area" id="area" class="form-control" style="width: auto;">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($areaData) || $areaData instanceof \think\Collection || $areaData instanceof \think\Paginator): if( count($areaData)==0 ) : echo "" ;else: foreach($areaData as $key=>$val): ?>
                                    <option value="<?php echo $key; ?>" <?php if($member['area'] == $key): ?> selected <?php endif; ?>><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
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
    $(function (){
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
        $('#province').change(function () {
            var data = {
                province : $(this).val()
            }
            $.post('/admin/area/getRegion.html',data,function (res) {
                $('#city').html('');
                $('#county').html('<option value="0">--请选择--</option>');
                $('#area').html('<option value="0">--请选择--</option>');
                var html = '<option value="0">--请选择--</option>';
                for(var c in res) {
                    html += '<option value="'+c+'">'+res[c]+'</option>';
                }
                $('#city').html(html);
            },'JSON');
        });
        $('#city').change(function () {
            var data = {
                province : $('#province').val(),
                city : $(this).val()
            }
            $('#county').html('<option value="0">--请选择--</option>');
            $('#area').html('<option value="0">--请选择--</option>');
            $.post('/admin/area/getRegion.html',data,function (res) {
                $('#county').html('');
                var html = '<option value="0">--请选择--</option>';
                for(var c in res) {
                    html += '<option value="'+c+'">'+res[c]+'</option>';
                }
                $('#county').html(html);
            },'JSON');

        });

        $('#county').change(function () {
            var data = {
                province : $('#province').val(),
                city : $('#city').val(),
                county : $(this).val()
            }
            $('#area').html('<option value="0">--请选择--</option>');
            $.post('/admin/area/getRegion.html',data,function (res) {
                $('#area').html('');
                var html = '<option value="0">--请选择--</option>';
                for(var c in res) {
                    html += '<option value="'+c+'">'+res[c]+'</option>';
                }
                $('#area').html(html);
            },'JSON');
        });
    });
    function checkForm() {
        var name = $('#name').val(),
            phone = $('#phone').val(),
            idn = $('#idn').val(),
            wechat = $('#wechat').val(),
            type = $('#type').val(),
            province = $('#province').val(),
            city = $('#city').val(),
            county = $('#county').val(),
            area = $('#area').val();
        if(name == '') {
            otcms.error('姓名不能为空!');
            return false;
        }
        if(phone == '' || phone.length < 11){
            otcms.error('请输入正确的手机号!');
            return false;
        }
        if(idn == '' || idn.length < 18) {
            otcms.error('请输入正确的身份证号!');
            return false;
        }
        if(wechat == ''){
            otcms.error('请输入微信号!');
            return false;
        }
        if(type == 0) {
            otcms.error('请选择代理的代理类型!');
            return false;
        }
        if(province == 0) {
            otcms.error('请选择代理所属省份');
            return false;
        }
        if(city == 0) {
            otcms.error('请选择代理所属市!');
            return false;
        }
        
        switch (type) {
            case '3' :
                if(county == 0) {
                    otcms.error('请选择代理所属区县!');
                    return false;
                }
                break;
            case '4' :
                if(county == 0) {
                    otcms.error('请选择代理所属区县!');
                    return false;
                }
                if(area == 0){
                    otcms.error('请选择代理所在城镇!');
                    return false;
                }
                break;
        }
    }
    function complete(res) {
        if(res.code == 1){
            otcms.success(res.msg,res.url);
        }else {
            otcms.error(res.msg);
        }
    }
</script>
</body>
</html>