<?php  
  
ini_set('display_errors', E_ALL);  
$GLOBALS['THRIFT_ROOT'] = '.';  
  
require_once( $GLOBALS['THRIFT_ROOT'] . '/Thrift.php' );  
require_once( $GLOBALS['THRIFT_ROOT'] . '/transport/TSocket.php' );  
require_once( $GLOBALS['THRIFT_ROOT'] . '/transport/TBufferedTransport.php' );  
require_once( $GLOBALS['THRIFT_ROOT'] . '/protocol/TBinaryProtocol.php' );  
require_once( $GLOBALS['THRIFT_ROOT'] . '/packages/Hbase/Hbase.php' );  
  
$socket = new TSocket('0.0.0.0', '9090');  
  
$socket->setSendTimeout(10000); // Ten seconds (too long for production, but this is just a demo ;)  
$socket->setRecvTimeout(20000); // Twenty seconds  
$transport = new TBufferedTransport($socket);  
$protocol = new TBinaryProtocol($transport);  
$client = new HbaseClient($protocol);  
  
$transport->open();  
  
//获取表列表  
$tables = $client->getTableNames();  
sort($tables);  
foreach ($tables as $name) {  
    echo( "  found: {$name}<br/>" );  
}  
   
//创建新表student  
// $columns = array(  
//     new ColumnDescriptor(array(  
//         'name' => 'id:',  
//         'maxVersions' => 10  
//     )),  
//     new ColumnDescriptor(array(  
//         'name' => 'name:'  
//     )),  
//     new ColumnDescriptor(array(  
//         'name' => 'score:'  
//     )),  
// );  
  
$tableName = "cloud_user";  
// try {  
//     $client->createTable($tableName, $columns);  
// } catch (AlreadyExists $ae) {  
//     echo( "WARN: {$ae->message}<br />" );  
// }  
//获取表的描述  
  
$descriptors = $client->getColumnDescriptors($tableName);  
asort($descriptors);  
foreach ($descriptors as $col) {  
    echo( "  column: {$col->name}, maxVer: {$col->maxVersions}<br />" );  
}  
  
//修改表列的数据  
// $row = '2';  
// $valid = "foobar-\xE7\x94\x9F\xE3\x83\x93";  
// $mutations = array(  
//     new Mutation(array(  
//         'column' => 'score',  
//         'value' => $valid  
//     )),  
// );  
// $client->mutateRow($tableName, $row, $mutations);  
  
  
//获取表列的数据  
$row_name = 'admin';  
$fam_col_name = 'vldt';  
$arr = $client->get($tableName, $row_name, $fam_col_name);  
// $arr = array  
foreach ($arr as $k => $v) {  
// $k = TCell  
    echo ("value = {$v->value} , <br>  ");  
    echo ("timestamp = {$v->timestamp}  <br/>");  
}  
  
// $arr = $client->getRow($tableName, $row_name);  
// // $client->getRow return a array  
// foreach ($arr as $k => $TRowResult) {  
// // $k = 0 ; non-use  
// // $TRowResult = TRowResult  
//     var_dump($TRowResult);  
// }  
  
$transport->close();  
?>  