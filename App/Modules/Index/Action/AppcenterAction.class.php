<?php 
	class AppcenterAction extends CommonAction {
		public function Index(){
			$this->display();
		}

		public function applist(){
			$this->display();
		}
		
		public function process(){
			$spacemodel = new SpaceModel();
			$space = $spacemodel->read($space_name);
			$spaces = $spacemodel->listAll();
			$picture = array(
				'name' => $_GET['picture_name']
			);
			if($picture['name']) {
				$picturemodel = new PictureModel();
				$image = $picturemodel->read($picture['name']);	
			}
			$this->assign("picture",$picture);
			$this->assign("pic_space",$image['space']);
			$this->assign("spaces",$spaces);
			// dump($spaces);
			$this->display();
		}

		public function hidfpic(){
			$spacemodel = new SpaceModel();
			$spaces = $spacemodel->listAll();
			$this->assign("spaces",$spaces);
			$this->display();
		}

		public function hdcreate(){
			$post_data = array(
					'uid' => I('uid'),
					'image' => I('picture')
				);
      $url = "http://localhost:8080/PicServer/WriteHd";
      $result=send_post($url, $post_data);
      dump($result);
				if($result == 'success'){
					$this->success('success',U('Appcenter/hidfpic'));	
				} else{
					$this->error('failed',U('Appcenter/hidfpic'));	
				}
		}

		public function hdview(){
			$action = array(
					"action_name" => "hidfpic",
					"action_title" => "高清图片",
					"action_url" => "hidfpic"
			);
			$picture = array(
				'name' => $_GET['picture_name']
			);
			$this->assign('picture',$picture);
			$this->assign('action',$action);
			$this->display();
		}

		public function panoview(){
			$action = array(
					"action_name" => "overallview",
					"action_title" => "全景展示",
					"action_url" => "overallview"
			);
			$picture = array(
				'name' => $_GET['picture_name']
			);
			$this->assign('picture',$picture);
			$this->assign('action',$action);
			$this->display();			
		}
		
		public function tdgood(){
			$this->display();
		}

		public function tdview(){
			$action = array(
					"action_name" => "tdgood",
					"action_title" => "3D图片",
					"action_url" => "tdgood"
			);
			$picture = array(
				'name' => $_GET['picture_name']
			);
			$this->assign('picture',$picture);
			$this->assign('action',$action);
			$this->display();			
		}

		public function overallview(){
			$this->display();
		}
	}
 ?>