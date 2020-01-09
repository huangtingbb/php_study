<?php
//对象遍历
class A{
	public $foo = 1;
	public $bar = 2;
	protected $pro  = 3;
	private $pri = 4;
	public $baz;

	public function bar(){
		echo 123;
	}
}

$a = new A;
echo "便利a对象：",PHP_EOL;
foreach($a as $key=>$value){//对类遍历，只会便利类的可访问属性
	echo "key= ".$key.", value= ".$value,PHP_EOL;
}

//另外可以实现Iterator接口，可以让对象自行决定如何便利以及每次遍历时哪些值可用
class B implements Iterator{
	private $var = [];

	public function __construct($array){
		if(is_array($array)){
			$this->var = $array;
		}
	}

	public function rewind(){
		echo "rewinding ",PHP_EOL;
	}

	public function current(){
		$var = current($this->var);
		echo "current $var",PHP_EOL;
		return $var;
	}

	public function key(){
		$var = key($this->var);
		echo "key : $var",PHP_EOL;
		return $var;
	}

	public function next(){
		$var = next($this->var);
		echo "next : $var",PHP_EOL;
		return $var;
	}

	public function valid(){
		$var = $this->current() !== false ;
		echo "valid : {$var}",PHP_EOL;
		return $var;
	}
}

$b = new B([1,2,3]);
echo "测试自定义遍历：",PHP_EOL;
foreach($b as $k=>$v){
	echo "key= {$k}, value={$v}",PHP_EOL;
}

//使用IteratorAggregate 接口以替代实现所有Iterator方法。IteratorAggregate 的getIterator()返回一个实现了Iterator接口的类的实例
class C implements IteratorAggregate{
	private $items =[];
	private $count = 0;

	public function getIterator(){
		return new B($this->items);
	}

	public function add($value){
		$this->items[$this->count++] = $value;
	}
}

$c = new C;
echO "======================================================",PHP_EOL;
echo "测试IteratorAggregate接口: ",PHP_EOL;

$c->add(1);
$c->add(2);
$c->add(3);

foreach($c as $k=>$v){
	echo "key = {$k} ,value = {$v}",PHP_EOL;
}
