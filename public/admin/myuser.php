<?php
include_once '../bootstrap.php';
include_once 'ifLogged.php';

if($_SESSION['logged'] == null){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');
}

$myuser = User::showUserByEmail($connection, $_SESSION['email']);

echo "<h3>Email: " . $myuser->getEmail() . "</h3>";
echo "<h3>Username: " . $myuser->getUsername() ."</h3>";

?>
<!-- form to change username-->
<form action ="#" method="POST">
<input type="submit" name="username" value="Change username">
</from>
<br><br>

<!-- form to change password-->
<form  action = "" method="POST">
<input type="submit" name="password" value="Change password">
</from>
<br><br>

<!-- form to delete account-->
<form  action = "" method="POST">
<input type="submit" name="deleteAccount" value="Delete your account">
</from>
<br><br>



<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username'])){
    echo '<form action="" method="POST">';
    echo '<input type="text" name="usernameNew" placeholder="Enter new username">';
    echo '<input type="submit" value="Submit">';
    echo "</from>";
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['usernameNew'])){
    $username = trim($_POST['usernameNew']);
    $myuser->setUsername($username);
    $myuser->saveToDB($connection);
    echo "Username has been changed to $username";
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['password'])){
    echo '<form action="" method="POST">';
    echo '<input type="password" name="passwordOld" placeholder="Enter old password">' . "<br>";
    echo '<input type="password" name="passwordNew" placeholder="Enter new password">' . "<br>";
    echo '<input type="submit" value="Submit">';
    echo "</from>";
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['passwordOld']) && !empty($_POST['passwordNew'])){
    $password = $myuser->getHashPassword();
    $passwordNew = trim($_POST['passwordNew']);
    $oldPassword = trim($_POST['passwordOld']);
    if($password == $oldPassword){
        $myuser->setHashPassword($passwordNew);
        $myuser->saveToDB($connection);
        echo "Password has been changed";
    } else {
        echo "Incorrect password";
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['deleteAccount'])){
    echo '<form action="" method="POST">';
    echo "Are you sure that you want to delete your account?<br>";
    echo '<input type="submit" name="delete" value="Yes">  ';
    echo '<input type="submit" name="delete" value="No">';
    echo "</from>";
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['Yes'])){
    $myuser->delete($connection);
    echo "Username has been deleted";
} else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['No'])){

}

echo "<br>";
echo "<a href='mainPage.php'> Go back to the main page </a>";
