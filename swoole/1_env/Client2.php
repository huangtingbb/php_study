<?php
	$cli = new Swoole\Client(SWOOLE_SOCK_TCP | SWOOLE_KEEP);
	//$cli->set();
	if(!$cli->connect('127.0.0.1',9501,-1)){
		exit("connect failed. Error:{$cli->errCode}\n");
	}
	echo "connect ok \n";
	$cli->send("hello world-".str_repeat('A',7)."\n");
	echo $cli->recv()."\n";
