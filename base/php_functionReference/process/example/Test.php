<?php

class Test extends Logger{
	public static $signal = null ;

	public function __construct(){
		
	}

	public function run(){
		while(true){
			pcntl_signal_dispatch();
			//printf(".");
			parent::log(1,"进程 ".getmypid()." 收到信号 ".Signal::get());
			sleep(1);
			if(Signal::get() == SIGHUP){
				Signal::reset();
				break;
			}
			printf("\n");
		}
	}
}
