<?php

/**
 * array_merge 丢弃原来的数字的key，而保留字符串形式的key，然后组成一个新的数组，如果字符串的key相同，后面的替换前面的
 * +只要是key一样那么就是前面的数组元素替换后面的
 */
$a1 = [1,'a'=>2,'2'=>3,4,5];
$a2 = [0=> 33,'a'=>'a','2'=>66];
$a3 = array_merge($a1,$a2);
$a31 = array_merge($a2,$a1);
$a4 = $a2+$a1;
$a5 = $a1+$a2;
var_dump($a3);
var_dump($a31);
//var_dump($a4);
//var_dump($a5);