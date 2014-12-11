<?php 
class LoginAction extends Action {
	/**
	*	登录控制器
	*	@author Jet-Muffin
	*/
	public function Index(){
		if(session('uid'))
		{
			$this->success('您已经登录过，现在将跳转回首页',U('Index/Index'));
			die;
		}
		if(XS('LOGIN_MESSAGE'))
		{
			$this->assign('login_msg_box',1);
			$this->assign('login_msg',XS('LOGIN_MESSAGE'));				
		}
		$this->display();
	}

	/**
	*	密码验证
	*/
	public function login(){
		if(!I('uid')){
			XS('LOGIN_MESSAGE',"帐号不能为空<br />",60);
			$this->RedirecttoIndex();
		}else if(!I('pwd')){
			XS('LOGIN_MESSAGE',"密码不能为空<br />",60);
			$this->RedirecttoIndex();
		}else{
			$user=new UserModel(I('uid'),I('pwd'));
			$result=$user->checkAccount();

			if($result == null){
				XS('LOGIN_MESSAGE',"抱歉，您输入的账号密码有误<br />",60);
				$this->RedirecttoIndex();				
			} else {
				$this->redirect('Index/Index');
			}
		}
	}

	private function RedirecttoIndex(){
		$this->redirect('Index/Login');
	}

	public function logout(){
		session(null);
		$this->redirect('Index/Login');
	}
}
 ?>