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

      $hbase = new HbaseModel("cloud_user");
			$rows = $hbase->where(array("row"=>$uid))->find();
			$vldtpwd = $rows[0]->columns["vldt:pwd"]->value;
			$nickname = $rows[0]->columns["attr:nickname"]->value;
			$lastlogin = $rows[0]->columns["attr:lastlogin"]->value;
			$email = $rows[0]->columns["attr:email"]->value;
			$acttype =  $rows[0]->columns["attr:acttype"]->value;
			$website = $rows[0]->columns["attr:website"]->value;

			$lastlogin = time_passed($lastlogin);
			$now = time();
			$hbase->row($uid)->cols("attr")->add(array("lastlogin"=>$now));
		             
		  //Todo : user - checked
     	$this->checked = 1;
		             
		  if($rows && $vldtpwd == $pwd){
		 		$result = array(
		 			'uid'=>$uid,
		 			'pwd'=>$pwd,
		 			'nickname'=>$nickname,
		 			'lastlogin'=>$lastlogin,
		 			'acttype'=>$acttype,
		 			'email'=>$email,
		 			'website'=>$website
		 		);
		 		$this->accountData = $result;
		 		return $result;
		 	}
		 		else 
		 			return 0;
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

		public function addAccount($nickname=null){
	  	$uid = is_null($uid)?$this->uid : $uid;
	   	$pwd = is_null($pwd)?$this->pwd : $pwd;
	   	$hbase = new HbaseModel("cloud_user");

     	$vldt_data=array(
				"pwd"=>$pwd
			);
     	$attr_data=array(
				"nickname"=>$nickname
			);
			$result = $hbase->row($uid)->cols("vldt")->add($vldt_data);
			$result = $result && $hbase->row($uid)->cols("attr")->add($attr_data);
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