<?php

$fp = fopen('./log',"a+");
$i = 0;
while($i++ <= 12848800){
	$num = rand(1,12848800);
	fwrite($fp,"$num\n");
}
fclose($fp);
