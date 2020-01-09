<?php
//匿名函数
class Cart{
	const PRICE_BUTTER = 1.00;
	const PRICE_MILK = 3.00;
	const PRICE_EGGS = 6.00;

	protected $products = [];

	public function add($product , $quantity){
		$this->products[$product] = $quantity;
	}

	public function getQuantity($product){
		return isset($this->products[$product]) ? $this->products[$product] : false ;
	}

	public function getTotal($tax){
		$total = 0.00;
		$callback = function($quantity,$product) use ($tax , &$total){
			$price_per_item = constant(__CLASS__."::PRICE_".strtoupper($product));
			$total += $price_per_item * $quantity * ($tax + 1.0);
		};
		array_walk($this->products,$callback);//array_walk 的回调函数参数为value,key
		return round($total,2);
	}
}

$my_cart = new Cart;
$my_cart->add('butter',1);
$my_cart->add('eggs',3);
print $my_cart->getTotal(0.05).PHP_EOL;
