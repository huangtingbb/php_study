<?php
	//php 伪协议ftp
	$file = "ftp://lj:liujin123@@47.107.44.128/lj/a.txt";//没有连上
	$opts = [
		'ftp'=>[
			'overwrite'=>true
		]
	];

	$context = stream_context_create($opts);
	
	$a = file_get_contents($file,false,$context);
	echo $a;
