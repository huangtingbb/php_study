<?php
//重载，php所提供的重载是指动态的“创建”类属性和方法。我们是通过魔术方法（magic methods）来实现的

class A{
	public $public = 1;
	private $declared =0;
	private $private;
	public function __set($name,$value){//在类的外部给不可访问或不存在的变量赋值的时候调用
		echo "setting {$value} to {$name}",PHP_EOL;
		$this->$name = $value;
	}

	public function __get($name){
		echo "getting $name : ";
		return $this->$name;
	}
}


$a = new A;
$a->public = 2;
$a->private = 3;
$a->none = 4;
$a->declared = 3;
echo $a->declared,PHP_EOL;
