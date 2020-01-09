<?php
//定时任务,证明是异步
//$handle = fopen('./ds.log','w+');
//fwrite($handle,'定时开始'.PHP_EOL);
//	fwrite($handle,date('Y-m-d H:i:s').PHP_EOL);
@$timer_id = swoole_timer_tick(2000,function($timer_id){
	echo "定时任务".$timer_id.": tick-2000ms\n";
});

@swoole_timer_after(3000,function(){
	echo "after 3000ms\n";
});

$ten = time()+10;
//while(time()<$ten){
//	sleep(1);
//	echo date('Y-m-d H:i:s'),"\n";
//}//定时10秒

//释放定时

//@swoole_timer_clear($timer_id);
//fclose($handle);
