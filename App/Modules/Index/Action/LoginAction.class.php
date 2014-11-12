<?php 
	class LoginAction extends Action {
	
	public function login(){
		$user=new UserModel(I('uid'),I('pwd'));
		$result=$user->checkAccount();

		if($result==-1){     //登录成功，但账户被禁用
			$this->error(L('登录失败，账户被禁用'), U('Index/Login'));
			$this->RedirecttoIndex();
		}else if($result==0){   //登录失败
			$this->error(L('登录失败，帐号或密码错误'), U('Index/Login'));
			$this->RedirecttoIndex();
		}else{
			$user->setAccountData();
			$this->success(L('登录成功！'), U('Index/Index'));
		}
	}

	private function RedirecttoIndex(){
		$this->redirect('Index/Login',array('uid'=>I('uid')));
	}

	public function logout(){
		session(null);
		$this->success(L('退出成功！'), U('Index/Login'));
	}
}
 ?>