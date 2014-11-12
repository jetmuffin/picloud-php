<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<p>hello!,<?php echo session('uid');?></p>
	<a href="<?php echo U('Index/Login/logout');?>">退出登录</a>
</body>
</html>