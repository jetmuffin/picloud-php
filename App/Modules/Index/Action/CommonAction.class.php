<?php 
    class CommonAction extends Action {
                            function _initialize(){
                            //判断是否登录
                                    if(!isset($_SESSION['uid'])){
                                            XS('LOGIN_MESSAGE',"请先登录<br />",60);
                                            $this->redirect("Index/Login");
                                    }
                            }      
             }
 ?>

