<?php

	$pid = getmypid();

	$child_pid = pcntl_fork();

	if($child_pid == -1){
		die("子进程创建失败");
	}else if($child_pid){
		echo "父进程pid：",$pid ,"\n";
		echo "子进程pid：",$child_pid;
	}else{
		$file_name = getmypid();
		$info = $pid == $file_name ? "等于" : "不等于";
		file_put_contents($file_name.".file",$info);

	}
