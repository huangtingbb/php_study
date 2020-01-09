<?php

function inverse($x){
	if(!$x){
		throw new Exception('0 不能做除数');
	}
	return 1/$x;
}

try{
	echo inverse(0).PHP_EOL;
}catch(Exception $e){
	echo "捕获异常：".$e->getMessage().PHP_EOL;
}finally{
	echo "第一个finally".PHP_EOL;
}

try{
	echo inverse(5);
}catch(Exception $e){
	echo "捕获异常：".$e->getMessage().PHP_EOL;
}finally{
	echo "第二个finally".PHP_EOL;
}

echo "执行完毕",PHP_EOL;
