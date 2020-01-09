<?php
	$a = true;
	$b = false;

	if($a | $b) echo 1;
	else echo 0;
	echo PHP_EOL;

	$c = 0;
	$d = 1;
	if($c & $d++) echo 1;
	else echo 0;
	echo PHP_EOL;
	echo $d;
	
	echo PHP_EOL;
	$f = 2;
	$e = $f <<2; //左移
	echo $e;
