<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>已评教学生</title>
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css" />
    <link href="/evaluate2.1/Public/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<nav>当前位置：查看评教数据 >>已评教学生</nav>
<div class="container">
    <div class="text-danger pull-right"><a class="btn btn-info" href="/evaluate2.1/index.php/Admin/Evaluate/dLoad_stu_eva">下载数据</a></div>
    <form class="form-inline" role="search" method="post" action="/evaluate2.1/index.php/Admin/Evaluate/evaed_stu">
        <div class="form-group" style="width:100%;display: block;">
            <input type="text" style="width: 80%" placeholder="您可以按照 专业 / 学号 / 姓名 模糊检索" id="keywords" name="keywords" class="form-control">
            <button type="submit" style="width: 8%" class="btn btn-success">搜一下</button>
        </div>
    </form>
    <div class="panel-body table-responsive">
        <table class="table small table-condensed table-bordered table-striped table-hover">
            <tr>
                <th class="text-center">编 号</th>
                <th class="text-center">序 号</th>
                <th class="text-center">专业</th>
                <th class="text-center">班级</th>
                <th class="text-center">学号</th>
                <th class="text-center">姓名</th>
                <th class="text-center">评教状态</th>
            </tr>
            <?php if(is_array($list)): foreach($list as $kk=>$vo): ?><tr>
                    <td><?php echo ($kk); ?> </td>
                    <td><?php echo ($vo["sid"]); ?></td>
                    <td><?php echo ($vo["stu_major"]); ?></td>
                    <td><?php echo ($vo["stu_class"]); ?></td>
                    <td><?php echo ($vo["stu_num"]); ?></td>
                    <td><?php echo ($vo["stu_name"]); ?></td>
                    <td>
                        <?php if($vo["eva_status"] == 1): ?>已评教
                            <?php else: ?>
                            尚未评教<?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
        </table>

    </div>
    <div class="page small">
        <ul class="pagination small">
            <?php echo ($page); ?>
        </ul>
    </div>
</div>

</div>

<script>
    console.log("hello sunlun");
</script>

</body>
</html>