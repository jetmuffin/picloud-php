<?php 
	class UsercenterAction extends CommonAction {
		public function Index(){
			$this->display();
		}

		public function account(){
			$this->display();
		}

		public function logs(){
			$logs = new LogModel();
			if($_GET['dir'])
				$log_list = $logs->page($_GET['log_page']-1,$_GET['dir']); 
			else
				$log_list = $logs->page($_GET['log_page']-1,null); 
			$log_pages = $log_list['list'];
			$_SESSION['appId'] = $log_list['appId'];
			$this->assign('log_list',$log_list);
			$this->assign('log_pages',$log_pages);
			$this->display();
		}

		public function modifyBasicInfo(){
			$uid = $_SESSION['uid'];
			$user = new UserModel($uid,'null');
			$data = array(
				"nickname" => I('nickname'),
				"website" => I('website')
			);
			$result = $user->modifyAttr($data);
			if(!$result)
				$this->error('修改错误',U('Index/Usercenter/account'));
			else{
				foreach ($data as $key => $value) {
      		$_SESSION[$key]=$value;
        }
				$this->success('修改成功',U('Index/Usercenter/account'));
			}
		}

		public function modifyPass(){
			$uid = $_SESSION['uid'];
			$user = new UserModel($uid,'null');
			$data = array(
				"pwd" => I('pwd'),
			);
			$result = $user->modifyVldt($data);
			if(!$result)
				$this->error('修改错误',U('Index/Usercenter/account'));
			else
				$this->success('修改成功',U('Index/Usercenter/account'));
		}		
	}
 ?>