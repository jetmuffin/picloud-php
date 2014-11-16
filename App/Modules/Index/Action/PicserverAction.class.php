<?php 
	class PicserverAction extends CommonAction {
		public $action = array(
			"action_name" => "picspace",
			"action_title" => "图片空间",
			"action_url" => "picspace"
		);
		public function Index(){
			$this->display();
		}

		public function picspace(){
			$this->display();
		}

		public function quickupload(){
			$this->display();
		}

		public function gallery(){
			$space = array(
				"space_id" => $_GET["space_id"],
				"space_name" => "test"
			);
			$_SESSION["space_id"] = $_GET["space_id"];
			$this->assign("action",$this->action);
			$this->assign("space",$space);
			$this->display();
		}

		public function view(){
			$space = array(
				"space_id" => $_SESSION["space_id"],
				"space_name" => "test"
			);
			$picture = array(
				"picture_id" => '1',
				"picture_name" => 'helloworld.jpg'
			);			
			$this->assign("action",$this->action);
			$this->assign("picture",$picture);
			$this->assign("space",$space);
			$this->display();
		}
		public function upload(){
			$space = array(
				"space_id" => $_GET["space_id"],
				"space_name" => "test"
			);
			$option = "上传";
			$this->assign("action",$this->action);
			$this->assign("space",$space);
			$this->assign("option",$option);
			$this->display();
		}
	}
 ?>