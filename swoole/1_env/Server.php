<?php

//服务端
class Server{
	private $serv;

	public function __construct(){
		$this->serv = new swoole_server("0.0.0.0",9501);
		$this->serv->set(['worker_num'=>8,'daemonize'=>false]);
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

