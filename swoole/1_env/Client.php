<?php

class Client{
	private $client;

	public function __construct(){
		$this->client = new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);//加了异步之后要写回调，不然报错
		$this->client->on('connect',[$this,'onConnect']);
		$this->client->on('receive',[$this,'onReceive']);
		$this->client->on('error',[$this,'onError']);
		$this->client->on('close',[$this,'onClose']);
	}

	public function connect(){
		if(!$this->client->connect("127.0.0.1",9501,1)){
			echo "Error :{$this->client->errMsg}[{$this->client->errCode}]\n";
		}
		echo "连接成功\n";
		swoole_timer_tick(1000,function(){
			$this->client->send('heart');	
		});
		//$this->heart();//心跳
	//客户端异步之后就不能再同步发消息
	//	fwrite(STDOUT,"请输入消息(please input msg):");
	//	$msg = trim(fgets(STDIN));
	//	$this->client->send($msg);

	//	$message = $this->client->recv();
	//	echo "get message from Server:{$message}\n";
	}

	public function onConnect($cli){
		$cli->send("hello server ,I'm connect".PHP_EOL);
	}

	public function onReceive($cli,$data){
		echo "receive message from server:".$data.PHP_EOL;
		//fwrite(STDOUT,"回复:");
		echo "回复:";
		$msg = trim(fgets(STDIN));
		$cli->send($msg);
	}

	public function onError($cli){
		echo "Connect faild".PHP_EOL;
	}

	public function onClose($cli){
		echo "client connect close".PHP_EOL;
	}

	public function heart(){
		swoole_timer_tick(1000,function(){
			var_dump(1);
			$this->client->send('heart');
		});
	}

}

$client = new Client();
$client->connect();
