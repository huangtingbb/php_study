<?php
$dsn='mysql:dbname=ljstu;host=127.0.0.1';
$user='root';
$pwd='123456';
$conn=new \PDO($dsn,$user,$pwd);

$time = time()+1;
echo "5s的插入行数";
$sql = "insert into test2 values";
while($time > time()){
	$sql.="(null,'".uniqid() ."'),";
}
$sql = substr($sql,0,-1);
$sql.=";";
$res = $conn->exec($sql);
echo $res;exit;
