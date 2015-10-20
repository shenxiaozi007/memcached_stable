<?php
abstract class memAbstract {
        //连接
        abstract function connect($host, $post);
        //添加值
        abstract function add($key, $data);
        //获取值
        abstract function get($key);
        //计算命中率
        abstract function calculate();

}

