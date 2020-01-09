<?php
	//测试new static 和 new self 的区别
	//static 指向当前调用的类
	//self 指向this
class A{
	public static function get_Self(){
		return new self();
	}

	public static function get_static(){
		return new static();
	}

	private function foo(){
		echo "A",PHP_EOL;
	}

	public function bar(){
		$this->foo();
		static::foo();//在非静态环境下，所调用的类，即为该对象实例所属的类
	}
}

class B extends A{

}

class C extends A{
	public static  function get_self(){
		return new self();
	}

	private function foo(){
		echo 'C',PHP_EOL;
	}
}
//在静态环境调用static 和self

echo get_class(A::get_self()),PHP_EOL;//输出A
echo get_class(B::get_self()),PHP_EOL;//输出A
echo get_class(C::get_self()),PHP_EOL;//输出C

echo "=======================".PHP_EOL;

echo get_class(A::get_static()),PHP_EOL;//输出A
echo get_class(B::get_static()),PHP_EOL;//输出B
echo get_class(C::get_static()),PHP_EOL;//输出c

echo "=======================".PHP_EOL;
//在实例里面调用static
$b = new B;
$c = new C;

$b->bar();
$c->bar();
