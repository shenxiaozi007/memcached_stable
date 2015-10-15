<?php
/**
*取模算法 决定加入哪一个服务器
*/

class takeMode {
	
	public $_node = array();//节点
	
	public $_config = array();//配置
	//初始化
	public function __construct($config) {
		$this->_config = $config;
	}
	
	//生成一个key
	public function getKey($name) {
		$key = crc32($name);
		return $key;
	}
	//计算放入那个服务器
	public function setServer($name) {
		if(empty($name)) {
			return false;
		}
		//取模，求余
		$server = $this->getKey($name)%count($this->_config);
		return $server;
	}
}
