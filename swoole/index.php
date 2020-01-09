<?php
	
	$http = new swoole_http_server('0.0.0.0',8888);

	$http->on('request',function($request,$response){
		$server = $request->server;
		echo "[{$server['remote_addr']}] ---- [".date('Y-m-d H:i:s')."]  {$server['request_method']}   {$server['request_uri']}".PHP_EOL;	
		$html = "<h1>HELLO SWOOLE</h1>";
		$response->end($html);
	});

	@$http->start();


