<?php
//php属性中的变量可以初始化，但是初始化必须是常数（指再编译阶段就可以得到的值）

class A{
	public $a = 1;
	public $b = 2*2;
	public $d = 2+2;
	private	const F="123";
	//public $c = new PDO(); //会报错  Constant expression contains invalid operations

	public function __toString(){
		return  '$a='.$this->a.PHP_EOL.'$b='.$this->b.PHP_EOL.'$c='.$this->d.PHP_EOL;
	}

	public function getv(){
		return self::F;
	}
}

class B extends A{
	
}

$A = new A;

echo $A->getv();
echo $A;
$b = new B;
//echo B::F;
