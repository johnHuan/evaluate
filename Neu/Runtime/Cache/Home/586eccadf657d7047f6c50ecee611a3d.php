<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>教学评估</title>
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

	<link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/css/index.css">
	<!--body start-->
	<div class="container">
		<div class="header">
			<h1 class="text-center visible-lg">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">教学评估</span></h1>
			<h2 class="text-center visible-md">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">教学评估</span></h2>
			<h3 class="text-center visible-sm">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">教学评估</span></h3>
			<h4 class="text-center visible-xs">东北大学 <span class="text-nowrap">资源与土木工程学院</span> <span class="text-nowrap">教学管理系统 </span><span class="text-nowrap">教学评估</span></h4>
		</div>
		<div class="page content">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
							教学评估（评教）
						</div>
						<div class="panel-body table-responsive">
							<table class="table  table-condensed table-striped table-hover">
								<thead>
									<span class="visible-xs text-info">提示：向右滑进行评教</span>
								</thead>
								<tr>
									<th>课程编号</th>
									<th>课程名称</th>
									<th>任课教师</th>
									<th>上课班级</th>
									<th>学分</th>
									<th>学时</th>
									<th>评教状态</th>
								</tr>
								<?php if(is_array($info)): foreach($info as $k=>$vo): ?><tr>
										<td> <?php echo ($k); ?> <?php echo ($vo["course_id"]); ?></td>
										<td> <?php echo ($vo["course_name"]); ?></td>
										<td> <?php echo ($vo["course_teacher"]); ?></td>
										<td> <?php echo ($vo["course_obj"]); ?></td>
										<td> <?php echo ($vo["course_score"]); ?></td>
										<td> <?php echo ($vo["course_period"]); ?></td>
										<input type="hidden" name="eva_res[]" value="<?php echo ($vo["stu_evaluate_status"]); ?>">
										<?php if($vo["stu_evaluate_status"] == 1): ?><td>
												<span class="hidden-xs">已评教</span>
												<span class="glyphicon glyphicon-ok disabled"></span>
											</td>
										<?php else: ?>
											<td>
												<a href="/evaluate2.1/index.php/Home/Action/evaluateDo?sid=<?php echo ($vo["course_id"]); ?>">
												<span class="hidden-xs">待评教</span>
												<!--<a href="/evaluate2.1/index.php/Home/Action/evaluateDo?sid=<?php echo ($vo["sid"]); ?>">-->
													<span class="glyphicon glyphicon-pencil">
													</span>
												</a>
											</td><?php endif; ?>
									</tr><?php endforeach; endif; ?>
							</table>
								<?php if($data["eva_status"] == 0): ?><form action="/evaluate2.1/index.php/Home/Action/evaluate" method="post">
										<input id="submit" class="btn btn-block btn-primary  form-control" name="submit" value="点击提交后完成评教" type="submit">
									</form>
									<?php else: ?>
									<div class="">
										<span class="text-center label-primary text-danger form-control disabled" >您已经完成评教</span>
									</div><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--body end-->
	<script>
		$(function () {
			$("input:submit").on("click", function (event){
				event.preventDefault();
				var len = $("input:hidden").length;
				var flag = 0;
				for (var i=0; i<len; i++){
					var eachValue = $("input:hidden")[i].value;
					if (eachValue == 0){
						flag = 0;
						alert("请完成所有课程的评教后再点击这里完成评教！");
						break;
					} else {
						flag = 1;
					}
				}

				if (flag == 1){
					//完成评教后的操作
					$.ajax({
						type: 'POST',
						data: {
							flag: flag,
						},
						url: '/evaluate2.1/index.php/Home/Action/evaluate',
						beforeSend: function(){
							$('#submit').addClass('disabled').val('评教结果提交中，请稍后。。。');
							$('#submit').css('cursor', 'not-allowed');
						},
						success: function (res) {
							if(res == 1){
								//完成这门课程的评教
	                          alert("恭喜您！提交成功！完成评教！！");
								location.href = "/evaluate2.1/index.php/Home/Action/Index";
							} else if (res == 2){
								//提交失败
								alert("提交失败！请重试！！");
							} else {
							    alert("提交失败，失败原因：“返回值异常！！！”请按下方的联系方式联系维护人员！");
							}
						},
						complete: function(){
							$('#submit').removeClass('disabled').val('点击提交后完成评教');
							$('#submit').css('cursor', 'pointer');
						}

					});

				}

			});
		});
	</script>

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