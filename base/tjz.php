<?php
	$data = http_build_query([
		'lng' => '114.4058720',
		'lat'=> '30.498943',
		'order' => 1
	]);

	$opts = [
		'http'=>[
			'method' => 'get',
			'header' => 'Content-type:application/x-www-form-urlencoded',
			'content' => $data,
		]
	];

	$context = stream_context_create($opts);

	$result = file_get_contents('https://vvv.trc-demo.com/api/room/index',false,$context);

	echo $result;
