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
<div class="container">
<nav>当前位置：数据库管理 >>添加权限</nav>
<hgroup>
    <h4> <span class="text-primary ">添加权限</span></h4>
</hgroup>
<form admin="form" action="/evaluate2.1/index.php/Admin/Auth/addAuth" method="post">
    <div class="table-responsive">
        <table class="table table-condensed table-hover table-bordered " style="width: 80%">
            <tr>
                <td><?php echo ($fields[0]); ?></td>
                <td><input name="auth_id" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[1]); ?></td>
                <td><input name="auth_name" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[2]); ?></td>
                <td><input name="auth_pid" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[3]); ?></td>
                <td><input name="auth_c" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[4]); ?></td>
                <td><input name="auth_a" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[5]); ?></td>
                <td><input name="auth_path" class="form-control inline-input" type="text"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[6]); ?></td>
                <td><input name="auth_level" class="form-control inline-input" type="text"></td>
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