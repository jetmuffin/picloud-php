<?php 
	class UserModel extends Model{
		public $uid = '';
		public $pwd = '';
		private $checked=0;
		private $accountData=array();

		function __construct($uid='',$pwd=''){
			$this->uid=$uid;
			$this->pwd=$pwd;
		}

		public function checkAccount($uid=null,$pwd=null){
	    $uid = is_null($uid)?$this->uid : $uid;
		  $pwd = is_null($pwd)?$this->pwd : $pwd;

      $post_data = array(
        'uid' => $uid,
        'pwd' => $pwd,
      );
      $url = "http://localhost:8080/PicServer/Login";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result= $result['user'];

      if($result==null)
      	return false;
      else{
      	$this->checked = 1;
        $_SESSION['uid'] = $result['uid'];
      	return true;
      }
    }

     public function setAccountData(){
			if($this->checked){
				foreach ($this->accountData as $key => $value) {
          	if(in_array($key, array('pwd'))) continue;
          		$_SESSION[$key]=$value;
                  }
				$_SESSION['login_time']=time();
        	return 1;
        }else{
      		return 0;
      	}
		}
    
		public function addAccount($nickname = null){
      $uid = is_null($uid)?$this->uid : $uid;
      $pwd = is_null($pwd)?$this->pwd : $pwd;

      $post_data = array(
        'uid' => $uid,
        'pwd' => $pwd,
        'nickname' => $nickname
      );

      $url = "http://localhost:8080/PicServer/Register";
      $result=send_post($url, $post_data);
      if($result == "success") return true;
      return $false;

		}

    public function read($uid=null){
      $post_data = array(
        'uid' => $_SESSION['uid']
      );
      $url = "http://localhost:8080/PicServer/GetUser";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['User'];
      return $result;
    }


		public function modifyAttr($data=array()){
			$hbase = new HbaseModel("cloud_user");
			$result = $hbase->row($this->uid)->cols("attr")->add($data);
			return $result;
		}

		public function modifyVldt($data=array()){
			$hbase = new HbaseModel("cloud_user");
			$result = $hbase->row($this->uid)->cols("vldt")->add($data);
			return $result;
		}		
	}
 ?>