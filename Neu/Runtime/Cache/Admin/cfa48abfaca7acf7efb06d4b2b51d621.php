<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css">
        <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    </head>
    <body>
    <!-- 导航开始 -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand logo">
                    <!--<img src="/evaluate2.1/Public/img/logo1.png"  style="padding:-10px;margin:-10px;" alt="资源与土木学院 教学管理系统">-->
                    <span>资源与土木学院 教学管理系统</span>

                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right menu-drop">
                    <li><a href="/evaluate2.1/index.php/Home/Action/Index" target="_blank"><span class="icon-home glyphicon glyphicon-home">去前台查看</span> </a></li>
                    <li><a href="#"><span class="icon-user glyphicon glyphicon-user"><?php echo (session('admin_name')); ?>　</span> </a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-phone "><?php echo (session('admin_tel')); ?></span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-envelope"><?php echo (session('admin_email')); ?></span></a></li>
                    <li class="disabled"><a href="#"><span class="glyphicon glyphicon-question-sign">说明 </span></a></li>
                    <li><a onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="/evaluate2.1/index.php/Admin/Manager/logout" target="_top"><span class="glyphicon glyphicon-off">退出系统</span></a></li>
                    </ul>
            </div>

        </div>
    </nav>
    <script type="text/javascript" src="/evaluate2.1/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
    </body>
</html>