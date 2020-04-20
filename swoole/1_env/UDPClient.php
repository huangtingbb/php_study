<?php
	$cli = new Swoole\Client(SWOOLE_SOCK_UDP);
	$cli->sendto('127.0.0.1',9502,"hello");
