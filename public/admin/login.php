<?php
include_once '../bootstrap.php';


$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['email'])
    && isset($_POST['password']))
    {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $user = User::showUserByEmail($connection, $email);
    if ($user) {
        if ($user->getHashPass() == $password) {
            $_SESSION['logged'] = true;
        } else {
            $errors[] = 'Hasło niepoprawne';
        }
    } else {
        $errors[] = 'Brak takiego użytkownika';
    }
} else {

}
?>

<html>
<body>
<form method="post">
    <?php echo join('<br>', $errors); ?>
    <br>
    Email: <input type="email" name="email">
    <br>
    Haslo: <input name="password" type="password">
    <br>
    <button type="submit" name="submit">Loguj</button>
</form>
</body>
</html>
