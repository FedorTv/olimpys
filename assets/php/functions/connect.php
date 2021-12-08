<?php 
// данных о базе данных
$info = 'mysql:dbname=olimpus;host=127.0.0.1:3307';
$user = 'root';
$password = '';
$connect = new PDO($info, $user, $password);
// расшифровка куки для дальнейшей работы с ними
$check = unserialize($_COOKIE['user'], ["allowed_classes" => false]);
 ?>