<?php 
	class SpaceModel extends Model{
    public $name = "";
    public $desc = "";
    public $cover = "";
    
    public $storage  = 0;
    public $number = 0;
    public $flow = 0;

    function __construct($name=''){
      $this->name = $name;
    }

    public function create($name=null,$desc=null){
      $name = is_null($name)?$this->name : $name;
      $post_data = array(
        'name' => $name,
        'desc' => $desc,
        'uid' => $_SESSION['uid']
      );
      $url = "http://localhost:8080/PicServer/CreateSpace";
      $result=send_post($url, $post_data);
      if($result == 'success') return true;
      else return false;
    }

    public function read($name=null){
      $name = is_null($name)?$this->name : $name;
      $post_data = array(
        'name' => $name,
        'uid' => $_SESSION['uid']
      );
      $url = "http://localhost:8080/PicServer/GetSpace";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['Space'];
      return $result;
    }

    public function delete($space=null){
      $uid = $_SESSION['uid'];
      $post_data = array(
        'space' => $space,
        'uid' => $_SESSION['uid']
      );
      $url = "http://localhost:8080/PicServer/DeleteSpace";
      $result=send_post($url, $post_data);
      if($result == "success")
        return true;
      else
        return false;
    }

    public function cover($space=null,$image=null){
      $uid = $_SESSION['uid'];
      $post_data = array(
        'space' => $space,
        'uid' => $uid,
        'image' => $image
      );    
      $url = "http://localhost:8080/PicServer/SetCover";
      $result=send_post($url, $post_data);
      if($result == "success")
        return true;
      else
        return false;      
    }

    public function listAll(){
      $uid = $_SESSION['uid'];
      $post_data = array(
        'uid' => $uid,
      );

      $url = "http://localhost:8080/PicServer/ListSpace";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['Spaces'];
      return $result;
    }
}
?>