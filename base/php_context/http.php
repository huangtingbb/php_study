<?php
	//使用stream_context_create 模拟post请求
	function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	$data = http_build_query([
		'lng' => '',
		'lat' => '',
		'order' => 1,
	]);

	$opts = [
		'https' => [
			'method' => 'post',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'data' => $data,
		]
		
	];

	$context = stream_context_create($opts);

	$time_start = microtime_float();
	
$result = file_get_contents('https://vvv.trc-demo.com/api/room/index',false,$context);
//	$result = file_get_contents('http://php_study.ljstu.top/base/php_context/server.php',false,$context);

	$end_time = microtime_float();

	$time = $end_time - $time_start;
	echo $result,"\n";

	echo "请求所耗时间{$time}";
