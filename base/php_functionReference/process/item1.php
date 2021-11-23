<?php
	$a = range('A','Z');;
	$b = range(1,26);
	//var_dump($a);
	//var_dump($b);
	
	$pid = pcntl_fork();
	
	echo getmypid(),"\n";
	if($pid == -1 ){
		die("创建子进程失败");
	}else if($pid){
		//pcntl_wait($status);
		$pd = getmypid();
		foreach($a as $char){
			posix_kill($pd,SIGSTOP);
			echo $char;
			posix_kill($pd,SIGNCONT);
		}
	}else{
		echo getmypid(),"\n";
		foreach($b as $num){
			echo $num;
			posix_kill(posix_getpid(),SIGSTOP);
		}
	}
