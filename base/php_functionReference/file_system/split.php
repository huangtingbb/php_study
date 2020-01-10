<?php
/**
* 分割文件成指定大小
*/

if(count($argv) < 2){
	echo "无效的参数,please use it like it :\n";
	echo "$argv[0] filename filecount \n";
	exit();
}
$file_name = $argv[1];

$file_count = $argv[2];

$per_size = ceil(filesize($file_name)/$file_count);

$fp = fopen($file_name,"r");
$s_time = get_millisecond();
for($i = 0 ; $i<$file_count ; $i++){
	$content = fread($fp,$per_size);
	file_put_contents('./log_'.$i,$content);
}
$e_time = get_millisecond();
$time = $e_time - $s_time ;
echo "程序耗时{$time}毫秒";

function get_millisecond(){
	list($usec, $sec) = explode(" ", microtime());  
    $msec=round($usec*1000); 
	return $msec;  
}
