<?php
class cache {
    //链接memcached类
    private $serviceList = array();
    private $service ;

    public function __construct() {
        $this->service = new Memcached();
       
    }
    
    public function connect($host, $port) {
        $this->serviceList = $this->service->getServerList();
        
        if(is_array($this->serviceList)) {
            foreach ($this->serviceList as $v) {
                if($v['host'] == $host && $v['port'] == $port) {
                    var_dump($this->serviceList);
                    return true;
                    
                }
                
            }
        } 
        //没有这个服务，链接
        $this->service->addServer($host, $port);
        
        return $this;
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
    public function calculate($host, $port) {
        $statusList = $this->service->getStats();
        $status = $statusList[$host.':'.$port];
        if(!$status['cmd_get']) {
            return 0;
        }
        return $status['get_misses']/$status['cmd_get'];
    }
    public function get($key) {
        $value = $this->service->get($key);
        return $value;
    }
}