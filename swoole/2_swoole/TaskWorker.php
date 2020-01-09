<?php

//服务端
class Server{
	private $serv;

	public function __construct(){
		$this->serv = new swoole_server("0.0.0.0",9501);
		$this->serv->set(['worker_num'=>4,'task_worker_num'=>4,'daemonize'=>false]);
		$this->serv->on('Start',[$this,'onStart']);
		$this->serv->on('Connect',[$this,'onConnect']);
		$this->serv->on('Receive',[$this,'onReceive']);
		$this->serv->on('Close',[$this,'onClose']);
		$this->serv->on('Task',[$this,'onTask']);
		$this->serv->on('Finish',[$this,'onFinish']);
		$this->serv->start();
	}

	public function onStart($serv){
		echo "Start\n";
	}

	public function onConnect($serv,$fd,$from_id){
		$serv->send($fd,"hello,$fd,进来了说说话呗");
	}

	public function onReceive($serv,$fd,$from_id,$data){
		echo "get message from client {$fd},{$data}\n";
		$param = [
			'fd' => $fd,
			'data' => $data
		];
		//start a task
		$serv->task(json_encode($param));
		echo "任务交给task_woker进程处理\n";
		$serv->send($fd,'已交给Task Wroker处理任务,请等待\n');

	}

	public function onClose($serv,$fd,$from_id){
		echo "client {$fd} close connection \n";
	}

	public function onTask($serv,$task_id,$from_id,$data){
		echo "get data from woker {$from_id}\n";
		sleep(5);
		$fd = json_decode($data,true)['fd'];
		$data = [
			'msg' => "Data is in {$task_id} : 任务处理完成\n",
			'fd' =>$fd
		];
		return json_encode($data);
	}

	public function onFinish($serv,$task_id,$data){
		//回调逻辑
		echo "task {$task_id} finished \n";
		$data =json_decode($data,true);
		echo "deal result data\n";
		$serv->send($data['fd'],$data['msg']);
	}

}

@$server = new Server();

