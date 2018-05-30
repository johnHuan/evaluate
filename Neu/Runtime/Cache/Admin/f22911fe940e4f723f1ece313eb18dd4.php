<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>评教结果</title>
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css" />
    <link href="/evaluate2.1/Public/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<nav>当前位置：查看评教数据 >>评教结果</nav>
<div class="container">
    <div class="text-danger pull-right"><a class="btn btn-info" href="/evaluate2.1/index.php/Admin/Evaluate/dLoad_stu_res">下载数据</a></div>
    <form class="form-inline" role="search" method="post" action="/evaluate2.1/index.php/Admin/Evaluate/eva_result">
        <div class="form-group" style="width:100%;display: block;">
            <input type="text" style="width: 80%" placeholder="您可以按照 课程名称 / 课程编号 / 任课教师 模糊检索" id="keywords" name="keywords" class="form-control">
            <button type="submit" style="width: 8%" class="btn btn-success">搜一下</button>
        </div>
    </form>
    <div class="panel-body table-responsive">
        <table class="table small table-condensed table-bordered table-striped table-hover">
            <tr class="text-info bg-success">
                <th class="text-center">序 号</th>
                <th class="text-center">课程编号</th>
                <th class="text-center">课程名称</th>
                <th class="text-center">任课教师</th>
                <th class="text-center text-info bg-info">总分</th>
                <th class="text-center text-info bg-warning">应该参评人数</th>
                <th class="text-center text-info bg-warning">实际参评人数</th>
                <th class="text-center text-info bg-danger">平均分</th>
            </tr>
            <?php if(is_array($list)): foreach($list as $kk=>$vo): ?><tr>
                    <td><?php echo ($kk + 1); ?> </td>
                    <td  class="text-left"><?php echo ($vo['ci']); ?></td>
                    <td  class="text-center"><?php echo ($vo['cn']); ?></td>
                    <td  class="text-left"><?php echo ($vo['ct']); ?></td>
                    <td  class="text-left text-info bg-info"><?php echo ($vo['cs']); ?></td>
                    <td  class="text-left text-info bg-warning"><?php echo ($vo['esn']); ?></td>
                    <td  class="text-left text-info bg-warning"><?php echo ($vo['esa']); ?></td>
                    <td  class="text-left text-info bg-danger"><?php echo ($vo['ea']); ?></td>
                </tr><?php endforeach; endif; ?>
        </table>

    </div>
    <div class="page small">
        <ul class="pagination small">
            <?php echo ($page); ?>
        </ul>
    </div>
</div>



</body>
</html>