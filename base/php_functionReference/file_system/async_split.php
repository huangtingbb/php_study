<?php
/**
* 异步操作
* 分割文件成指定个数
*
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
//计算时间
$s_time = get_millisecond();
for($i = 0 ; $i<$file_count ; $i++){
	//echo "主线程继续fork$i\n";
	$pid = pcntl_fork();
	if($pid == -1 ){
		exit("fork 子进程失败\n");
	}else if($pid){
		//exit("退出主进程，让子进程执行分割操作");
		pcntl_wait($status);
		//echo "$pid 进程完成任务\n";
		//exit;
	}else{
		//echo $i,"\n";
		//echo "子线程执行任务\n";
		//锁定文件
		//while(!flock($fp,LOCK_EX)){//锁没起作用
		//	echo "{$i}抢锁失败\n";
		//};
		rewind($fp);
		fseek($fp,$per_size*$i,0);
		//echo "文件指针位置".ftell($fp)."\n";
		$content = fread($fp,$per_size);
		//flock($fp,LOCK_UN);
		file_put_contents('./log_async'.$i,$content);
		exit();
	}
}
$e_time = get_millisecond();

$time = $e_time - $s_time ;
echo "程序耗时{$time}毫秒";

function get_millisecond(){
	list($usec, $sec) = explode(" ", microtime());  
    $msec=round($usec*1000); 
	return $msec;  
}  
