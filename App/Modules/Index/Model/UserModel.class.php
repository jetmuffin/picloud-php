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
		                //Todo : user - checked
		             $this->checked = 1;
		             if($rows && $vldtpwd == $pwd){
		 		$result = array(
		 			'uid'=>$uid,
		 			'pwd'=>$pwd
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

		public function addAccount(){
	                	$uid = is_null($uid)?$this->uid : $uid;
		             $pwd = is_null($pwd)?$this->pwd : $pwd;
		             $hbase = new HbaseModel("cloud_user");

		             $data=array(
				"pwd"=>$pwd
			);
			$result=$hbase->row($uid)->cols("vldt")->add($data);
			return $result;
		}
	}
 ?>