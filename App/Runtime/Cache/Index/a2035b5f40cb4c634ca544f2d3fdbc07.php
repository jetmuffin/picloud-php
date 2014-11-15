<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<meta charset="UTF-8">
<head>
<title><?php echo (($title)?($title):"Picloud"); ?>--__NAME__</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/font/css/font-awesome.min.css" />

		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
	
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
				                       	<div class="logo-element">
					                            <i class="fa-cloud fa"></i>
					                </div>
                				</li>
    				                <?php if(is_array($modules)): $i = 0; $__LIST__ = $modules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li class="nav-li " data-module="<?php echo ($li["module_name"]); ?>">
							<?php if($li["module_url"] != '#'): ?><a href="<?php echo U('Index/'.$li['module_url']);?>" class="nav-button"><i class="fa fa-<?php echo ($li["module_icon"]); ?>"></i> <span class="nav-label"><?php echo ($li["module_title"]); ?></span></i></a>
							<?php else: ?>
								<a href="#" class="nav-button"><i class="fa fa-<?php echo ($li["module_icon"]); ?>"></i> <span class="nav-label"><?php echo ($li["module_title"]); ?></span></i></a><?php endif; ?>
							<?php if(isset($li["actions"])): ?><ul  class="nav nav-second-level collapse in" style="height: auto;">
									<?php if(is_array($li["actions"])): $i = 0; $__LIST__ = $li["actions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/'.$li['module_name'].'/'.$sub['action_url']);?>"><?php echo ($sub["action_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul><?php endif; ?>
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
				                            	<div id="module_set" data-module="<?php echo ($module['module_name']); ?>"></div>
				                            	<?php echo ($module["module_title"]); ?>
				                        	</li>
				                        	<li class="active">
				                            		<a href="<?php echo U('Index/Picserver/picspace');?>"><?php echo ($action["action_title"]); ?></a>
				                        	</li>
				                        	<?php if(isset($space)): ?><li><?php echo ($space["space_name"]); ?></li><?php endif; ?>
			                    	</ol>
		                	</div>
		            	</div>
		            	<div class="wrapper wrapper-content animated fadeInDown">
				
		<div class="row">
			<div class="col-md-12 dashboard-heading">
				<div class="ibox">
			                	<div class="ibox-title">
			                        		<h5> 概况</h5>
				                        	<div class="ibox-tools">
				                            		<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				                            		<a class="close-link"><i class="fa fa-times"></i></a>
				                          	</div>
			                          	</div>
			                          	<div class="ibox-content" style="display: block;">
      				                          	<div class="row">
      				                          		<div class="user-info col-md-4">
      				                          			<div class="widget-head-color-box navy-bg p-lg text-center">
							                            <h2 class="font-bold no-margins">
							                                	<?php echo session('nickname');?>
							                            </h2>
						                                	<h5><?php if($_SESSION['acttype'] == 1) echo '个人'; else echo '企业'; ?>用户</h5>
						                            	</div>
						                            	<div><img alt="image" class="img-circle" src="__PUBLIC__/images/user.png"></div>
						                            	<div>
							                               点击<a href="<?php echo U('Index/Usercenter/account');?>">修改个人信息</a>
						                            	</div>
      				                          		</div>
	      				                         	<div class="cloud-info col-md-4">
		                          					<div class="info-header">图片云信息</div>
		                          					<div class="hr-line-dashed"></div>
		                          					<div class="info-item">
						                          		<div>
							                                        	<span>存储空间：</span>
							                                        	<small class="pull-right">10/200 GB</small>
							                                </div>
							                                <div class="progress progress-small">
							                                	<div style="width: 60%;" class="progress-bar progress-default"></div>
							                                </div>		
		                          					</div>
		                          					<div class="hr-line-dashed"></div>
		                          					<div class="info-item">
						                                        	<span>图片空间数：</span>
						                                        	<small class="pull-right">5</small>
					                                        	</div>
					                                        	<div class="hr-line-dashed"></div>
		                          					<div class="info-item">
						                                        	<span>总图片数：</span>
						                                        	<small class="pull-right">73</small>
					                                        	</div>
					                                        	<div class="hr-line-dashed"></div>
	          			                          			<div class="info-item">
						                                        	<span>已使用流量：</span>
						                                        	<small class="pull-right">20.5MB</small>
					                                        	</div>	
      				                          		</div>
 							<div class="use-chart col-md-4">
 								<div class="info-header">云空间使用：</div>
							                <div class="flot-chart">
					                          			<div class="flot-chart-content" id="flot-pie-chart" style="width:300px;height:180px"></div>	
					                          		</div>		
 							</div>
	                          				</div>
			                          	</div>
			                 </div>
			</div>	
			<div class="col-md-6">
				<div class="ibox">
			                	<div class="ibox-title">
			                        		<h5> 空间信息</h5>
				                        	<div class="ibox-tools">
				                            		<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				                            		<a class="close-link"><i class="fa fa-times"></i></a>
				                          	</div>
			                          	</div>
			                          	<div class="ibox-content" style="display: block;">			                          	
			                   		<div class="space-info ">
	                          					<div class="info-item">
	                          						<span class="label label-success">1</span>
					                                        	<a href="#"><span>空间名1</span></a>
					                                        	<small class="pull-right">20张 / 55MB</small>
				                                        	</div>
							<div class="hr-line-dashed"></div>
	                          					<div class="info-item">
	                          						<span class="label label-info">2</span>
					                                        	<a href="#"><span>空间名1</span></a>
					                                        	<small class="pull-right">20张 / 55MB</small>
				                                        	</div>
							<div class="hr-line-dashed"></div>
	                          					<div class="info-item">
	                          						<span class="label label-primary">3</span>
					                                        	<a href="#"><span>空间名1</span></a>
					                                        	<small class="pull-right">20张 / 55MB</small>
				                                        	</div>
							<div class="hr-line-dashed"></div>
	                          					<div class="info-item">
	                          						<span class="label label-default">4</span>
					                                        	<a href="#"><span>空间名1</span></a>
					                                        	<small class="pull-right">20张 / 55MB</small>
				                                        	</div>				                                        					                                        					                                        	
                          					</div>
                          				</div>
                          			</div>
			</div>
			<div class="col-md-6">
				<div class="ibox">
			                	<div class="ibox-title">
			                        		<h5> 最近操作</h5>
				                        	<div class="ibox-tools">
				                            		<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				                            		<a class="close-link"><i class="fa fa-times"></i></a>
				                          	</div>
			                          	</div>
			                          	<div class="ibox-content" style="display: block;">			                          	
			                   		<div class="recent-control ">
	                          					<div class="info-item">
	                          						<p>上传图片abcde.jpg</p>
								<small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
				                                        	</div>
							<div class="hr-line-dashed"></div>
	                          					<div class="info-item">
	                          						<p>上传图片abcde.jpg</p>
								<small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
				                                        	</div>
                          					</div>
                          				</div>
                          			</div>
			</div>		
			<div class="col-md-12">
				<div class="ibox">
			                	<div class="ibox-title">
			                        		<h5> 最新图片</h5>
				                        	<div class="ibox-tools">
				                            		<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				                            		<a class="close-link"><i class="fa fa-times"></i></a>
				                          	</div>
			                          	</div>	
			                          	<div class="ibox-content" style="display: block;">			                          	
                          					<div class="row upload-gallery">
                      							<div class="file-box col-md-3">
					                                	<div class="file">
					                                    		<a href="#"><span class="corner"></span>
					                                       			<div class="image"><img alt="image" class="img-responsive" src="__PUBLIC__/images/p1.jpg"></div>
					                                        		<div class="file-name">
					                                            			My feel.png
					                                           		 <br>
					                                            		<small>上传时间: Jan 7, 2014</small>
					                                        		</div>
					                                    		</a>
					                               		</div>
					                            	</div>
                      							<div class="file-box col-md-3">
					                                	<div class="file">
					                                    		<a href="#"><span class="corner"></span>
					                                       			<div class="image"><img alt="image" class="img-responsive" src="__PUBLIC__/images/p3.jpg"></div>
					                                        		<div class="file-name">
					                                            			hahahl.png
					                                           		 <br>
					                                            		<small>上传时间: Jan 7, 2014</small>
					                                        		</div>
					                                    		</a>
					                               		</div>
					                            	</div>            	
                       						<div class="file-box col-md-3">
					                                	<div class="file">
					                                    		<a href="#"><span class="corner"></span>
					                                       			<div class="image"><img alt="image" class="img-responsive" src="__PUBLIC__/images/p4.jpg"></div>
					                                        		<div class="file-name">
					                                            			hahahl.png
					                                           		 <br>
					                                            		<small>上传时间: Jan 7, 2014</small>
					                                        		</div>
					                                    		</a>
					                               		</div>
					                            	</div>	
                       						<div class="file-box col-md-3">
					                                	<div class="file">
					                                    		<a href="#"><span class="corner"></span>
					                                       			<div class="image"><img alt="image" class="img-responsive" src="__PUBLIC__/images/p2.jpg"></div>
					                                        		<div class="file-name">
					                                            			hahahl.png
					                                           		 <br>
					                                            		<small>上传时间: Jan 7, 2014</small>
					                                        		</div>
					                                    		</a>
					                               		</div>
					                            	</div>						                            	
                          					</div>
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
	
		<script type="text/javascript" src="__PLUGIN__/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" src="__PLUGIN__/flot/jquery.flot.pie.min.js"></script>
		<script type="text/javascript" src="__PLUGIN__/flot/jquery.flot.tooltip.min.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/index.js"></script>
	
</body>
</html>