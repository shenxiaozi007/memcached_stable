<?php
ini_set('display_errors',1);            //错误信息
error_reporting(-1);                    //打印出所有的 错误信息
include_once("config.php");
include_once("takeMode.php");
include_once("memcacheClass.php");
include_once("hashMode.php");
$takeObj = new takeMode($config);
$memcached = new memcacheClass();
//循环获取数据
$key = 'huangxingchun';
$i = $_GET['num'];
$data = $key.$i;

//放入哪个服务器
$serverNum = $takeObj->setServer($data);

//获取key
$setKet = $takeObj->getKey($data);

//链接
$obj = $memcached->connect($takeObj->_config[$serverNum]['host'],$takeObj->_config[$serverNum]['port']);
//获取值
$value = $memcached->get($setKet);
//$bykey = $memcached->getServerBykey($setKet);
if(!$value) {
    //为空保存value
    $memcached->add($key, $data);
}
//获取缓存率
$rs = $memcached->calculate($takeObj->_config[$serverNum]['host'],$takeObj->_config[$serverNum]['port']);
usleep(3000);
echo json_encode(array('calculate'=>$rs,'num'=>$i,'value'=>$value,'rs'=>$data,'server'=>$serverNum,'key'=>$setKet));
