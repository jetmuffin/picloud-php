<?php 
	class PicserverAction extends CommonAction {
		public function Index(){
			$this->display();
		}

		public function picspace(){
			$this->display();
		}

		public function upload(){
			$this->display();
		}

		public function gallery(){
			$action = array(
					"action_name" => "picspace",
					"action_title" => "图片空间",
					"action_url" => "picspace"
			);

			$space = array(
				"space_id" => "1",
				"space_name" => "test"
			);
			$this->assign("action",$action);
			$this->assign("space",$space);
			$this->display();
		}
	}
 ?>