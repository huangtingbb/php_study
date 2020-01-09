<?php
//引用遍历

$a = [1,2,3,4];

foreach($a as &$v){};
var_dump($a);
var_dump($v);
foreach($a as $v){};//第一次循环完毕后$a[3]指向了$v,再第二次遍历中复制给$v,实际上每次都改变了$a[3]的值，别用引用完后最好unset掉
var_dump($a);
