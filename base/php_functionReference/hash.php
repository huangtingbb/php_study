<?php
//hash加密

file_put_contents('hash.txt','test jiami');

$pwd = hash_hmac_file('md5','hash.txt','secret');


$pwd2 = hash_hmac('md5','test jiami','secret');

var_dump($pwd == $pwd2);
echo "===========================\n";
//加密3
$pwd3 = hash_init('md5');
hash_update($pwd3,'test');
hash_update($pwd3,' jiami');
$pwd3 = hash_final($pwd3);

var_dump($pwd3 == $pwd3);
