<?php

abstract class A{
	public abstract function foo();//抽象方法，不用去实现
	public function bar(){
		$this->foo();
	}
//	private abstract function baz();//抽象方法不能私有   Abstract function A::baz() cannot be declared private
}

class B extends A{
	public function foo(){
		echo "这是抽象A的B实现",PHP_EOL;
	}
}

class C extends A{
	public function foo($a=""){
		echo "这是抽象A的C实现",PHP_EOL;
		echo $a;
	}
}

$b = new B;
$c = new C;

$b->bar();
$c->bar();
$c->foo('hello');
