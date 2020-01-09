<?php

/**
* 对象克隆
*/
class A{
	public $a = 1;
	public $b;
	
	public function __construct(B $b){
		$this->b = $b;
	}

	public function __clone(){
		$this->b = clone $this->b;
	}
}

class B{
	public $b = 2;
}

$a = new A(new B);

$a2 = $a;
$a3 = clone $a;//将调用对象的__clone()方法，对对象的属性执行浅复制，所有的引用属性，仍然是一个指向原来变量的引用

if($a === $a3) echo '$a 和 $a3 全等',PHP_EOL;
if($a == $a3)echo '$a 和 $a3 相同',PHP_EOL;//因为克隆相当深复制，所以不满足全等
$a2->a = 2;

echo $a->a,PHP_EOL;//输出2
echo $a3->a,PHP_EOL;//输出1

echo "测试属性引用：",PHP_EOL;

$a->b->b = 3;
echo $a2->b->b,PHP_EOL;
echo $a3->b->b,PHP_EOL;//如果没有__clone方法，会输出3，添加clone方法后会输出2


echo "对象比较: ",PHP_EOL ;

if($a === $a2) echo '$a 和 $a2 全等',PHP_EOL;
if($a == $a2) echo '$a 和 $a2 相同',PHP_EOL;

