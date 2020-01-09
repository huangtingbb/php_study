<?php

class WebSocket{
	private $socket;

	public function __construct(){
		$this->socket = new swoole_websocket_server('0.0.0.0',8000);
		$this->socket->on('message',[$this,'onMessage']);
		@$this->socket->start();
	}

	public function onMessage($serv,$frame){
		$receive_data = $frame->data;
		//$send_data = "hello 客户端";
		$serv->push($frame->fd,'来自服务器的消息:'.$receive_data,1,true);
	}
}

$webSocket = new WebSocket();

function foo(){
    //1.创建websocket服务器对象
	@$serv =  new swoole_websocket_server('0.0.0.0',8000);
	//2.当客户端给ws服务器发送消息时回应
    $serv->on('message',function(swoole_websocket_server $server, swoole_websocket_frame $frame){
    	//2.1获取客户端传过来的值做逻辑处理
    	$receive_data = $frame->data;
 		$send_data = (int)$receive_data+20;
    	//2.2把结果返回给客户端
		 $server->push($frame->fd, $send_data, 1, true);
    });
	//3.启动ws服务器
	@$serv->start();
}			
