<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传选课清单</title>
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/fileinput.css" media="all" />
</head>
<body>
<nav>当前位置：数据管理 >>上传选课清单</nav>
<div class="container">
    <div>
        <h3>上传选课清单</h3>
        <h4 class="modal-title" id="myModalLabel">请选择txt文件</h4>
    </div>
    <form method="post" action="/evaluate2.1/index.php/Admin/Index/uploadcourseSelected" enctype="multipart/form-data">
        <input type="file" id="courseSelected" multiple name="courseSelected" class="file-loading" data-preview-file-type="text">
        <div id="error" style="margin-top:10px;display:none"></div>
        <div id="success" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>
        <div class="error1 file-error-message" style="margin-top: 10px; display: none;">
            <span class="close kv-error-close">×</span>
            <ul>
                <li class="errorTip"></li>
            </ul>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-asterisk"> 验证码：</i>
                    </div>
                    <input type="hidden" name="info" id="info" class="form-control">
                    <input type="text" name="captcha" id="captcha" placeholder="请输入下方的验证码" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <img src="/evaluate2.1/index.php/Admin/Index/verifyImg" alt="验证码" onclick="javascript:this.src='/evaluate2.1/index.php/Admin/Index/verifyImg?tm='+Math.random();" />
            </div>
            <div class="col-sm-5">
                <span id="captchaTip" class=""></span>
            </div>
        </div>
    </form>
</div>
<br><br><br><br><br>
<script type="text/javascript" src="/evaluate2.1/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput_locale_fr.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput_locale_es.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/canvas-to-blob.min.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/sortable.min.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/purify.min.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/themes/fa/theme.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/locales/LANG.js"></script>
<script>
    $("#courseSelected").fileinput({
        uploadUrl: "/evaluate2.1/index.php/Admin/Index/uploadcourseSelected", // server upload action
        uploadAsync: true,
        showPreview: true,
        allowedFileExtensions: ['txt'],
        maxFileCount: 1,
        elErrorContainer: '#error',
        uploadExtraData: function(){
            return {
                captcha: $('#captcha').val(),
            };
        },
    }).on('filebatchpreupload', function(event, data, id, index) {
        $('#success').html('<h4>Upload Status</h4><ul></ul>').hide();
    }).on('fileuploaded', function(event, data, id, index) {
        //上传的文件路径文件名等信息
        if (data['jqXHR']['responseText'] == 1) {
            $('span#captchaTip').addClass('text-danger').text('验证码错误！文件没有被写入数据库，请重新填写验证码，再次上传！！！');
        }else if(data['jqXHR']['responseText'] == 2){
            $('span#captchaTip').addClass('text-danger').text('文件未能被上传，请检查设置');
        }else if(data['jqXHR']['responseText'] > 4){
            var fname = data.files[index].name,
                    out = '<li>' + 'Uploaded file # ' + (index + 1) + ' - '  +
                            fname + ' successfully.' + '</li>';
            $('#success ul').append(out);
            $('#success').fadeIn('slow');
            $('span#captchaTip').addClass('text-success').text('成功写入了：' + data['jqXHR']['responseText'] + '条数据');
        } else {
            //文件上传失败，失败信息显示出来
            $('span#captchaTip').addClass('text-danger').text('上传失败，失败原因：' + data['jqXHR']['responseText']);
        }
    });




</script>
</body>
</html>