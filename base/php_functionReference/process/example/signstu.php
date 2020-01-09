<?php
function myautoload($class){
	if(is_file("./$class.php") && file_exists("./$class.php")){
		require_once("./$class.php");
	}else{
		exit("file not exists $class.php");
	}
}

spl_autoload_register('myautoload');

$daemon = new Daemon(80,80,new Test());
$daemon->main($argv);
