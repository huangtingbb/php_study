<?php

echo "主进程\n";

$pid = pcntl_fork();
//父进程和子进程都会执行这些代码
if($pid == -1 ){
	//创建子进程失败会返回-1
	throw new Exception ('fork error on Task object');
}else if($pid){
	//创建成功会父进程会得到子进程的pid
	sleep(5);
	echo "这是执行主进程\n";
	pcntl_wait($pid);//等待子进程中断
}else{
	//创建成功子进程会得到pid=0
	sleep(2);
	echo "这是执行子进程\n";
}
