<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>系统关闭</title>
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css">
    <link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css">
    <link rel="stylesheet"  media="screen" tpye="text/css" href="/evaluate2.1/Public/css/bootstrap.min.css">
    <script type="text/javascript" src="/evaluate2.1/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
</head>
<body>

<hgroup class="label">
    <h1 class="lg"> <span class="text-warning"><?php echo ($info[infoh]); ?></span></h1>
    <h2 class="text-danger"><?php echo ($info[infos]); ?></h2>
    <h3 class="text-danger"><?php echo ($info[email]); ?></h3>
</hgroup>

</body>
</html>