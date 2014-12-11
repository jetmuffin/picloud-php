<?php 
  class LogModel extends Model{
    function __construct(){
    }

    public function page($page=null,$dir=null){
      $uid = $_SESSION['uid'];
      $appId = $_SESSION['appId'];
      
      if($page == 1)
        $post_data = array(
          'page' => $page,
          'uid' => $uid,
        );
      else
        $post_data = array(
          'page' => $page,
          'uid' => $uid,
          'appId' => $appId,
          'dir' => $dir
        );

      $url = "http://localhost:8080/PicServer/LogPage";
      $result=send_post($url, $post_data);
      $result= json_decode($result,true);
      $result = $result['page'];
      return $result;
    }

  }
 ?>   