<?php
//一致性hash算法
class hashMode {
    //节点
    private $_node = array();
    
    private $_virtualNum = 200;
    
    public $_config;
    public function __construct($_config) {
        $this->_config = $_config;
        //var_dump($this->_config);
        //虚拟节点. 形成环
        foreach ($this->_config as $k=>$v) {
            for ($i=0; $i<$this->_virtualNum; $i++) {
                //var_dump(sprintf("%u",crc32($this->_config[$k]['host'].':'.$this->_config[$k]['port'].'_'.$i)));
                $this->_node[sprintf("%u",crc32($this->_config[$k]['host'].':'.$this->_config[$k]['port'].'_'.$i))] = $k;
            }
           
        }
        //var_dump($this->_node);
        ksort($this->_node);
        //var_dump($this->_node);
        
    }
    
    //获取插入那个服务
    public function setServer($data) {
        $key = $this->getKey($data);
        
        //普通查找 ,成功后再用二分法。
        foreach ($this->_node as $k=>$v) {
            if($key > $k) {
                continue;
            }
            return $v;
        }
    }
    
    //获取插入的key
    public function getKey($data) {
        $key = crc32($data);
        return $key;
    }
    
    
}