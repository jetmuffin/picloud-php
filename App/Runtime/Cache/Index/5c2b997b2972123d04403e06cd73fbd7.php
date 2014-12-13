<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>登录--__NAME-EN__</title></title>
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
	<?php if(isset($login_msg_box)): ?><div class="login-alert">
			<strong><?php echo ($login_msg); ?></strong>
		</div><?php endif; ?>
	<div class="middle-box">
		<form method="post" action="<?php echo U('Index/Login/login');?>">
			<div class="form-group">
				<input type="text" class="form-control login-input" name="uid" title="uid" id="uid" placeholder="请输入用户名/邮箱" >
			</div>
			<div class="form-group">
				<input type="password" class="form-control login-input" name="pwd" title="pwd" id="pwd"  placeholder="请输入密码">
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-primary login-btn" name="submit" title="submit" id="submit" >登录</button>
			</div>
			<div class="form-group">
				<a class="btn btn-default form-control" href="<?php echo U('Index/Register');?>">注册</a>
			</div>
		</form>
	</div>
	<div class="copyright">
		<small>Developed by JetMuffin, Sloric, InnerAC, Goodpj </small>
		<br/>© <small>2014 copyright </small>
	</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
</body>
</html>