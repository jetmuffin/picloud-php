<?php
return array(
	//模块分组
	'APP_GROUP_LIST' => 'Index,Admin',
	'DEFAULT_GROUP' => 'Index',
	'APP_GROUP_MODE' => 1,
	'APP_GROUP_PATH' => 'Modules',

	'DB_TYPE'               => 'hbase',      // 数据库类型
	'ZOOKEEPER_HOST'=>'0.0.0.0',     //zookkper服务地址
	'ZOOKEEPER_PORT'=>'9090',

	'DB_PREFIX' => '',       //数据库前缀
	
	'DATA_CACHE_TYPE' => 'Memcache', 	//缓存改为Memcache
	'MEMCACHE_HOST'   =>  'tcp://127.0.0.1:11211', 
	'DATA_CACHE_TIME' => '3600',    	//缓存时间
	
  	//模板设置
	'TMPL_PARSE_STRING'	=> array(
       		'__PUBLIC__'      => __ROOT__ . '/Public',
		'__PLUGIN__'	=> __ROOT__ . '/Public/plugins',
        		'__UPLOAD__'     => __ROOT__ . '/Upload',
		'__NAME__'	=> 'Picloud图片存储云',
		'__NAME-EN__'	=> 'Picloud',
	),    

	 //启用路由功能
	    'URL_ROUTER_ON'=>true,
	    //路由定义
	    'URL_ROUTE_RULES'=> array(
	        'Picserver/space/:space_id'=>'Index/Picserver/gallery', //规则路由
	        'Picserver/view/:picture_id'=>'Index/Picserver/view', //规则路由
	        'Picserver/upload/:space_id'=>'Index/Picserver/upload', //规则路由
	    ),
);
?>