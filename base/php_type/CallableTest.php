<?php

/**
回调函数实例
*/

//example function
function my_callback_function(){
	echo "hello my_Callback_Function 1\n";
}

class MyClass{

	//example method
	public static function my_callback_method(){
		echo "hello my_callback_function 2\n";
	}
}

call_user_func(function(){
	echo "my function 3 \n";
});

//type1 :simple callback
call_user_func('my_callback_function');

//type2 : static class method callback
call_user_func(['MyClass','my_callback_method']);

//type3 : obejct method call
$object = new MyClass;
call_user_func([$object,'my_callback_method']);
call_user_func('MyClass::my_callback_method',$object);

Class A{
	public static function who(){
		echo "A".PHP_EOL;
	}
}

class B extends A{
	public static function who(){
		echo "B".PHP_EOL;
	}
}


