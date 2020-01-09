<?php

class Daemon {

	const LISTEN = "tcp://127.0.0.1:9501";
	const PID_FILE = __CLASS__;
	const UID = 80;
	const GID = 80;
	const SLEEP = 5;
	
	protected $pool = null;
	protected $config = [];
	
	public function __construct($uid,$gid,$class){
		$this->pidfile = "/var/run/".basename(strtolower(get_class($class)),'.php').".pid";
		$this->uid = $uid;
		$this->gid = $gid;
		$this->class = $class;
		$this->classname = get_class($class);
		$this->signal();
	}

	public function signal(){
		pcntl_signal(SIGHUP,function($signo){
			printf("The process has been reload.\n");
			Signal::set($signo);	
		});
	}

	private function daemon(){
		if(file_exists($this->pidfile)){
			echo "The file {$this->pidfile} exists.\n";
			exit();
		}

		$pid = pcntl_fork();
		if($pid == -1){
			die('could not fork');
		}else if($pid){
			exit($pid);//结束主进程
		}else{
			file_put_contents($this->pidfile,getmypid());
			posix_setuid(self::UID);
			posix_setgid(self::GID);
			return getmypid();
		}
	}

	private function run(){
		while(true){
			printf("The process begin.\n");
			$this->class->run();
			printf("The process end.\n");
		}
	}

	private function foreground(){
		$this->run();
	}

	private function start(){
		$pid = $this->daemon();
		while(1){
			$this->run();
			sleep(self::SLEEP);
		}
	}

	private function stop(){
		if(file_exists($this->pidfile)){
			$pid = file_get_contents($this->pidfile);
			posix_kill($pid,9);
			unlink($this->pidfile);
		}
	}

	private function reload(){
		if(file_exists($this->pidfile)){
			$pid = file_get_contents($this->pidfile);
			posix_kill($pid,SIGHUP);
		}
	}

	private function status(){
		if(file_exists($this->pidfile)){
			$pid = file_get_contents($this->pidfile);
			system(sprintf("ps ax | grep %s | grep -v grep",$pid));
		}
	}

	private function help($proc){
		printf("%s start | stop | restart | status | foreground | help\n",$proc);
	}

	public function main($argv){
		if(count($argv)<2){
			$this->help($argv[0]);
			printf("please input help parameter \n");
			exit;
		}

		$opt = $argv[1];
		$this->$opt();
	}

	public function __call($method,$argvs){
		echo "unknow option $method \n";
		exit;
	}

}
