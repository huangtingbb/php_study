<?php
	function foo(&$bar){
		//$bar = &$GLOBALS['baz'];//不能通过引用机制将$var在函数调用范围内绑定到别的变量上，因为foo中并没有变量$var
		$GLOBALS['baz'] = $bar;
	}
	$var = 1;
	foo($var);

	echo $GLOBALS['baz'];
