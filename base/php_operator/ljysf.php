<?php
	$a = 1;
	$b = 0;
	if($a || $b++) echo 1;//逻辑运算符，又叫短路运算符
	else echo 0;

	echo PHP_EOL;
	echo $b;
