<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"E:\workplace\mc/application/admin\view\course\edit.html";i:1531982485;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/style.css">
<style>
    .file-item{float: left; position: relative; width: 110px;height: 110px; margin: 0 20px 20px 0; padding: 4px;}
    .file-item .info{overflow: hidden;}
    .uploader-list{width: 100%; overflow: hidden;}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑培训课程</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="add" id="add" method="post" action="edit">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">去向</label>
                            <div class="input-group col-sm-4">
                                <?php if(is_array($target) || $target instanceof \think\Collection || $target instanceof \think\Paginator): if( count($target)==0 ) : echo "" ;else: foreach($target as $key=>$val): ?>
                                <label><input type="checkbox" name="target[]" id="target_<?php echo $key; ?>" value="<?php echo $key; ?>"><?php echo $val; ?></label>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">类别</label>
                            <div class="input-group col-sm-4">
                                <select name="model" id="model" class="form-control">
                                    <option value="2" <?php if($data['model'] == '2'): ?> selected <?php endif; ?>>图片分页</option>
                                    <option value="1" <?php if($data['model'] == '1'): ?> selected <?php endif; ?>>图文</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">类型</label>
                            <div class="input-group col-sm-4">
                                <select name="type" id="type" class="form-control">
                                    <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): if( count($types)==0 ) : echo "" ;else: foreach($types as $key=>$val): ?>
                                    <option value="<?php echo $key; ?>" <?php if($data['type'] == $key): ?>selected <?php endif; ?> ><?php echo $val; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">标题</label>
                            <div class="input-group col-sm-4">
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo $data['title']; ?>">
                            </div>
                        </div>
                        <div id="rich" style="display: none;">
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: right">内容</label>
                            <div class="input-group col-sm-8">
                                <script src="/static/admin/ueditor/ueditor.config.js" type="text/javascript"></script>
                                <script src="/static/admin/ueditor/ueditor.all.js" type="text/javascript"></script>
                                <textarea name="content" id="content"><?php echo $data['content']; ?></textarea>
                                <script type="text/javascript">
                                    var editor = new UE.ui.Editor();
                                    editor.render("content");
                                </script>
                            </div>
                        </div>
                        </div>
                        <div id="pic">
                            <script>
                                var images = [],
                                    nums = 0;
                            </script>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: right">上传图片</label>
                                <div class="input-group col-sm-9">
                                    <div id="imgPicker" style="float:left">选择图片</div>
                                    <div class="col-sm-12" id="loans_images">
                                        <?php if(is_array($images) || $images instanceof \think\Collection || $images instanceof \think\Paginator): if( count($images)==0 ) : echo "" ;else: foreach($images as $key=>$val): ?>
                                            <span style="width: 100px;height: 100px;display: block;float: left;margin-left: 10px;position:relative;">
                                                <a style="color:red;font-weight: bold;z-index: 9999;left: 90px; position:relative;top:0px;position: absolute;" onclick="delImg(this)">X</a>
                                                <img src="<?php echo $val['images']; ?>" width="100px" height="100px" style="margin-right: 10px;" />
                                            </span>
                                            <script>
                                                images.push("<?php echo $val['images']; ?>");
                                                nums++;
                                            </script>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                        <input type="hidden" name="images" id="images" value="">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
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
<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>
<script>
    var targets = "<?php echo $data['target']; ?>",
        model = "<?php echo $data['model']; ?>";
    $(function () {

        WebUploader.create({
            auto: true, //选完文件后，是否自动上传。
            swf: '/static/admin/webupload/Uploader.swf',// swf文件路径
            server: "<?php echo url('Upload/upload'); ?>",// 文件接收服务端。
            duplicate :true,//重复上传图片，true为可重复false为不可重复
            pick: '#imgPicker',// 选择文件的按钮。可选。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/jpg,image/jpeg,image/png'
            },
            'onUploadSuccess': function(file, data, response) {
                $('#loans_images').append('<span style="width: 100px;height: 100px;display: block;float: left;margin-left: 10px;position:relative;"><a style="color:red;font-weight: bold;z-index: 9999;left: 90px; position:relative;top:0px;position: absolute;" onclick="delImg(this)">X</a><img src="'+data._raw+'" width="100px" height="100px" style="margin-right: 10px;" /></span>');
                images.push(data._raw);
                ++nums;
                $('#images').val(images.join('|'));
            }
        });

        if(model == 1){
            $('#rich').show();
            $('#pic').hide();
        }else {
            $('#rich').hide();
            $('#pic').show();
        }
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
        var arr = targets.split(',');
        for(var i=0;i<arr.length;++i) {
            $('#target_'+arr[i]).attr('checked',true);
        }
        //上传图片
        $('#model').change(function (){
            var model = $('#model').val();
            if(model == 1){
                $('#rich').show();
                $('#pic').hide();
            }else {
                $('#rich').hide();
                $('#pic').show();
            }
        });
    });
    function checkForm() {
        var title = $('#title').val(),
            model = $('#model').val(),
            content = UE.getEditor('content').getContent(),
            targets = $('input[name="target[]"]:checked');

        if(targets.length == 0) {
            otcms.error('请选择去向');
            return false;
        }
        if(title == '') {
            otcms.error('标题不能为空!');
            return false;
        }
        if(model == 1){
            if(content == ''){
                otcms.error('内容不能为空!');
                return false;
            }
        }else {
            if(nums == 0) {
                otcms.error('请上传图片!');
                return false;
            }
        }
    }
    function complete(res) {
        if(res.code == 1) {
            otcms.success(res.msg,res.url);
        }else {
            otcms.error(res.msg);
        }
    }
    function delImg(obj) {
        layer.confirm('确认删除吗?', {icon: 3, title:'提示'}, function(index){
            var src = $(obj).next().attr('src');
            for(var i=0;i<images.length;++i) {
                if(src == images[i]) {
                    delete images[i];
                }
            }
            --nums;
            $('#images').val(images.join('|'));
            $(obj).parent().remove();
            layer.close(index);
        });
    }
</script>
</body>
</html>