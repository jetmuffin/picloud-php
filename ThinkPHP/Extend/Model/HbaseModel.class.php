<?php
// +----------------------------------------------------------------------
// | BeauytSoft
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://beauty-soft.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: ceiba <kf@86055.com>
// +----------------------------------------------------------------------
// |Version：0.1
// +----------------------------------------------------------------------
class HbaseModel extends Model{
	function _initialize(){
		C("DB_PREFIX",C("HBASE_DB_PREFIX"));
	}
    /**
     *----------------------------------------------------------
     * 利用__call方法实现一些特殊的Model方法
     *----------------------------------------------------------
     * @access public
     *----------------------------------------------------------
     * @param string $method 方法名称
     * @param array $args 调用参数
     *----------------------------------------------------------
     * @return mixed
     *----------------------------------------------------------
     */
    public function __call($method,$args) {  	
        if(in_array(strtolower($method),array('row','cols','where','order','limit','page'),true)) {
            // 连贯操作的实现
            
            $this->options[strtolower($method)] =   $args[0];
            return $this;
        }else{
            throw_exception(__CLASS__.':'.$method.L('_METHOD_NOT_EXIST_'));
            return;
        }
    }

    /**
    *   重写_parseOptions方法防止字段被清除
    *   @author Jet-Muffin
    */
    protected function _parseOptions($options=array()) {
        if(is_array($options))
            $options =  array_merge($this->options,$options);
        // 查询过后清空sql表达式组装 避免影响下次查询
        $this->options  =   array();
        if(!isset($options['table'])){
            // 自动获取表名
            $options['table']   =   $this->getTableName();
            $fields             =   $this->fields;
        }else{
            // 指定数据表 则重新获取字段列表 但不支持类型检测
            $fields             =   $this->getDbFields();
        }
        if(!empty($options['alias'])) {
            $options['table']  .=   ' '.$options['alias'];
        }
        // 记录操作的模型名称
        $options['model']       =   $this->name;

        // 表达式过滤
        $this->_options_filter($options);
        return $options;
    }

    /**
     *----------------------------------------------------------
     * count统计 配合where连贯操作
     *----------------------------------------------------------
     * @access public
     *----------------------------------------------------------
     * @return integer
     *----------------------------------------------------------
     */
    public function count(){
        // 分析表达式
        $options =  $this->_parseOptions();
        return $this->db->count($options);
    }
	public function add($data){
        // 分析表达式
        $options =  $this->_parseOptions();
        return $this->db->add($options,$data);
    }
    public function find($data){
    	// 查询表达式
    	$options =  $this->_parseOptions();
    	return $this->db->find($options);
    }
	public function delete($way=""){
        // 分析表达式
        $options =  $this->_parseOptions();
        return $this->db->delete($options,$way);
    }
}
?>