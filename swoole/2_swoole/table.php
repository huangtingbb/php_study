<?php
//table 内存表

//创建一个1000行的内存表对象
$table = new swoole_table(1024);

//添加列
$table->column('id',swoole_table::TYPE_INT,4);
$table->column('name',swoole_table::TYPE_STRING,64);
$table->column('num',swoole_table::TYPE_FLOAT);

//创建表
$table->create();
//不推荐用数组方式访问table,最好使用table的方法
$table['apple'] = ['id'=>145,'name'=>'iphone','num'=>3.1415];
$table['geogle'] = ['id'=>123,'name'=>'AlphaGo','num'=>3.1415];
$table['microsoft']['name'] = "windows";
$table['microsoft']['num'] = "1997.03";
var_dump($table['apple']);
var_dump($table['microsoft']);

$table['geogle']['num']=500.90;

$table->set('aiqiyi',['id'=>111,'name'=>'aiqiyi','num'=>2569]);

var_dump($table->get('aiqiyi'));

var_dump($table['geogle']);


