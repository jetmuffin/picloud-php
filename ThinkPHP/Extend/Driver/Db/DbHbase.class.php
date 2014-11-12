<?php 
// +----------------------------------------------------------------------
// | Hadoop Database For ThinkPHP Drive 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://beauty-soft.net
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: http://beauty-soft.net/blog
// +----------------------------------------------------------------------
// |Version：0.1
// +----------------------------------------------------------------------
class  DbHbase extends Db{
	protected $_hbase           =   null; 
	protected $_keyname      =   null; 
	protected $_dbName          =   ''; 
	protected $_cursor          =   null; 
	protected $_transportq		=  null;
	public function __construct($config=''){
		if ( !class_exists('TSocket') ) {
			define('THRIFT_DIR',dirname(__FILE__).'/thrift/php/src');
			if (!file_exists(THRIFT_DIR . '/Thrift.php')){
				throw_exception(L('_NOT_SUPPERT_').':no gen Thrift form php');
			}
			require_once( THRIFT_DIR . '/Thrift.php' );
			require_once( THRIFT_DIR . '/transport/TSocket.php' );
			require_once( THRIFT_DIR . '/transport/TBufferedTransport.php' );
			require_once( THRIFT_DIR. '/protocol/TBinaryProtocol.php' );
			require_once( THRIFT_DIR . '/packages/Hbase/Hbase.php' );
		}
		if(!empty($config)) {
			$this->config   =   array(
					"ZOOKEEPER_HOST"=>C("ZOOKEEPER_HOST"),
					"ZOOKEEPER_PORT"=>C("ZOOKEEPER_PORT"),
					"ZOOKEEPER_SENDTIMEOUT"=>C("ZOOKEEPER_SENDTIMEOUT"),
					"ZOOKEEPER_RECVTIMEOUT"=>C("ZOOKEEPER_RECVTIMEOUT"),
			);
                                       $this->config = array_merge($this->config,$config);
			if(empty($this->config['params'])) {
				$this->config['params'] =   array();
			}
	
		}

		$this->connect();
	}
	public function connect($config='',$linkNum=0) {
		if ( !isset($this->linkID[$linkNum]) ) {
			if(empty($config))  $config =   $this->config;
			$socket = new TSocket($config["ZOOKEEPER_HOST"]?$config["ZOOKEEPER_HOST"]:"localhost", $config["ZOOKEEPER_PORT"]?$config["ZOOKEEPER_PORT"]:9090);  
			$socket->setSendTimeout($config["ZOOKEEPER_SENDTIMEOUT"]?$config["ZOOKEEPER_SENDTIMEOUT"]:10000); 
			$socket->setRecvTimeout($config["ZOOKEEPER_RECVTIMEOUT"]?$config["ZOOKEEPER_RECVTIMEOUT"]:20000); 
			$transport = new TBufferedTransport($socket);
			$this->_transport=$transport;
			$protocol = new TBinaryProtocol($transport);
			$client = new HbaseClient($protocol);
			// 标记连接成功
			if ($client){
				$transport->open();
				$this->linkID[$linkNum] = $client;
				//不支持多套hbase
				$this->_linkID=$client;
				$this->connected    =   true;
			}else{
				
				throw_exception(L('_NOT_SUPPERT_').':hbase connetc full');
			}
			// 注销数据库连接配置信息
			if(1 != C('DB_DEPLOY_TYPE')) unset($this->config);
		}
		return $this->linkID[$linkNum];
	}
	public function free() {
		$this->_cursor = null;
	}
	public function close() {
		if($this->_linkID) {
			$this->_transport->close();
			$this->_linkID = null;
			$this->_redis = null;
			$this->_keyname =  null;
			$this->_cursor = null;
		}
	}
    public function select($options=array()) {
        $cache  =  isset($options['cache'])?$options['cache']:false;
        if($cache) { 
            $key =  is_string($cache['key'])?$cache['key']:md5(serialize($options));
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }
        $this->model  =   $options['model'];
        N('db_query',1);
        $field =  $this->parseField($options['field']);
        try{
            if(C('DB_SQL_LOG')) {
                $this->queryStr   =  $this->_dbName.'查询出错:'.$field;
            }
            G('queryStartTime'); 
            $this->debug();
            $array=array();
            $scan = new TScan();;
            if (count($options["where"]) || $options['cols']){
            	$logic_str="AND";
            	$filter=null;
            	if (array_key_exists("value", $options["where"])){
            		//基于值过滤
            		$operator_str=$this->operatorConvString($options["where"]["value"][0]);
            		$filter ="(ValueFilter($operator_str,'substring:{$options["where"]['value'][1]}'))";
            	}
            	if (array_key_exists("column", $options["where"])){
            		//基于列过滤
            		if(count($options["where"])<=1) $logic_str="";
            		$operator_str=$this->operatorConvString($options["where"]["column"][0]);
            		$filter.=" ".$logic_str." (QualifierFilter($operator_str,'substring:".$options["where"]['column'][1]."')) ";
            	}
            	if (array_key_exists("row", $options["where"])){
            		$scan->startRow=$options["where"]['row'];
            		$scan->stopRow=$options["where"]['row'];
            	}
            	if ($options['cols']){
            		if (empty($options["where"])){
            			$logic_str="";
            		}
            		$filter.=$logic_str." (FamilyFilter(=,'substring:".$options['cols']."'))";
            	}
            	$scan->filterString=$filter;
            }
            if (!stripos($options['limit'],",")){
            	$limit=30;
            	if ($options['limit']) $limit=$options['limit'];
            	$scanner = $this->_linkID->scannerOpenWithScan($options["table"], $scan,null);
            	$get_arr = $this->_linkID->scannerGetList($scanner,$limit);
            	$array=$get_arr;
	           
            }else{
            	$limit=explode(",", $options["limit"]);
            	$scan->startRow=$limit[0];
            	$scan->stopRow=$limit[1];
            	$scanner = $this->_linkID->scannerOpenWithScan($options["table"], $scan,null);
            	$get_arr = $this->_linkID->scannerGetList($scanner,10000);
            	$array=$get_arr;
            } 
            $this->_cursor =  $array;
            $resultSets  =  $array;
            if($cache && $resultSet ) { // 查询缓存写入
            	S($key,$resultSet,$cache['expire'],$cache['type']);
            }
            $this->_linkID->scannerClose($scanner);
            return $resultSets;
        } catch (Exception $e) {
            throw_exception($e->getMessage());
        }
       
    
    }
    public function find($options=array()){
    	$options["limit"]=1;
    	return $this->select($options);
    }
    public function add($options=array(),$data){
    	$row = $options['row'];//row name
    	if($row && $options["table"]){
    		$columns=array();

    		foreach ( $this->_linkID->getColumnDescriptors($options["table"]) as $col=>$desc ) {
    			$columns[] = $desc->name;
    		}
    		$cols=$options['cols'].':';
    		if (empty($options['cols'])){
    			$cols=$columns[0];
    		}
    		$mutations = array();
    		foreach ($data as $key=>$value){
    			$ms=new Mutation( array(
    				'column' => $cols.$key,
    				'value' => $value
    			));
    			array_push($mutations, $ms);
    		}
    		$res=$this->_linkID->mutateRow( $options["table"], $row, $mutations );
    		return true;
    	}else{
    		return false;
    	}
    }
    public function save($options=array(),$data){
    	$this->add($options,$data);
    }
    public function delete($options=array(),$way=""){
    	dump($options);
    	if($options["where"]['row']){
    		$row = $options["where"]['row'];
    		if (!array_key_exists("column", $options["where"])){
    			$res=$this->_linkID->deleteAllRow( $options["table"], $row, null );
    			return $res;
    		}else{
    			$cols=$options['cols'].':';
    			if (empty($options['cols'])){
    				$columns=array();
    				foreach ( $this->_linkID->getColumnDescriptors($options["table"]) as $col=>$desc ) {
    					$columns[] = $desc->name;
    				}
    				$cols=$columns[0];
    			}
    			$column=$options["where"]['column'];
    			$column= $cols.$column;
    			$res=$this->_linkID->deleteAll($options["table"],$row,$column,null);
    			return $res;
    		}
    	}
    }
    public function getFields($tablename){
    	N('db_query',1);
    	$columns=array();
    	foreach ( $this->_linkID->getColumnDescriptors($tablename) as $col=>$desc ) {
    		$columns[] = $desc->name;
    	}
    	return $columns;
    }
    protected function operatorConvString($str,$type=0){
    	$operator_str='=';
    	switch ($str){
    		case "eq":
    			$operator_str='=';
    			break;
    		case "neq":
    			$operator_str='!=';
    			break;
    		case "gt":
    			$operator_str='>';
    			break;
    		case "egt":
    			$operator_str='>=';
    			break;
    		case "lt":
    			$operator_str='<';
    			break;
    		case "elt":
    			$operator_str='<=';
    			break;
    	}
    	return $operator_str;
    }
  
	
}


?>