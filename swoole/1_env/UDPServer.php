<?php

//服务端
class Server{
	private $serv;

	public function __construct(){
		$this->serv = new swoole_server("0.0.0.0",9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);
		$this->serv->set(['worker_num'=>8,'daemonize'=>false]);
		$this->serv->on('Packet',[$this,'onPacket']);
		$this->serv->start();
	}

	public function onPacket($serv,$data,$client_info){
		$serv->sendTo($client_info['address'],$client_info['port'],"SERVER RETURN :".$data);
		var_dump($client_info);
	}

	public function onClose($serv,$fd,$from_id){
		echo "client {$fd} close connection \n";
	}

}

@$server = new Server();

