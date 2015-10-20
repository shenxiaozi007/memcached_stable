<?php
include_once('memAbstract.php');
class memcacheClass extends memAbstract {
    //链接memcache类
    private $serviceList = array();
    private $service ;

    public function __construct() {
        $this->service = new memcache();
	
    }
    
    public function connect($host, $post) {
	$this->service->addServer($host, $post); 
	$this->service->pconnect($host, $post);
	return true;
    }
    /**
     * 添加值
     * @param  $key
     * @param unknown $data
     */
    public function add($key, $data) {
        $this->service->add($key, $data);
    }
    /**
     * 计算缓存命中率
     * @param unknown $host
     * @param unknown $post
     */
    public function calculate() {
        $status = $this->service->getStats();
        if(!$status['cmd_get']) {
            return 1;
        }
        return $status['get_hits']/$status['cmd_get'];
    }
    public function get($key) {
        $value = $this->service->get($key);
        
        return $value;
    }
}                                                                             
