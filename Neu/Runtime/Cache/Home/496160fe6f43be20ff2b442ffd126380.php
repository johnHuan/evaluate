<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>东北大学 资源于土木工程学院 教学管理系统</title>
	<link rel="stylesheet"  media="screen" type="text/css" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/evaluate2.1/Public/css/index.css">

</head>
<body>
	<div class="container">





		<div class="wrapper">
			<div class="header">
				<h3 class="text-center hidden-xs">东北大学 资源于土木工程学院 教学管理系统</h3>
				<h4 class="text-center visible-xs">东北大学 资源于土木工程学院 教学管理系统</h4>
			</div>
			<!--main-->
			<div class="content">
			<!--
				<style>
					.alert-danger h4, .alert-error h4 {
						color: #b94a48;
					}
					.alert h4 {
						margin: 0;
					}
					.alert, .alert h4 {
						color: #c09853;
					}
				</style>
				<div class="alert alert-danger" style="max-width:600px;margin:20px auto;">
					<button class="close" type="button" data-dismiss="alert">×</button>
					<h4 style="padding:20px 20px;">关于取消截止评教时间的通知</h4>
					<p style="text-align:left;">1.由于考虑到同学们马上要考研了，不急着让大家评教。</p>
					<p style="text-align:left;">2.大家可以在考研后，或空余时间用心评价一下本科阶段的课程。</p>
					<p style="text-align:left;">3.最后，祝愿学弟学妹们考个好成绩！</p>
				</div>

				-->
				<!--login start-->
				<div class="row">
					<h2 class="text-center hidden-xs"><b>学生登录</b></h2>
					<h4 class="text-center visible-xs "><b>学生登录</b></h4>
					<div class="col-lg-12 col-sm-12">
						<form id="login" action="/evaluate2.1/index.php/Home/Index/Index.html" class="form-horizontal" method="post">

							<div class="form-group">
								<label class="col-sm-4 control-label hidden-xs" for="stu_num">学　号:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-user"></i>
										</div>
										<input type="text" name="stu_num" id="stu_num" placeholder="请输入您的学号" class="form-control">
									</div>
								</div>
								<label id="stu_num_tip" class="col-sm-3  text-danger"></label>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label hidden-xs" for="stu_pwd">密　码:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-asterisk"></i>
										</div>
										<input type="password" name="stu_pwd" id="stu_pwd" placeholder="请输入您的密码" class="form-control">
									</div>
								</div>
								<label id="stu_pwd_tip" class="col-sm-3  text-danger"></label>

							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label hidden-xs" for="captcha">验证码:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-ok-circle "></i>
										</div>
										<input type="text" name="captcha" id="captcha" placeholder="请输入下方的验证码" class="form-control">
									</div>
								</div>
								<label id="captcha_tip" class="col-sm-3  text-danger"></label>

							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label hidden-xs"></label>
								<div class="col-sm-5">
									<img src="/evaluate2.1/index.php/Home/Index/verifyImg" alt="验证码" onclick="javascript:this.src='/evaluate2.1/index.php/Home/Index/verifyImg?tm='+Math.random();" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label hidden-xs"></label>
								<div class="col-sm-5">
									<input type="submit" class="btn btn-primary form-control hwLayer-ok" name="submit" id="submit" value="登　录" />
								</div>
							</div>
						</form>
					</div>
				</div>
				<!--login end-->
			</div>
		</div>
	</div>
	<!-- End container-->
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


	<script src="/evaluate2.1/Public/js/jquery.js"></script>
	<script src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
	<script>
		//学生登录  校验数据并发送数据
		$(function(){
			//校验数据
			$('#stu_num').on('click', function () {
				$('#stu_num_tip').removeClass('text-danger').text('');
				$('#stu_num').css('border', '1px solid #CCCCCC');
				$('#submit').removeClass('disabled');
				$('#submit').css('cursor', 'pointer');

			});
			$('#stu_pwd').on('click', function () {
				$('#stu_pwd_tip').removeClass('text-danger').text('');
				$('#stu_pwd').css('border', '1px solid #CCCCCC');
				$('#submit').removeClass('disabled');
				$('#submit').css('cursor', 'pointer');

			});
			$('#captcha').on('click', function () {
				$('#captcha_tip').removeClass('text-danger').text('');
				$('#captcha').css('border', '1px solid #CCCCCC');
				$('#submit').removeClass('disabled');
				$('#submit').css('cursor', 'pointer');

			});
			$('#submit').on('click', function(event){
				event.preventDefault();
				//取得数据
				var stu_num = $('#stu_num').val();
				var stu_pwd = $('#stu_pwd').val();
				var captcha = $('#captcha').val();
				if (stu_num.length < 6) {
					$('#stu_num').focus();
					$('#stu_num_tip').addClass('text-danger').text('*学号不得少于六位!');
					$('#stu_num').css('border', '1px solid #A94442');
					return false;
				}
				if (stu_pwd.length <6) {
					$('#stu_pwd').focus();
					$('#stu_pwd_tip').addClass('text-danger').text('密码不得小于6位!');
					$('#stu_pwd').css('border', '1px solid #A94442');
					return false;
				}
				if (captcha.length < 5) {
					$('#captcha').focus();
					$('#captcha_tip').addClass('text-danger').text('验证码不得小于5位!');
					$('#captcha').css('border', '1px solid #A94442');
					return false;
				}

				//发送数据
				$.ajax({
					type: 'POST',
					data: {
						stu_num: stu_num  ,
						stu_pwd  : stu_pwd   ,
						captcha : captcha  ,
					},
					url: '/evaluate2.1/index.php/Home/Index/Index.html',
					beforeSend: function(){
						$('#submit').addClass('disabled').val('登录中，请稍后。。。');
						$('#submit').css('cursor', 'not-allowed');
					},
					success: function (res) {
						if (res == 1){
							//验证码出错
							$('#captcha').focus();
							$('#captcha_tip').addClass('text-danger').text('验证码错误！');
							$('#captcha').css('border', '1px solid #A94442');
						} else if(res == 2){
							//学号不存在
							$('#stu_num').focus();
							$('#stu_num_tip').addClass('text-danger').text('学号不存在！');
							$('#stu_num').css('border', '1px solid #A94442');
						} else if(res == 3){
							//错误密码
							$('#stu_pwd').focus();
							$('#stu_pwd_tip').addClass('text-danger').text('密码错误！');
							$('#stu_pwd').css('border', '1px solid #A94442');
						} else if (res == 4){
							location.href = "/evaluate2.1/index.php/Home/Action/Index";
						}

					},
					complete: function(){
						$('#submit').removeClass('disabled').val('登　录');
						$('#submit').css('cursor', 'pointer');
					}
				});
			});
		});




	</script>
</body>
</html>