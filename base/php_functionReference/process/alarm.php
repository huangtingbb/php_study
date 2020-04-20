<?php


echo "设置3秒之后发送闹钟信号\n";
pcntl_alarm(3);


function dealSigalarm(){
	echo "收到信号 SIGALRM \n退出程序。。。\n";
	exit();
}
echo "安装信号处理器\n";
pcntl_signal(SIGALRM,"dealSigalarm");
var_dump(pcntl_signal_get_handler(SIGALRM));//获取SIGALRM信号的处理函数
pcntl_signal(SIGUSR1,function(){
	echo "收到用户自定义信号\n";
});
posix_kill(getmypid(),SIGUSR1);
echo "分发... \n";

$i = 1;
while(1){
	sleep(1);
	echo $i++,"\n";
	var_dump(pcntl_signal_dispatch());
};
