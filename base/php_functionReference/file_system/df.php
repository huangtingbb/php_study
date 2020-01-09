<?php

//返磁盘目录的可用空间 diskfree
	$df = disk_free_space('/');

	//echo $df/1024/1024/1024,'G';
	echo rendSize($df),"\n";
	
	function rendSize($size){
		$i = 0;
		$iec = ['B','KB','MB','GB','TB'];
		while($size/1024>1){
			$size = $size/1024;
			$i++;
		}
		return round($size,2).$iec[$i];
	}

