<?php
//trait是为PHP的单继承语言而准备的一种代码复用机制。
//trait和class组合的语义定义了一种减少复杂性的方式
//有点类似组合

//优先级 this>trait>parent
echo "优先级测试:";
class A{
	public function foo(){
		echo "this parent A";
	}
}

trait B{
	public function foo(){
		echo "this trait B";
	}
}

class C extends A{
	use B;
	public function foo(){
		echo "this self C";
	}
}

$c = new C;
$c->foo();

echo PHP_EOL,"======================",PHP_EOL;
echo "冲突解决 :",PHP_EOL;

trait D{
	public function foo(){
		echo "this trait D foo";
	}

	public function bar(){
		echo "this trait D bar";
	}
}

trait E{
	public function foo(){
		echo "this trait E foo";
	}

	public function bar(){
		echo "this trait E bar";
	}

}

trait E2{
	public function bar(){
		echo "this trait E2 bar";
	}
}

class F{
//	use D,E;//直接这样会报错 Trait method foo has not been applied, because there are collisions with other trait methods
	use D,E,E2{
		D::foo insteadof E;
		E::bar insteadof D,E2;//排除insteadof后面的trait
	}
}

$f = new F;
$f->foo();echo PHP_EOL;
$f->bar();echo PHP_EOL;
