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
                				<li class="nav-header">
                					<div class="dropdown profile-element"> 
                						<span>
				                            			<img alt="image" class="img-circle" src="__PUBLIC__/images/user-thumb.png">
				                             		</span>
				                            		<span class="block user-name"> <strong class="font-bold"><?php echo session('nickname');?> </strong></span>
				                            		<span class="block user-lastlogin">上次登录: <?php echo session('lastlogin');?></span>
				                       	 </div>
                				</li>
    				                <?php if(is_array($modules)): $i = 0; $__LIST__ = $modules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li class="nav-li">
							<?php if($li["module_url"] != '#'): ?><a href="<?php echo U('Index/'.$li['module_url']);?>" class="nav-button"><i class="fa fa-<?php echo ($li["module_icon"]); ?>"></i> <span class="nav-label"><?php echo ($li["module_title"]); ?></span></i></a>
								<!-- <a href="../<?php echo ($li["module_name"]); ?>/<?php echo ($li["module_url"]); ?>" class="nav-button"><i class="fa fa-<?php echo ($li["module_icon"]); ?>"></i> <span class="nav-label"><?php echo ($li["module_title"]); ?></span></i></a> -->
							<?php else: ?>
								<a href="#" class="nav-button"><i class="fa fa-<?php echo ($li["module_icon"]); ?>"></i> <span class="nav-label"><?php echo ($li["module_title"]); ?></span></i></a><?php endif; ?>
							
							<ul  class="nav nav-second-level collapse in" style="height: auto;">
								<?php if(isset($li["actions"])): if(is_array($li["actions"])): $i = 0; $__LIST__ = $li["actions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/'.$li['module_name'].'/'.$sub['action_url']);?>"><?php echo ($sub["action_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
							</ul>	
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
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
			                    	<ol class="breadcrumb">
				                        	<li class="active">
				                            	<!-- <a href="../../Index/<?php echo ($module['module_name']); ?>/<?php echo ($module['module_url']); ?>"><?php echo ($module["module_title"]); ?></a> 
				                            	-->
				                            	<?php echo ($module["module_title"]); ?>
				                        	</li>
				                        	<li class="active">
				                            		<?php echo ($action["action_title"]); ?>
				                        	</li>
			                    	</ol>
		                	</div>
		            	</div>
		            	<div class="wrapper wrapper-content animated fadeInDown">
				
		<div class="row">
			<h3>您好，<?php echo session('uid');?> </h3>
			<div class="well">
			  	您可以点击左侧的菜单选择您需要的操作。<br>
				<a href="<?php echo U('Index/Login/logout');?>">退出登录</a>
			</div>
			<div class="col-md-6">
				<div class="ibox float-e-margins">
			                	<div class="ibox-title">
			                        		<h5>Title 1 <small>Subtitle extends </small></h5>
			                        	<div class="ibox-tools">
			                            		<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                            		<a class="close-link"><i class="fa fa-times"></i></a>
			                          </div>
			                          </div>
			                          <div class="ibox-content" style="display: block;">
			                          	<p>ibox contents</p>
			                          </div>
	                		</div>	
			</div>
			<div class="col-md-6">
				<div class="ibox float-e-margins">
			                	<div class="ibox-title">
			                        		<h5>Title 1 <small>Subtitle extends </small></h5>
			                        	<div class="ibox-tools">
			                            		<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                            		<a class="close-link"><i class="fa fa-times"></i></a>
			                          </div>
			                          </div>
			                          <div class="ibox-content" style="display: block;">
			                          	<p>ibox contents2</p>
			                          </div>
	                		</div>		
			</div>
		</div>
	
			</div>		
		</div>
		<div class="clear"></div>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
	
</body>
</html>