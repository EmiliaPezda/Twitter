<?php
include_once '../bootstrap.php';

//rejestracja użytkownika i dodanie do bazy danych
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && !empty($_POST['username'])
    && !empty($_POST['emailReg'])
    && !empty($_POST['passwordReg']))
    {

    $emails = "Select email FROM Users";
    $result = $connection->query($emails);

    $newUser = new User();
    $userName = trim($_POST['username']);
    $email = trim($_POST['emailReg']);
    $password = $_POST['passwordReg'];

    $newUser->setUsername($userName);
    $newUser->setEmail($email);
    $newUser->setHashPassword($password);

    $newUser->saveToDB($connection);

    //sprawdzenie czy email już istnieje w bazie
    if($connection->lastInsertId() == 0){
        echo "Email already exists in database <br>";

    } else {
        echo "User $userName has been registered";
        echo "<h4> <a href='login.php'> Log in</h4></a>";

    }

}

?>


<!DOCTYPE>
<html>
<body>
<div float="right" margin-right=" 100px">
    <h3>Registration</h3>
    <form method="post" action="" name="signup">
        <label>Username</label>
        <input type="text" name="username" autocomplete="off" />
        <br>
        <label>Email</label>
        <input type="email" name="emailReg" autocomplete="off" />
        <br>
        <label>Password</label>
        <input type="password" name="passwordReg" autocomplete="off"/>
        <br>
        <input type="submit" class="button" name="signupSubmit" value="Signup">
    </form>
    </div>

</body>
</html?
