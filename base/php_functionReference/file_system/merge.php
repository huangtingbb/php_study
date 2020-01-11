<?php
/**
* 多路归并排序
*/

ini_set('memory_limit', '3M');

$file = "./log_";
//$file = "./log_async";

$res = [];

$compare = [];

for($i = 0 ; $i<=9 ; $i++){
	$var = $file.$i;
	$$var = fopen($var,'r');
	$compare[$i] = (int)preg_replace("/\s/","",fgets($$var));
	if(!$compare[$i]) $compare[$i] = (int) trim(fgets($$var));
}
//var_dump($compare);exit;
$fw = fopen('./sortlog','w');
while($compare = array_filter($compare)){
	//找到最小值
	$min = min($compare);
	//写入sortlog
	fwrite($fw,$min."\n");
	//找到最小值属于哪一路
	$i = array_keys($compare,$min)[0];
	//补充比较数组的数据
	$var = $file.$i;
	//var_dump($var);
	$compare[$i] = trim(fgets($$var));
	if($compare[$i] == false) fclose($$var);
}
