<?php
ini_set('display_errors',1);            //错误信息
#ini_set('display_startup_errors',1);    //php启动错误信息
error_reporting(-1);                    //打印出所有的 错误信息

include_once("config.php");
include_once("takeMode.php");
$key = 'huangxingchun';
$takeObj = new takeMode($config);
//实例化memcached
/* $memcached = new Memcached();
$i = 0;
//循环插入 1万条
do {
    //数据
    $data = $key.$i;
    
    //放入哪个服务器
    $serverNum = $takeObj->setServer($data);
   
    //链接
    $res = $memcached->addServer($takeObj->_config[$serverNum]['host'],$takeObj->_config[$serverNum]['port']);
    
    //保存
    $set = $memcached->add($i, $data);
    var_dump($res,$set);
    $i++;
    usleep(3000);
    
}while($i < 100);
 */

var_dump($takeObj->_config);
var_dump($takeObj->setServer("huangxingchun1"));
var_dump($takeObj->setServer("huangxingchun2"));
var_dump($takeObj->setServer("huangxingchun3"));
var_dump($takeObj->setServer("huangxingchun4"));
//var_dump($config);


