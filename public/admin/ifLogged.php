<?php
include_once '../bootstrap.php';

if (!isset($_SESSION['logged'])){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');
}
?>
