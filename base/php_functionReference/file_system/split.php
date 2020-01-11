<?php
/**
* 分割文件成指定个数
*/
ini_set('memory_limit',"256M");
if(count($argv) < 2){
	echo "无效的参数,please use it like it :\t";
	echo "$argv[0] filename filecount \n";
	exit();
}
$file_name = $argv[1];

$file_count = $argv[2];

$per_size = ceil(filesize($file_name)/$file_count);

$per_size = $per_size + (8-$per_size%8);
//var_dump($per_size);exit();
$fp = fopen($file_name,"r");
$s_time = get_millisecond();
for($i = 0 ; $i<$file_count ; $i++){
	$content = fread($fp,$per_size);//读取待排序文件指定大小
	$content = explode("\n",$content);
	echo "用了".memory_get_peak_usage()."内存\n";
	//unset($content);//释放内存
	sort($content,SORT_NUMERIC);//给数组排序，按照数字来
	$content = implode("\n",$content);//变成字符串
	file_put_contents('./log_'.$i,$content);//存入分块文件中
	unset($content);
}
$e_time = get_millisecond();
$time = $e_time - $s_time ;
echo "程序耗时{$time}毫秒";

function get_millisecond(){
	list($usec, $sec) = explode(" ", microtime());  
    return (float)sprintf('%.0f', (floatval($usec) + floatval($sec)) * 1000);
}
