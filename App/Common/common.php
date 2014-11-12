<?php 

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
 ?>