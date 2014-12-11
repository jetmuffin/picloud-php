<?php 
    class CommonAction extends Action {
		public $modules =  array(
		0 => array(
			"module_name" => "Index",
			"module_title" => "首页",
			"module_icon" => "home",
			"module_url" => "Index"
		),
		1 => array(
			"module_name" => "Picserver",
			"module_title" => "图片服务器",
			"module_icon" => "link",
			"module_url" => "#",
			"actions" => array(
				0=> array(
					"action_name" => "picspace",
					"action_title" => "图片空间",
					"action_url" => "picspace"
				),
				1 => array(
					"action_name" => "quickupload",
					"action_title" => "快速上传",
					"action_url" => "quickupload"
				),
			),
		),
		2 => array(
			"module_name" => "Appcenter",
			"module_title" => "应用中心",
			"module_icon" => "th-large",
			"module_url" => "#",
			"actions" => array(
				0 => array(
					"action_name" => "applist",
					"action_title" => "应用列表",
					"action_url" => "applist"
				),
				1 => array(
					"action_name" => "process",
					"action_title" => "图片处理",
					"action_url" => "process"
				),				
				2 => array(
					"action_name" => "hidfpic",
					"action_title" => "高清图片",
					"action_url" => "hidfpic"
				),
        3 => array(
          "action_name" => "tdgood",
          "action_title" => "3D物品",
          "action_url" => "tdgood"
        ),        
				4 => array(
					"action_name" => "overallview",
					"action_title" => "全景展示",
					"action_url" => "overallview"
				),
			),
		),
		3 => array(
			"module_name" => "Usercenter",
			"module_title" => "个人中心",
			"module_icon" => "user",
			"module_url" => "#",
			"actions" => array(
				0 => array(
					"action_name" => "account",
					"action_title" => "帐号管理",
					"action_url" => "account"
				),
				1 => array(
					"action_name" => "logs",
					"action_title" => "操作日志",
					"action_url" => "logs/1"
				),				
			),			
		),
	);
    function _initialize(){
      //判断是否登录
      // if(!isset($_SESSION['uid'])){
      //   XS('LOGIN_MESSAGE',"请先登录<br />",60);
      //   $this->redirect("Index/Login");
      // }

      $this->assign("modules",$this->modules);
      foreach ($this->modules as $key => $value) {
     		foreach ($value as $k => $v) {
     			if($v == MODULE_NAME) {
     				$module = $value;
     				break;
     			}
     		}
     	}
     	foreach ($module["actions"] as $key => $value) {
     		foreach ($value as $k => $v) {
       		if($v == ACTION_NAME) {
       			$action = $value;
       			break;
       		}
       	}
     	}
     	$this->assign("action",$action);
     	$this->assign("module",$module);
     }
}
 ?>

