<?php

global $a,$b;

$a = 1;
$b = 2;

function test($pid){
	global $a,$b;
	echo $a,$b;
	file_put_contents($pid,$a.$b);
}

$pid = pcntl_fork();
if($pid == -1){
	die("子进程启动失败");
}else if($pid){
	test($pid);
}else{
	test(0);
}
