<?php
	//glob:// — 查找匹配的文件路径模式
	$it = new DirectoryIterator("glob:///root/html/*.php");
	foreach ($it as $f){
		printf("%s : %.1Fb\n",$f->getFileName(),$f->getSize());
	}
