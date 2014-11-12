<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>登录--__NAME__</title></title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/font/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/login.css" />
</head>
<body>
	<div class="logo">
		<h1 class="logo-name">
			<div class="logo-icon">
				<i class="fa fa-cloud"></i>
			</div>
			Picloud
		</h1>
	</div>
<!-- 	<div class="slogan">
		<p>提供优质的图片存储云服务</p>
	</div> -->
	<div class="middle-box">
		<form method="post" action="<?php echo U('Index/Login/login');?>">
			<div class="form-group">
				<input type="text" class="form-control login-input" name="uid" title="uid" id="uid" placeholder="请输入用户名" >
			</div>
			<div class="form-group">
				<input type="password" class="form-control login-input" name="pwd" title="pwd" id="pwd"  placeholder="请输入密码">
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-primary login-btn" name="submit" title="submit" id="submit" >提交</button>
			</div>
			<div class="form-group">
				<button class="btn btn-default form-control">注册</button>
			</div>
		</form>
	</div>
	<div class="copyright">
		<small>Developed by JetMuffin, Sloric, InnerAC, Goodpj </small>
		<br/>© <small>2014 copyright </small>
	</div>

</body>
</html>