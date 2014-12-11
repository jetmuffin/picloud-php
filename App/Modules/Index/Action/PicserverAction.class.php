<?php 
	class PicserverAction extends CommonAction {
		public $action = array(
			"action_name" => "picspace",
			"action_title" => "图片空间",
			"action_url" => "picspace"
		);
		public function Index(){
			$this->display();
		}

		public function deletespace(){
			$space = $_GET['space'];
			$space_model = new SpaceModel();
			$flag = $space_model->delete($space);
			if($flag)
				$this->success('删除成功',U('Picserver/picspace'));
			else
				$this->error('删除失败',U('Picserver/picspace'));
		}

		public function deletepic(){
			$picture = $_GET['image'];
			$picture_model = new PictureModel();
			$flag = $picture_model->delete($picture);
			if($flag)
				$this->success('删除成功',U('Picserver/picspace'));
			else
				$this->error('删除失败',U('Picserver/picspace'));
		}

		public function picspace(){
			$space = new SpaceModel();
			$spaces = $space->listAll();
			$this->assign("spaces",$spaces);
			// dump($spaces);
			$this->display();
		}

		public function setcover(){
			$picture = $_GET['image'];
			$space = $_GET['space'];
			$space_model = new SpaceModel();
			$flag = $space_model->cover($space,$picture);
			if($flag)
				$this->success('设置成功',U('Picserver/view'.'/'.$picture));
			else
				$this->error('设置失败',U('Picserver/view'.'/'.$picture));		
		}

		public function quickupload(){
			$space = new SpaceModel();
			$spaces = $space->listAll();
			$this->assign("spaces",$spaces);
			$this->display();
		}

		public function gallery(){
			$space_name = $_GET["space_name"];
			$spacemodel = new SpaceModel();
			$space = $spacemodel->read($space_name);
			$spaces = $spacemodel->listAll();
			$_SESSION["space"] = $space;

			$pages = new PictureModel();
			// dump($_GET['log_page']);
			if($_GET['dir'])
				$pic_list = $pages->page($space_name,$_GET['page'],$_GET['dir']); 
			else
				$pic_list = $pages->page($space_name,$_GET['page'],null); 
			$pic_pages = $pic_list['list'];
			$_SESSION['appId'] = $pic_list['appId'];
			// dump($pic_list);
			$this->assign('pic_list',$pic_list);


			$picture = new PictureModel();
			$pictures = $picture->listAll($space["name"]);
			$this->assign("space",$space);
			$this->assign("spaces",$spaces);
			$this->assign("action",$this->action);
			$this->assign("pictures",$pic_pages);
			$this->display();
		}

		public function view(){
			$space =  $_SESSION["space"];
			$picture = array(
				"name" => $_GET['picture_name']
			);			
			$picturemodel = new PictureModel();
			$image = $picturemodel->read($picture['name']);	
			$images_random = $picturemodel->getRandom($space["name"]);
			// dump($image);
			$this->assign("action",$this->action);
			$this->assign("picture",$picture);
			$this->assign("image",$image);
			$this->assign("images_random",$images_random);
			$this->assign("space",$space);
			$this->display();
		}

		public function upload(){
			$space_name = $_GET['space_name'];
			$space = array(
				"name" => $space_name
			);
			$option = "上传";
			$this->assign("action",$this->action);
			$this->assign("space",$space);
			$this->assign("option",$option);
			$this->display();
		}

		public function createSpace(){
			if(I('name')&&I('desc')){
				$space = new SpaceModel();

				$result = $space->create(I('name'),I('desc'));
				if($result){
					$this->success('success',U('Picserver/picspace'));	
				} else{
					$this->error('failed',U('Picserver/picspace'));	
				}
			}else{
				$this->error('failed',U('Picserver/picspace'));	
			}
		}
	}
 ?>