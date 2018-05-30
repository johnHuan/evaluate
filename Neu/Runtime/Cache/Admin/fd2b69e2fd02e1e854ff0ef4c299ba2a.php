<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生自定义评价</title>
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css" />
    <link href="/evaluate2.1/Public/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<nav>当前位置：查看评教数据 >>学生自定义评价</nav>
<div class="container">
    <div class="text-danger pull-right"><a class="btn btn-info" href="/evaluate2.1/index.php/Admin/Evaluate/dLoad_stu_person">下载数据</a></div>
    <form class="form-inline" role="search" method="post" action="/evaluate2.1/index.php/Admin/Evaluate/eva_person">
        <div class="form-group" style="width:100%;display: block;">
            <input type="text" style="width: 80%" placeholder="您可以按照课程名称模糊检索" id="keywords" name="keywords" class="form-control">
            <button type="submit" style="width: 8%" class="btn btn-success">搜一下</button>
        </div>
    </form>
    <div class="panel-body table-responsive">
        <table class="table small table-condensed table-bordered table-striped table-hover">
            <tr>
                <th class="text-center">序 号</th>
                <th class="text-center">课程名称</th>
                <th class="text-center">课程编号</th>
                <th class="text-center">任课教师</th>
                <th class="text-center">学生心语</th>
            </tr>
            <?php if(is_array($data)): foreach($data as $kk=>$vo): ?><tr>
                    <td><?php echo ($kk); ?> </td>
                    <td><?php echo ($vo["course_name"]); ?></td>
                    <td><?php echo ($vo["course_id"]); ?></td>
                    <td><?php echo ($vo["course_teacher"]); ?></td>
                    <td><?php echo ($vo["stu_comment"]); ?></td>
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