<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<meta charset="UTF-8">
<head>
<title><?php echo (($title)?($title):"Picloud"); ?>--__NAME__</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/font/css/font-awesome.min.css" />

</head>
<body>
	<div id="wrap">
		<nav class="sidebar navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
                			<ul class="nav sidebar-nav" id="side-menu" style="display: block;">
                				<li class="nav-header"></li>
                				<li class="nav-li">
                        					<a href="<?php echo U('Index/Index');?>" class="nav-button"><i class="fa fa-dashboard"></i> <span class="nav-label">首页</span></i></a>
                        					<ul class="nav-second-level"></ul>
                        				</li>                   				
                				<li class="nav-li">
                        					<a href="#" class="nav-button"><i class="fa fa-link"></i> <span class="nav-label">图片服务器</span> <i class="fa fa-angle-left pull-right"></i></a>
                        					<ul  class="nav nav-second-level collapse in" style="height: auto;">
					                            <li><a href="#">上传图片</a></li>
					                            <li><a href="#">图片空间</a></li>
					              </ul>
                        				</li >
    				              <li class="nav-li">
                        					<a href="#" class="nav-button" data-toggle="collapse"><i class="fa fa-th-large"></i> <span class="nav-label">应用中心</span> <i class="fa fa-angle-left  pull-right"></i></a>
                        					<ul  class="nav nav-second-level collapse in" style="height: auto;">
					                            <li><a href="#">图片处理</a></li>
					                            <li><a href="#">高清图片</a></li>
					                            <li><a href="#">全景图片</a></li>
					              </ul>
                        				</li>
                        				<li class="nav-li">
                        					<a href="#"><i class="fa fa-user"></i> <span class="nav-label">个人设置</span> <i class="fa fa-angle-left  pull-right "></i></a>
                        					<ul class="nav-second-level"></ul>
                        				</li>     
                			</ul>
                		</div>				
		</nav>
		<div class="page-wrapper">
			<div class="row border-bottom">
       				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
       					<div class="navbar-header">
				            		<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
				        	</div>
				        	<ul class="nav navbar-top-links navbar-right">
				             <li>
				                    	<span class="m-r-sm text-muted welcome-message">Picloud - 提供优质云服务</span>
				             </li>
				             <li>
				                    	<a href="<?php echo U('Index/Login/logout');?>">
				                        		<i class="fa fa-sign-out"></i> 退出登录
				                    	</a>
				             </li>
				            	</ul>
       				</nav>
       			</div>
       			<div class="row wrapper border-bottom white-bg page-heading">
		                	<div class="col-lg-10">
		                    		<h2>首 页 - Picloud 图片存储云</h2>
		                    	<ol class="breadcrumb">
			                        	<li class="active">
			                            	<a href="index.html">Home</a>
			                        	</li>
			                        	<li class="active">
			                            	首页
			                        	</li>
		                    	</ol>
		                	</div>
		                	<div class="col-lg-2">
		                </div>
		            </div>
			
		<h3>您好，<?php echo session('uid');?> </h3>
		<div class="well">
		  	您可以点击左侧的菜单选择您需要的操作。<br>
			<a href="<?php echo U('Index/Login/logout');?>">退出登录</a>
		</div>
			
		</div>
		<div class="clear"></div>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
	
</body>
</html>