<?php
/**
 * 反射
 */

class A{
    private function __function(){
        echo "私有构造函数";
    }

    public function say(){
        echo 123,"\n";
    }
}

$clazz = new ReflectionClass("A");
$pro = $clazz->getProperties();
$fun = $clazz->getMethods();
var_dump($pro);
var_dump($fun);
