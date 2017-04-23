<?php
include_once '../bootstrap.php';



$user = new User();
$user->setEmail('tt@tt.pl');
$user->setUsername('test');
$user->setHashPassword('password');

$result = $user->save($connection);
echo "Mamy usera <br>";

$result1 = User::loadUserById($connection, 1);
var_dump($result1);
$result2 = User::loadUserById($connection, 2);
var_dump($result2);

$showAll = User::loadAllUsers($connection);
echo "<pre>";
print_r($showAll);
