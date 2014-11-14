<?php 
	$modules =  array(
		[0] => array(
			"module_name" => "Index",
			"module_title" => "首页",
			"module_icon" => "home",
			"module_url" => "index"
		),
		[1] => array(
			"module_name" => "Picserver",
			"module_title" => "图片服务器",
			"module_icon" => "link",
			"module_url" => "#",
			"actions" => array(
				[0] => array(
					"action_name" => "Picspace",
					"action_title" => "图片空间",
					"action_url" => "Picspace"
				),
				[1] => array(
					"action_name" => "Upload",
					"action_title" => "快速上传",
					"action_url" => "Upload"
				),
			),
		),
		[2] => array(
			"module_name" => "Appcenter",
			"module_title" => "应用中心",
			"module_icon" => "th-large",
			"module_url" => "#",
			"actions" => array(
				[0] => array(
					"action_name" => "Applist",
					"action_title" => "应用列表",
					"action_url" => "Applist"
				),
				[1] => array(
					"action_name" => "Process",
					"action_title" => "图片处理",
					"action_url" => "Process"
				),				
				[2] => array(
					"action_name" => "HighDefi",
					"action_title" => "高清图片",
					"action_url" => "Hidfpic"
				),
				[3] => array(
					"action_name" => "Overallview",
					"action_title" => "全景展示",
					"action_url" => "Overallview"
				),
			),
		),
		[3] => array(
			"module_name" => "Usercenter",
			"module_title" => "个人中心",
			"module_icon" => "user",
			"module_url" => "Usercenter",
		),
	)
 ?>