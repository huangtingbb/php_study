<?php

echo "主进程\n";

$pid = pcntl_fork();
//父进程和子进程都会执行这些代码
if($pid == -1 ){
	//创建子进程失败会返回-1
	throw new Exception ('fork error on Task object');
}else if($pid){
	//创建成功会父进程会得到子进程的pid
	//pcntl_wait($pid);//等待子进程中断
	while(true){
		sleep(1);
		echo date('Y-m-d H:i:s')."\t这是执行主进程\n";
	}
}else{
	//创建成功子进程会得到pid=0
	//对于不能被阻塞、处理和忽略的信号，php会产生一个致命错误SIGSTOP,SIGKILL
	pcntl_signal(SIGINT,function(){
		echo "收到SIGINT信号,进程退出\n";
		exit();
	});
	pcntl_signal_dispatch();
	while(true){
		sleep(1);
		echo date('Y-m-d H:i:s')."\t这是执行子进程\n";
	}
}
