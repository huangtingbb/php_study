<?php

echo "主进程\n";

$pid = pcntl_fork();
//父进程和子进程都会执行这些代码
if($pid == -1 ){
	//创建子进程失败会返回-1
	throw new Exception ('fork error on Task object');
}else if($pid){
	//创建成功会父进程会得到子进程的pid
	echo "等待子进程执行";
	pcntl_wait($status);//等待子进程中断
	echo "子进程执行状态：\n";
	echo "是否正常退出：",pcntl_wifexited($status),"\n";
	echo "子进程返回的代码：",pcntl_wexitstatus($status),"\n";//仅在pcntl_wifexited返回true时生效,只能是int
	echo "导致子进程退出的信号：",pcntl_wstopsig($status),"\n";
	echo "导致子进程中断的信号：",pcntl_wtermsig($status),"\n";
	echo "子进程是否是由于某个未捕获的信号退出的：",pcntl_wifsignaled($status),"\n";
	var_dump($status);

}else{
	//创建成功子进程会得到pid=0
	//对于不能被阻塞、处理和忽略的信号，php会产生一个致命错误SIGSTOP,SIGKILL
	sleep(10);
	echo "子进程执行完毕\n";
	exit(123);
}
