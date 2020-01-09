<?php
/**
	可变变量
*/

class foo{
	var $bar = 'I am bar';
	var $arr = ['I am a','I am b','I am c'];
	var $r = ['I am r'];
}

$foo = new foo;
$bar = 'bar';
$baz = ['foo','bar','arr'];

echo $foo->bar.PHP_EOL;//普通访问
echo $foo->$bar.PHP_EOL;//变量 $bar
echo $foo->{$baz[1]}.PHP_EOL;//数组变量

$arr = 'arr';
echo $foo->{$arr[1]}.PHP_EOL;//输出 I am r
echo $foo->{$arr}[1].PHP_EOL;//输出 I am b
echo $arr[1];


const HAHA = "HELLO";

echo HAHA;
