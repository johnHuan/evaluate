<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>操作角色表</title>
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css">
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css">
    <link rel="stylesheet"  media="screen" tpye="text/css" href="/evaluate2.1/Public/css/bootstrap.min.css">
    <script type="text/javascript" src="/evaluate2.1/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
</head>
<body>
<nav>当前位置：数据库管理 >>添加管理员</nav>
<div class="container">
<hgroup>
    <h4> <span class="text-primary ">添加管理员</span></h4>
</hgroup>
<form admin="form" action="/evaluate2.1/index.php/Admin/Auth/addManager" method="post">
    <div class="table-responsive">
        <table class="table table-condensed table-hover table-bordered " style="width: 80%">
            <tr>
                <td><?php echo ($fields[1]); ?></td>
                <td><input name="admin_user" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[2]); ?></td>
                <td><input name="admin_tel" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[3]); ?></td>
                <td><input name="admin_name" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[4]); ?></td>
                <td><input name="admin_pwd" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[5]); ?></td>
                <td><input name="admin_role_id" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[6]); ?></td>
                <td><input  name="admin_email" class="form-control inline-input" type="text"></td>
            </tr>
        </table>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="提 交" >
    </div>
</form>
</div>
</body>
</html>