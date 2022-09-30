<?php
/**
 * 单引号和双引号的效率
 */
$var = "";
for ($i = 1;$i++<5000000;){
    $var = 'a'.$i;
    $var = 'askdhaas'.$var;
//    echo 'ajklshdkasjd';
}
/**
 *  php base/php_variable/yh.php  0.25s user 0.08s system 91% cpu 0.357 total
 *  php base/php_variable/yh.php  0.24s user 0.04s system 99% cpu 0.279 total
 *
 *  php base/php_variable/yh.php  0.37s user 0.31s system 17% cpu 3.803 total
 *  php base/php_variable/yh.php  0.36s user 0.28s system 18% cpu 3.436 total
 */