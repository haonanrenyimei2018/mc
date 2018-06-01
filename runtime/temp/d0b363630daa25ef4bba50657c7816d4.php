<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"E:\workplace\mc/application/admin\view\silder\index.html";i:1519806713;s:57:"E:\workplace\mc/application/admin\view\public\header.html";i:1525915507;s:57:"E:\workplace\mc/application/admin\view\public\footer.html";i:1525915507;}*/ ?>
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
<link rel="stylesheet" href="/sldate/daterangepicker-bs3.css" />
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
                    <h5>轮播图设置</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div  class="col-sm-2">
                                <div class="input-group" >
                                    <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#myModal">添加图片轮播</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$list): ?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group" style="height: 100px;margin: 0px;">
                        <div style="float:left;">
                            <img src="<?php echo $list['images']; ?>" height="100px" width="100px">
                        </div>
                        <div style="height: 100px;margin-left: 10px;float:left;display: inline-block">
                            <div style="clear: both;"></div>
                            <div style="line-height: 50px;display: inline-block;">
                                <?php echo $list['title']; ?>
                            </div>
                            <div style="height: 50px;display: block;padding-top: 33px;">
                                <?php echo $list['intro']; ?>
                            </div>
                        </div>
                        <div style="height: 100px;margin-left: 10px;float:left;display: inline-block;">
                            <span class="btn btn-danger btn-outline" style="margin-left: 100px;margin-top: 75px;margin-right: 0;" onclick="delEvent(<?php echo $list['id']; ?>)">
                                <i class="fa fa-trash-o"></i>删除
                            </span>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
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
<div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">添加图片轮播</h3>
            </div>
            <form class="form-horizontal" name="add" id="add" method="post" action="index">
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题:</label>
                        <div class="input-group col-sm-9">
                            <input id="title" type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">上传图片:</label>
                        <div class="input-group col-sm-4">
                            <input type="hidden" id="images" name="images" >
                            <div id="imgPicker" style="float:left">选择图片</div>
                            <div style="clear: both;"></div>
                            <img id="img_data" height="100px" style="float:left;margin-top: 10px;" src="/static/admin/images/no_img.jpg"/>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">有效时间:</label>
                        <div class="input-group col-sm-9">
                            <input type="text" class="form-control" name="date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>
<script src="/sldate/moment.js"></script>
<script src="/sldate/daterangepicker.js"></script>
<script>
    var uploader = '';
    $(function () {
        $('input[name="date"]').daterangepicker({
            "timePicker": true,
            "timePicker24Hour": true,
            "linkedCalendars": false,
            "autoUpdateInput": false,
            "locale": {
                format: 'YYYY-MM-DD',
                separator: ' ~ ',
                applyLabel: "确定",
                cancelLabel: "取消",
                resetLabel: "重置",
            }
        }, function(start, end, label) {
            if(!this.startDate){
                this.element.val('');
            }else{
                this.element.val(this.startDate.format('YYYY-MM-DD') + ' ~ ' + this.endDate.format('YYYY-MM-DD'));
            }
        });

        $('#add').ajaxForm({
            beforeSubmit: checkForm,
            success: complete,
            dataType: 'json'
        });
        $("#myModal").on("shown.bs.modal",function(){
            uploader = WebUploader.create({
                auto: true,// 选完文件后，是否自动上传。
                swf: '/static/admin/js/webupload/Uploader.swf',// swf文件路径
                server: "<?php echo url('Upload/upload'); ?>",// 文件接收服务端。
                duplicate :true,// 重复上传图片，true为可重复false为不可重复
                pick: '#imgPicker',// 选择文件的按钮。可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/jpg,image/jpeg,image/png'
                },
                'onUploadSuccess': function(file, data, response) {
                    $('#img_data').attr('src',data._raw);
                    $('#images').val(data._raw);
                }
            });
        });
        $('#myModal').on('hide.bs.modal', function () {
            uploader.destroy();
        });
    });
    function checkForm() {
        var title = $('#title').val(),
            images = $('#images').val();
        if(title == ''){
            otcms.error('标题不能为空!');
            return false;
        }
        if(images == ''){
            otcms.error('请上传图片');
            return false;
        }
    }
    function complete(data) {
        if(data.code == 1){
            otcms.success(data.msg,data.url);
        }else {
            otcms.error(data.msg);
        }
    }
    /**
     * 删除
     */
    function delEvent(id) {
        layer.confirm('确认删除此条记录吗?', {icon: 3, title:'提示'}, function(index){
            $.getJSON('del.html', {'id' : id}, function(res){
                if(res.code == 1){
                    layer.msg(res.msg,{icon:1,time:1500,shade: 0.1});
                    window.location.href = res.url;
                }else{
                    layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
                }
                layer.close(index);
            });

        })
    }



</script>
</body>
</html>