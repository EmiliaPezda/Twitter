<?php
include_once '../bootstrap.php';

$_SESSION['logged'] = false;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['email'])
    && isset($_POST['password']))
    {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $user = User::showUserByEmail($connection, $email);
    if($user == true){
        if ($user->getHashPassword() == $password) {
            $_SESSION['logged'] = true;
            $_SESSION['email'] = $email;
            header('Location: mainPage.php'); //przekierowanie na stronę główną
        } else {
            $errors[] = 'Incorrect password';
        }
    } else {
        echo "No user with this email";
    }

}
?>
<!DOCTYPE>
<html>
<title>Log in</title>
<body>
<form method="post" action="">
    <?php echo join('<br>', $errors); ?>
    <h1>Log in</h1>
    <br>
    Email: <input type="email" name="email">
    <br>
    Password: <input name="password" type="password">
    <br>
    <button type="submit" name="submit">Log in</button>
    <br><br>
</form>
    <form action="register.php">
    <button type="submit" value="register"> Register new user</button>
    </form>

</body>
</html>
