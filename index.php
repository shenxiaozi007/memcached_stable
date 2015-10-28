<?php
set_time_limit(0);
ini_set('display_errors',1);            //错误信息
#ini_set('display_startup_errors',1);    //php启动错误信息
error_reporting(E_ALL);                    //打印出所有的 错误信息

include_once("config.php");
include_once("takeMode.php");
include_once("memcacheClass.php");
include_once("hashMode.php");

$takeObj = new takeMode($config);//takeMode
//实例化memcached
$memcached = new memcacheClass();

//循环插入 1万条
for($i = 0; $i<10000;$i++) {
    //数据
    $value = 'huangxingchun'.$i;
    
    //放入哪个服务器
    $serverNum = $takeObj->setServer($value);
    
    $key = $takeObj->getKey($value);
    
    //链接
    $obj = $memcached->connect($takeObj->_config[$serverNum]['host'],$takeObj->_config[$serverNum]['port']);
	var_dump($serverNum, $key);
    //保存
    $set = $memcached->add($key, $value);
    //关闭
    $memcached->close();
    /* var_dump($obj); */
    usleep(3000);
}
    
    
    
 

var_dump($takeObj->_config);
var_dump($takeObj->setServer($takeObj->getKey("huangxingchun1")));
var_dump($takeObj->setServer($takeObj->getKey("huangxingchun2")));
var_dump($takeObj->setServer($takeObj->getKey("huangxingchun3")));
var_dump($takeObj->setServer($takeObj->getKey("huangxingchun4")));
//var_dump($config);


