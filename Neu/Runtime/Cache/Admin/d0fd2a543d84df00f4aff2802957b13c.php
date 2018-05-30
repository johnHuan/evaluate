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
<nav>当前位置：数据库管理 >>操作角色表</nav>
<div class="container">
<hgroup>
    <h4> <span class="text-primary ">角色表的操作</span></h4>
</hgroup>

    <table class="table table-hover">
        <tr>
            <td><?php echo ($fields[0]); ?></td>
            <td><?php echo ($fields[1]); ?></td>
            <td><?php echo ($fields[2]); ?></td>
            <td ><?php echo ($fields[3]); ?></td>
            <td nowrap>操作</tdnowrap>
        </tr>
        <?php if(is_array($data)): foreach($data as $key=>$list): ?><tr>
                <td><?php echo ($list["role_id"]); ?></td>
                <td nowrap=""><?php echo ($list["role_name"]); ?></td>
                <td nowrap=""><?php echo ($list["role_auth_ids"]); ?></td>
                <td><?php echo ($list["role_auth_ac"]); ?></td>
                <td><a href="/evaluate2.1/index.php/Admin/Auth/roleedit/?role_id=<?php echo ($list["role_id"]); ?>">修改</a></td>
            </tr><?php endforeach; endif; ?>
    </table>
</div>
</body>
</html>