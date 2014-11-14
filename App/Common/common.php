<?php 
	require("nav.php");

/**
 * 增强型SESSION控制函数
 * 可以对每一个键值设定过期时间
 * 使用缓存（memcache）缓存这些数据，因此过期时间较短，不能列出所有值，使用时应该存放临时变量
 * 所以只作为session函数的扩展，不能代替其用途
 * @param [string]  $key    [键名]
 * @param $val    [键值]
 * @param integer $expire [description]
 */
function XS($key,$val='',$expire=1800){
	$sessid=session_id();
	$s_key='XS'.$sessid.$key;
	//取值
	if($val===''){
		return S($s_key);
	}else if(is_null($val)){   //删除键值
		return S($s_key,null);
	}else{
		return S($s_key,$val,$expire);
	}
}

/**
 * 改进时间戳转换函数
 * 可以将时间戳转换为给定格式(如：昨天 15:11)
 * @param [Integer]  $time    [时间戳]
*/ 
function time_passed($time=null){
	$now = time();
	$timediff = $now-$time; 
	$days = intval($timediff/86400); 
	$remain = $timediff%86400; 
	// $hours = intval($remain/3600); 
	// $remain = $remain%3600; 
	// $mins = intval($remain/60); 
	// $secs = $remain%60; 

	$timeclock=date('H:i:s',$time);
	if(!$days){
		return '今天 '.$timeclock;
	}else if($days == 1){
		return '昨天 '.$timeclock;
	}else if($days == 2){
		return '前天 '.$timeclock;
	}else{
		return $days.' 天前';
	}
}

?>