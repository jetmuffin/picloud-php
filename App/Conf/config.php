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

  	//模板设置
	'TMPL_PARSE_STRING'	=> array(
       		'__PUBLIC__'      => __ROOT__ . '/Public',
		'__PLUGIN__'	=> __ROOT__ . '/Public/plugins',
        		'__UPLOAD__'     => __ROOT__ . '/Upload',
		'__NAME__'	=> 'Piccloud图片存储云',
		'__NAME-EN__'	=> 'piccloud',
	),    
);
?>