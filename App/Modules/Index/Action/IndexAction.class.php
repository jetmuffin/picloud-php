<?php 
	class IndexAction extends CommonAction {
		public function Index(){
			$this->assign("module_name","首页");
			$this->assign("module_family","Home");
			$this->display();
		}
	}
 ?>