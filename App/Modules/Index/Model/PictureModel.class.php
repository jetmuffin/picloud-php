<?php 
	class PictureModel extends Model{
    public $name = "";
    public $size = "";
    public $type = "";
    public $space = "";
    public $usr = "";
    public $createTime = "";
    public $path="";
    public $status = "";
    public $updateTime = "";
    public $visitCount = "";
    public $visitFlow = "";

    function __construct(){
    }

    public function listAll($space=null){
      $uid = $_SESSION['uid'];
      $post_data = array(
        'space' => $space,
        'uid' => $uid
      );
      $url = "http://localhost:8080/PicServer/ListPicture";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['Picture'];
      return $result;
    }

    public function read($picture){
      $post_data = array(
        'name' => $picture,
        'uid' => $_SESSION['uid']
      );
      $url = "http://localhost:8080/PicServer/GetPicture";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['Picture'];
      return $result;
    }

    public function page($space=null,$page=null,$dir=null){
      $uid = $_SESSION['uid'];
      $appId = $_SESSION['appId'];
      
      if($page == 1)
        $post_data = array(
          'page' => $page,
          'uid' => $uid,
          'space' => $space
        );
      else
        $post_data = array(
          'page' => $page,
          'uid' => $uid,
          'appId' => $appId,
          'dir' => $dir,
          'space' => $space
        );
      // dump($post_data);
      // die();
      $url = "http://localhost:8080/PicServer/PicPage";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['page'];
      return $result;
    }

    public function delete($picture=null){
      $uid = $_SESSION['uid'];
      $post_data = array(
        'image' => $picture,
        'uid' => $_SESSION['uid']
      );
      $url = "http://localhost:8080/PicServer/DeleteImage";
      $result=send_post($url, $post_data);
      if($result == "success")
        return true;
      else
        return false;
    }

    public function getRandom($space=null){
      $images = $this->listAll($space);
      $images_random = array();
      $rand_keys = array_rand($images, 5);
      for ($i= 0;$i< count($rand_keys); $i++)
        array_push($images_random,$images[$rand_keys[$i]]);
      shuffle($images_random);
      return $images_random;
    }
	}
 ?>