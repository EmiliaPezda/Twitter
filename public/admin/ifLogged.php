<?php
include_once '../bootstrap.php';

if($_SESSION['logged'] !== true){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');
}
?>
