<?php
/**
* php进程的优先级
*/

for($i = 1;$i<=5;$i++){
	$pid = pcntl_fork();
	if($pid == -1){
		throw new Exception("fork error on task object");
	}else if ($pid){
		pcntl_wait($status);
	}else{
		$end_time = time()+3;
		$k = 0;
		while(time()<=$end_time){
			$k++;
		}
		$pid = getmypid();
		echo "当前进程id:".$pid,"优先级:",pcntl_getpriority($pid);
		pcntl_setpriority($i);
		echo "修改之后的优先级为：",pcntl_getpriority(),"\n";
		echo "执行了进程{$i} {$k}次\r\n";
		exit();
	}
}
