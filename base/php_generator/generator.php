<?php
	
//使用生成器generator模拟range
function xrange($start,$limit,$step){
	if($start < $limit){
		if($step <= 0){
			throw new LogicException('step must +ve');
		}

		for($i = $start; $i<= $limit ; $i+=$step){
			yield $i;
		}
	}else{
		if($step >= 0){
			throw new LogicException('step must -ve');
		}

		for($i = $start; $i >= $limit; $i+=$step){
			yield $i;
		}
	}
	
}

$a = xrange(1,10000000,1);//1000W的数字，占用内存大概300K
echo memory_get_usage();
//foreach($a as $vo){
//	echo $vo;
//}
echo  memory_get_usage();
