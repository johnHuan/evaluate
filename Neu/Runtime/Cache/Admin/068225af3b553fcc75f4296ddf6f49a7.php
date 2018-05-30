<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传课程清单</title>
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/fileinput.css" media="all" />
</head>
<body>
<nav>当前位置：数据管理 >> 上传方案课程清单</nav>
<div class="container">
    <div>
        <h3>上传方案课程清单</h3>
        <h4 class="modal-title" id="myModalLabel">请选择Excel文件<span style="display: none;" class="pull-right small"><a href="">下载 </a> <i> 方案课程清单 </i> 参照模板</span></h4>
    </div>
    <form method="post" action="/evaluate2.1/index.php/Admin/Index/uploadcourses" enctype="multipart/form-data">
        <input type="file" id="courses" multiple name="courses" class="file-loading" data-preview-file-type="text">
        <div id="error" style="margin-top:10px;display:none"></div>
        <div id="success" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>
    </form>
    <div class="error1 file-error-message" style="margin-top: 10px; display: none;">
        <span class="close kv-error-close">×</span>
        <ul>
            <li class="errorTip"></li>
        </ul>
    </div>
    <form id="form1" action="/evaluate2.1/index.php/Admin/Index/uploadcourses" class="form-horizontal" method="post">
       <h3>写入数据库</h3>
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
            <span id="captchaTip" class=""></span>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <img src="/evaluate2.1/index.php/Admin/Index/verifyImg" alt="验证码" onclick="javascript:this.src='/evaluate2.1/index.php/Admin/Index/verifyImg?tm='+Math.random();" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <input type="submit" class="btn btn-primary form-control" name="submit" id="submit" value="写数据库" />
            </div>
            <div style="display: none;" class="loading col-sm-4">
                <img src="/evaluate2.1/Public/img/loading4.gif" alt="">
            </div>
            <div style="display: none;" class="ok col-sm-4">
                <span class="ok text-success">恭喜您！写入成功</span>
            </div>
        </div>
    </form>

</div>


<script src="/evaluate2.1/Public/js/jquery.min.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput_locale_fr.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput_locale_es.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput.min.js" type="text/javascript"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>-->
<!--<script src="/evaluate2.1/Public/bootstrapfileinput/themes/fa/theme.js"></script>-->
<!--<script src="/evaluate2.1/Public/bootstrapfileinput/js/locales/LANG.js"></script>-->
<script>
    $("#courses").fileinput({
//        uploadUrl: "/evaluate2.1/index.php/Admin/Index/uploadcourses", // server upload action
        uploadUrl: "/evaluate2.1/index.php/Admin/Index/uploadcourses", // server upload action
        uploadAsync: true,
        showPreview: true,
        allowedFileExtensions: ['xls', 'xlsx'],
        maxFileCount: 1,
        elErrorContainer: '#error'
    }).on('filebatchpreupload', function(event, data, id, index) {
        $('#success').html('<h4>Upload Status</h4><ul></ul>').hide();
    }).on('fileuploaded', function(event, data, id, index) {
        var fname = data.files[index].name,
                out = '<li>' + 'Uploaded file # ' + (index + 1) + ' - '  +
                        fname + ' successfully.' + '</li>';
        $('#success ul').append(out);
        $('#success').fadeIn('slow');
        //上传的文件路径文件名等信息
        $('#info').val(data['jqXHR']['responseText']);
    });


    $(function(){
        $('#captcha').on('click', function () {
            $('#captchaTip').removeClass('text-danger').text('');
        });

        $('#submit').on('click', function(event){
            event.preventDefault();
            var captcha = $('#captcha').val();
            var info = $('#info').val();
//            alert(info);
            if(captcha.length != 5){
                $('#captchaTip').addClass('text-danger').text('验证码必须是5位');
                $('#captcha').focus();
                return false;
            }
            $.ajax({
                type: 'POST',
//                url: 'http://localhost/neupostgra/demo0.8/index.php/Admin/Index/uploadcourses',
                url: '/evaluate2.1/index.php/Admin/Index/uploadcourses',
                data: {
                    captcha: captcha,
                    info: info,
                },
                beforeSend: function(){
                    $('#submit').addClass('disabled').val('数据交互中请稍后');
                    $('div.loading').css('display', 'block');
                    $('#submit').css('cursor', 'not-allowed');
                },
                success: function(res){
                    if(res == 1){
                        $('#captchaTip').addClass('text-danger').text('验证码错误！');
                        $('#captcha').focus();
                    } else if(res == 2){
                        $('div.error1').css('display', 'block');
                        $('li.errorTip').text('写入数据库之前请先在上方上传要写入数据库的文件！');
                    } else{
                        $('div.ok').css('display', 'block');
                        $('span.ok').text('恭喜您！成功写入了'+res+'条数据');
                    }
                },
                complete: function(){
                    $('#submit').removeClass('disabled').val('写入数据库');
                    $('#submit').css('cursor', 'pointer');
                    $('div.loading').css('display', 'none');
                }
            });
        });
    });


    $('span.close').on('click', function(){
        $('div.file-error-message').css('display', 'none');
    });

</script>
</body>
</html>