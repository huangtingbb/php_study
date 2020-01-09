<?php
//访问控制
class A{
	public $public = 'public';
	protected $protected = 'protected';
	private $private = 'private';//private 不能被继承

	function printA(){
		echo $this->public,PHP_EOL;
		echo $this->protected,PHP_EOL;
		echo $this->private,PHP_EOL;
	}
}

class B extends A{
	public $public = 'public B';
	protected $protected = 'protected B';
}

$a = new A;
echo $a->public;
//echo $a->protected;//保护属性，在外面访问会报错
//echo $a->private;//私有属性，在外面访问会报错
$a->printA();

echo "================================",PHP_EOL;

$b = new B;
echo $b->public;
echo $b->private;//会报错，没有该属性
$b->printA();

//访问同一个类对象的私有成员
class C{
	private $c;
	protected $c2;

	public function __construct($c){
		$this->c = $c;
		$this->c2 = $c;
	}

	private function foo(){
		echo "access private method".PHP_EOL;
	}

	public function baz(C $c){
		$c->c = "可以访问同一个类的不同实例的私有变量".PHP_EOL;
		echo $c->c;
		echo $c->c2;
		$c->foo();
	}
}

$c = new C('hello');
$c->baz(new C('other'));

