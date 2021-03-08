<?php
echo "<pre>";
var_dump($_SERVER['REQUEST_METHOD']);
echo "\n";
var_dump($_POST);
echo "\n";
var_dump(file_get_contents("php://input"));
