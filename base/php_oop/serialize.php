<?php
class A implements Serializable{
	private $data;

	public function __construct(){
		$this->data = "my private data";
	}

	public function serialize(){
		return serialize($this->data);
	}

	public function unserialize($data){
		$this->data = unserialize($data);
	}

	public function getData(){
		return $this->data;
	}
}


$a = new A;
$ser_a = serialize($a);
var_dump($ser_a);
$new_a = unserialize($ser_a);
var_dump($new_a);
var_dump($new_a->getData());
