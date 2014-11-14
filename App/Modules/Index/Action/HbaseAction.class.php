<?php
class  HbaseAction extends Action{
	//查询   (可联合cols方法使用)
	public function  index(){
		$hbase=new HbaseModel("cloud_nav");
		// //区间查询
		// $rows1=$hbase->limit(1000,1004)->select();
		// //条件查询(支持row、value、column)
		// $map['c']  = array('eq','admin');
		// $map["columns"]=array('eq','t1');
		// $rows2=$hbase->where($map)->select();
		// //指定列族+条件查询
		// $rows=$hbase->where(array("columns"=>'attr:nickname'))->select();
		// $hbase=new HbaseModel("cloud_user");
		// $rows=$hbase->row("123")->cols("vldt")->find();
		// $rows = $hbase->select();
		// $nav = array();
		// $row = array();
		// for ($i= 0;$i< count($rows); $i++){
		// 	// dump($rows[$i]);
		// 	$row = $rows[$i];
		// 	// dump($row["row"]);
		// 	if(!$row->columns["parent:"])
		// 	 dump($row);
		// 	// if(!$value["parent:"])	
		// 	// 	echo $value["row"];
		// };
		// dump($rows);

		//向指定行添加列(可指定cols列族名,默认使用第一个)
		// $data=array(
		// 	"pwd"=>"3333"
		// );
		// $res=$hbase->row("admin3")->cols("vldt")->add($data);
		// dump($res);
	}

	//添加  (可联合cols方法使用)
	public function  add(){
		$hbase=new HbaseModel("User");
		//向指定行添加列(可指定cols列族名,默认使用第一个)
		$data=array(
			"age"=>"20",
			"name"=>"ceiba"
		);
		$res=$hbase->row(1009)->add($data);
		dump($res);
	}

	//更新   (可联合cols方法使用)
	// public function  save(){
	// 	$hbase=new HbaseModel("User");
	// 	//向指定行添加列(可指定cols列族名,默认使用第一个)
	// 	$data=array(
	// 		"age"=>"25",
	// 		"name"=>"ceibas"
	// 	);
	// 	$res=$hbase->row(1009)->save($data);
	// 	dump($res);
	// }
	
	//查找指定的行
	public function  find(){
		$hbase=new HbaseModel("cloud_user");
		$rows=$hbase->where(array("row"=>'admin'))->find();
		dump($rows);
	}

	//删除(可联合cols方法使用)
	// public function  del(){
	// 	$hbase=new HbaseModel("User");
	// 	//删除指定行的所有元素
	// 	$rows=$hbase->where(array("row"=>1008))->delete();
	// 	$rows=$hbase->where(array("row"=>1009,"column"=>"age"))->delete();
	// }
}