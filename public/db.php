<?php


require_once("/opt/lampp/htdocs/workspace/StudentBook/app/models/User.php");
$user = new \App\User();
var_dump($user);


$director = new Role();
$director->name = 'director';
