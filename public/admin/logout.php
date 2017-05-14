<?php
include_once '../bootstrap.php';

$_SESSION['logged'] = false;

echo "You have been logged out <br>";

echo '<a href="login.php"> Log in again</a>';
