<?php

//服务端
class Server{
	private $serv;

	public function __construct(){
		$this->serv = new swoole_server("0.0.0.0",9501,SWOOLE_SOCK_TCP);
		$this->serv->set([
			'worker_num'=>8,
			'daemonize'=>false,
			'open_tcp_keepalive' => 1,//进行心跳检测
			'tcp_keepidle' => 3 ,// 3秒没有数据传输就进行检测
			'tcp_keep_interval' => 1 , //1秒探测一次
			'tcp_keppcount' => 5, //'探测的次数，超过5次还没回包就断掉该链接
			'heartbeat_idle_time' => 5,
			'heartbeat_check_interval' => 3,
		
		]);
		$this->serv->on('Start',[$this,'onStart']);
		$this->serv->on('Connect',[$this,'onConnect']);
		$this->serv->on('Receive',[$this,'onReceive']);
		$this->serv->on('Close',[$this,'onClose']);
		$this->serv->on('workStart',[$this,'onWorkStart']);
		$this->serv->start();

	}

	public function onStart($serv){
		echo "Start\n";
	}

	public function onWorkStart($serv){
		echo "work start\n";
	}

	public function onConnect($serv,$fd,$from_id){
		$serv->send($fd,"hello,$fd,进来了说说话呗");
	}

	public function onReceive($serv,$fd,$from_id,$data){
		echo "get message from client {$fd},{$data}\n";
		$serv->send($fd,$data);

	}

	public function onClose($serv,$fd,$from_id){
		echo "client {$fd} close connection \n";
	}

}

@$server = new Server();

