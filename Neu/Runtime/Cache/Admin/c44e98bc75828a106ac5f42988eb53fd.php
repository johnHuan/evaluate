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
<nav>当前位置：数据库管理 >>操作管理员表</nav>
<div class="container">
<hgroup>
    <h4> <span class="text-primary ">管理员表的查看</span></h4>
</hgroup>

    <table class="table table-condensed table-hover table-bordered ">
        <tr>
            <th><?php echo ($fields[0]); ?></th>
            <th><?php echo ($fields[1]); ?></th>
            <th><?php echo ($fields[2]); ?></th>
            <th><?php echo ($fields[3]); ?></th>
            <th><?php echo ($fields[4]); ?></th>
            <th><?php echo ($fields[5]); ?></th>
            <th><?php echo ($fields[6]); ?></th>
            <td nowrap>操作</td>
        </tr>
        <?php if(is_array($data)): foreach($data as $key=>$list): ?><tr>
                <td><?php echo ($list["admin_id"]); ?></td>
                <td><?php echo ($list["admin_user"]); ?></td>
                <td><?php echo ($list["admin_tel"]); ?></td>
                <td><?php echo ($list["admin_name"]); ?></td>
                <td style="word-break:break-all;"><?php echo ($list["admin_pwd"]); ?></td>
                <td><?php echo ($list["admin_role_id"]); ?></td>
                <td><?php echo ($list["admin_email"]); ?></td >
                <td><a href="/evaluate2.1/index.php/Admin/Auth/manageredit/?admin_id=<?php echo ($list["admin_id"]); ?>">修改</a></td>
            </tr><?php endforeach; endif; ?>
    </table>
</div>
</body>
</html>