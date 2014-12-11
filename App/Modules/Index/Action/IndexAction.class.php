<?php 
class IndexAction extends CommonAction {
      public function Index(){

            $logs = new LogModel();
            $log_list = $logs->page(1); 
            $log_pages = $log_list['list'];
            $this->assign("log_pages",$log_pages);

            $user_model = new UserModel();
            $user = $user_model->read();

            $space = new SpaceModel();
            $spaces = $space->listAll();
            $this->assign("spaces",$spaces);
            $this->assign("user",$user);
      	$this->assign("module_name","首页");
      	$this->assign("module_family","Home");
      	$this->display();
      }
}
 ?>