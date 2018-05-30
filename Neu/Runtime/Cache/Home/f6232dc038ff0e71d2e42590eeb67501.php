<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css">
<script src="/evaluate2.1/Public/js/jquery.min.js"></script>
<script src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
<!-- nav start
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#example-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">菜鸟教程</a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">iOS</a></li>
                <li><a href="#">SVN</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Java <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">jmeter</a></li>
                        <li><a href="#">EJB</a></li>
                        <li><a href="#">Jasper Report</a></li>
                        <li class="divider"></li>
                        <li><a href="#">分离的链接</a></li>
                        <li class="divider"></li>
                        <li><a href="#">另一个分离的链接</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <span class="text-justify visible-xs  navbar-brand">资土学院 教学管理系统</span>
            <button  class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right menu-drop">
                <li><a href="/evaluate2.1/index.php/Home/Action/Index"><span class="glyphicon glyphicon-user"> <?php echo (session('stu_name')); ?> 个人信息</span> </a></li>
                <li><a href="/evaluate2.1/index.php/Home/Action/evaluate"><span class="glyphicon glyphicon-edit"> </span>  教学评估</a></li>
                <li disabled="disabled" class="disabled" onclick="javascript:return false;"><a href="/evaluate2.1/index.php/Home/Action/cet46"  ><span class="glyphicon glyphicon-compressed" > </span> 四六级报名</a></li>
                <li disabled="disabled" class="disabled" onclick="javascript:return false;"><a href="/evaluate2.1/index.php/Home/Action/reExam"><span class="glyphicon glyphicon-bell"> </span> 补考报名</a></li>
                <li><a href="/evaluate2.1/index.php/Home/Action/updatePwd"><span class="glyphicon glyphicon-lock"> </span> 修改密码</a></li>
                <li><a href="/evaluate2.1/index.php/Home/Action/logout" onclick="if (confirm('确定要退出吗？')) return true; else return false;"><span class="glyphicon glyphicon-off"> </span> 退出系统</a></li>
            </ul>
        </div>

    </div>
</nav>
<br><br>

<!-- nav end -->
<!--<div class="container" style="margin: 0 auto;">-->
<!--<iframe scrolling="no" style="width:inherit;height:15px;" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=11&icon=4"></iframe>-->
<!--</div>-->

	<link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/bootstrap.min.css">
	<link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/index.css">
	<!--body start-->
<div class="container">
	<div class="header">
		<h1 class="text-center visible-lg">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">个人信息</span></h1>
		<h2 class="text-center visible-md">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">个人信息</span></h2>
		<h3 class="text-center visible-sm">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">个人信息</span></h3>
		<h4 class="text-center visible-xs">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">个人信息</span></h4>
	</div>
	<div class="page">
		<div class="content">
			<div class="wrap">
				<div class="row">
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
								个人信息
								<!--<a class="pull-right" href="#">更多>></a>-->
							</div>
							<div class="panel-body">
								<ul class="list-group">
									<li class="list-group-item">
										<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										<label>学号: </label> <?php echo ($data[stu_num]); ?>
									</li>
									<li class="list-group-item">
										<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
										<label>姓名: </label> <?php echo ($data[stu_name]); ?>
									</li>
									<li class="list-group-item">
										<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
										<label>班级</label>
										<span class="font-green"><?php echo ($data[stu_class]); ?></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="panel panel-default">
							<div class="panel-heading">
								<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
								我的专业课信息
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<!--<table class="table  table-condensed table-striped table-hover">
										<tr>
											<th>课程编号</th>
											<th>课程名称</th>
										</tr>
										<?php if(is_array($courses)): foreach($courses as $key=>$vo): ?><tr>
												<td><?php echo ($vo["course_id"]); ?></td>
												<td><?php echo ($vo["course_name"]); ?></td>

											</tr><?php endforeach; endif; ?>
									</table>-->
									<table class="table  table-condensed table-striped table-hover">
										<tr>
											<th>课程编号</th>
											<th>课程名称</th>
											<th>任课教师</th>
											<th>学分</th>
											<th>学时</th>
										</tr>
										<?php if(is_array($courses )): foreach($courses as $key=>$vo): ?><tr>
													<td><?php echo ((isset($vo["course_id"]) && ($vo["course_id"] !== ""))?($vo["course_id"]):"123"); ?></td>
													<td><?php echo ($vo["course_name"]); ?></td>
													<td><?php echo ($vo["course_teacher"]); ?></td>
													<td><?php echo ($vo["course_score"]); ?></td>
													<td><?php echo ($vo["course_period"]); ?></td>
												</tr><?php endforeach; endif; ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--footer-->
<footer class="footer footer-fixed-bottom">


<div class="container">
    <div class="well">
        <!--<h4>说明：</h4>-->
        <!--<p>2013级本科生课程评估工作现启动，采用网上评估的方式进行。凡本学院所有13级本科生，应于2016年12月27日前，登陆教学管理系统，完成评教，在登陆后的界面里可直接显示待评教的课程。</p>-->
        <h4>注意：</h4>
        <p>1. 初始密码为身份证后6位！</p>
        <p>2. 账号不存在说明数据库里没有您的信息！</p>
        <p>3. 如有问题，请按下方的联系方式联系管理员！</p>
        <p>4. 登陆教学管理系统进行教学评估，认真、客观地完成列表中的课程评估即可（不在列表内的课程，不属参评范围，故表中不列出）。</p>
        <p>5. 课程评估的意见和建议对促进授课教师提高教学水平、改进课堂教学具有积极的参考作用，请同学们认真、如实、客观地填写评估问卷，对本科生课程教学提出宝贵的意见和建议。所有的评价意见最终都是匿名的，填写时请同学们不必顾虑，感谢理解和支持。  </p>
    </div>
    <div class="footer">
        &copy;2016-2017 Northeastern University 资源与土木工程学院  地理信息系统与地图制图. <br />
        <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=WyEzOjU8My46NXUzKy4bPTQjNjoyN3U4NDY" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_02.png"/></a>
        author： 张桓；  All rights reserved.<br />
        技术咨询：john；   248404941（QQ）；yz30.com@aliyun.com（email）；
		<p>感谢车德福院长、刘婉婷老师的宝贵意见和大力支持</p>
    </div>
</div>
</footer>
<!-- End container-->
</body>
</html>