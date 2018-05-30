<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>东北大学 资源于土木工程学院 教学管理系统</title>
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="/evaluate2.1/Public/css/index.css">
</head>
<body data-spy="scroll" data-target="#myscrollspy">

<div class="container">
    <div class="wrapper">
        <div class="header">
            <h3 class="text-center">东北大学 资源于土木工程学院 教学管理系统</h3>
        </div>
        <!--main-->
        <div class="content">
            <!--login start-->
            <div class="row">
                <h4 class="text-center "><b>管理员登录</b></h4>
                <div class="col-lg-12 col-sm-12">
                    <form id="login" action="/evaluate2.1/admin/manager/login" class="form-horizontal" method="post">

                        <div class="form-group">
                            <label class="col-sm-4 control-label hidden-xs" for="admin_user">账　号:</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                    <input type="text" name="admin_user" id="admin_user" placeholder="请输入您的账号" class="form-control">
                                </div>
                            </div>
                            <span id="stu_num_tip" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label hidden-xs" for="admin_pwd">密　码:</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-asterisk"></i>
                                    </div>
                                    <input type="password" name="admin_pwd" id="admin_pwd" placeholder="请输入您的密码" class="form-control">
                                </div>
                            </div>
                            <span id="stu_pwd_tip" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label hidden-xs" for="captcha">验证码:</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-ok-circle "></i>
                                    </div>
                                    <input type="text" name="captcha" id="captcha" placeholder="请输入下方的验证码" class="form-control">
                                </div>
                            </div>
                            <span id="captcha_tip" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label hidden-xs"></label>
                            <div class="col-sm-5">
                                <img src="/evaluate2.1/index.php/Admin/Manager/verifyImg" alt="验证码" onclick="javascript:this.src='/evaluate2.1/index.php/Admin/Manager/verifyImg?tm='+Math.random();" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label hidden-xs"></label>
                            <div class="col-sm-5">
                                <input type="submit" class="btn btn-primary form-control hwLayer-ok" name="submit" id="submit" value="登　录" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--login end-->
            <div class="well">
                <div class="logo pull-right hidden-xs">
                    <img src="/evaluate2.1/Public/img/loginlogo.png" />
                </div>
                <h4>注意：</h4>
                <p>1. 初始密码为身份证后6位，如有必要请在登录后修改密码！ </p>
                <p>2. 账号不存在说明数据库里没有您的信息！</p>
                <p>3. 如有问题请联系管理员！ </p>
            </div>
        </div>
    </div>
    <div class="footer">
        &copy; 2016-2016 Northeastern University 资源与土木工程学院  地理信息系统与地图制图. <br />
        <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=WyEzOjU8My46NXUzKy4bPTQjNjoyN3U4NDY" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_02.png"/></a>
        author： 张桓；  All rights reserved.<br />
        技术咨询：john；   248404941（QQ）；yz30.com@aliyun.com（email）；
    </div>
</div>
<!-- End container-->




<script src="/evaluate2.1/Public/js/jquery-1.10.1.js"></script>
<script src="/evaluate2.1/Public/js/jquery.js"></script>
<script src="/evaluate2.1/Public/js/jquery.ui.js"></script>
<script src="/evaluate2.1/Public/js/jquery-3.1.1.min.js"></script>
<script src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
<script src="/evaluate2.1/Public/js/jquery.validate.js"></script>
<script>
    //学生登录  校验数据并发送数据
    /*
     $(function(){
     //校验数据
     $('#stu_num').on('click', function () {
     $('#stu_num_tip').removeClass('text-danger').text('');
     $('#stu_num').css('border', '1px solid #CCCCCC');
     $('#submit').removeClass('disabled')
     $('#submit').css('cursor', 'pointer');

     });
     $('#stu_pwd').on('click', function () {
     $('#stu_pwd_tip').removeClass('text-danger').text('');
     $('#stu_pwd').css('border', '1px solid #CCCCCC');
     $('#submit').removeClass('disabled');
     $('#submit').css('cursor', 'pointer');

     });
     $('#captcha').on('click', function () {
     $('#captcha_tip').removeClass('text-danger').text('');
     $('#captcha').css('border', '1px solid #CCCCCC');
     $('#submit').removeClass('disabled');
     $('#submit').css('cursor', 'pointer');

     });
     $('#submit').on('click', function(event){
     event.preventDefault();
     //取得数据
     var stu_num = $('#stu_num').val();
     var stu_pwd = $('#stu_pwd').val();
     var captcha = $('#captcha').val();
     if (stu_num.length < 6) {
     $('#stu_num').focus();
     $('#stu_num_tip').addClass('text-danger').text('学号不得少于六位!');
     $('#stu_num').css('border', '1px solid #A94442');
     return false;
     }
     if (stu_pwd.length <6) {
     $('#stu_pwd').focus();
     $('#stu_pwd_tip').addClass('text-danger').text('密码不得小于6位!');
     $('#stu_pwd').css('border', '1px solid #A94442');
     return false;
     }
     if (captcha.length < 5) {
     $('#captcha').focus();
     $('#captcha_tip').addClass('text-danger').text('验证码不得小于5位!');
     $('#captcha').css('border', '1px solid #A94442');
     return false;
     }

     //发送数据
     $.ajax({
     type: 'POST',
     data: {
     stu_num: stu_num  ,
     stu_pwd  : stu_pwd   ,
     captcha : captcha  ,
     },
     //url: '/evaluate2.1/admin/manager/login',
     beforeSend: function(){
     $('#submit').addClass('disabled').val('登录中，请稍后。。。');
     $('#submit').css('cursor', 'not-allowed');
     },
     success: function (res) {
     if (res == 1){
     //验证码出错
     $('#captcha').focus();
     $('#captcha_tip').addClass('text-danger').text('验证码错误！');
     $('#captcha').css('border', '1px solid #A94442');
     } else if(res == 2){
     //学号不存在
     $('#stu_num').focus();
     $('#stu_num_tip').addClass('text-danger').text('学号不存在！');
     $('#stu_num').css('border', '1px solid #A94442');
     } else if(res == 3){
     //错误密码
     $('#stu_pwd').focus();
     $('#stu_pwd_tip').addClass('text-danger').text('密码错误！');
     $('#stu_pwd').css('border', '1px solid #A94442');
     } else if (res == 4){
     //location.href = '/evaluate2.1/index.php/Admin/Manager/personInfo';
     }

     },
     complete: function(){
     $('#submit').removeClass('disabled').val('登　录');
     $('#submit').css('cursor', 'pointer');
     }
     });
     });
     });
     */
</script>
</body>
</html>