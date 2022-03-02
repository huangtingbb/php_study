<?php

/**
 * 对象和引用
 * php的引用是别名，就是2个不同的变量名指向相同的内容。
 * 在PHP5中，一个对象变量已经不再保存整个对象的值，只是保存一个标志符来访问真正的对象内容。
 * 当对象作为参数传递，作为结果返回，或者赋值给另外一个变量，另外一个变量跟原来的不是引用关系，
 * 只是他们都保存着同一个标志符的拷贝，这个标志符指向同一个对象的真正内容
 */

class Obj {
    public $a = 123;
}

$obj_1 = new Obj();
$obj_2 = $obj_1; //obj1和obj2是同一个标志符的拷贝  $obj1=$obj2=<id>
$obj_2->a = 24;
var_dump($obj_1);
var_dump($obj_2);
echo $obj_1->a,"\n";

$obj_3 = new Obj();
$obj_4 = &$obj_3; //obj3和obj4是引用  ($obj3,$obj4)=<id>
$obj_4->a = 24;
var_dump($obj_3);
var_dump($obj_4);
echo $obj_3->a,"\n";

$obj_5 = new Obj();
function foo($obj){
    $obj->a = 24; //$obj = $obj_5 = <id>
}
foo($obj_5);
echo $obj_5->a;
