<?php
	
	//error_reporting(0);//关闭错误报告
	//set_error_handler('dealerror');//自定义错误处理


	function dealerror($type,$message,$file,$line){
		var_dump('<b>set_error_handler: ' . $type . ':' . $message . ' in ' . $file . ' on ' . $line . ' line .</b><br />');
		throw new \Exception($message);
	}
	try{
		$a=0;
		10%$a;//这会产生一个错误，error 不能被catch(Execption $e)捕获，能被catch(Error $e)
	}catch(Error $e){
		echo 123;
	}
	echo 10;
