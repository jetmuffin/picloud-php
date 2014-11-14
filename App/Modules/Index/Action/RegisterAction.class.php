<?php 
class RegisterAction extends Action {
	/**
	*	控制器
	*	@author Jet-Muffin
	*/
	public function Index(){
		if(session('uid')){
			$this->success('您已经登录过，现在将跳转回首页',U('Index/Index'));
			die;
		}
		if(XS('REGISTER_MESSAGE')){
			$this->assign('register_msg_box',1);
			$this->assign('register_msg',XS('REGISTER_MESSAGE'));				
		}
		$this->display();
	}
	public function register(){
		if(!I('uid')){
			XS('REGISTER_MESSAGE',"用户名不能为空<br />",60);
			$this->redirect('Index/Register');
		}elseif(!I('nickname')){
			XS('REGISTER_MESSAGE',"昵称不能为空<br />",60);
			$this->redirect('Index/Register');
		}else if(!I('pwd')){
			XS('REGISTER_MESSAGE',"密码不能为空<br />",60);
			$this->redirect('Index/Register');
		}else if(!I('pwd-again')){
			XS('REGISTER_MESSAGE',"请输入确认密码<br />",60);
			$this->redirect('Index/Register');
		}else if(I('pwd-again') != I('pwd')){
			XS('REGISTER_MESSAGE',"两次输入的密码必须一致<br />",60);
			$this->redirect('Index/Register');
		}else{
			$user = new UserModel(I('uid'),I('pwd'));
			$result = $user->addAccount(I('nickname'));
			if($result){
				$this->success('注册成功，请登录',U('Index/Login'));	
			} else{
				$this->error('注册失败',U('Index/Register'));	
			}
		}
	}
}
 ?>