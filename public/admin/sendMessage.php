<?php
include_once '../bootstrap.php';
include_once 'ifLogged.php';

if($_SESSION['logged'] == null){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');

}


$text = explode(" ", $_GET['sendMessage']);
$receiver = $text[3];

echo "<h3> Send message to $receiver</h3><br>";
echo '<form action="#" method="POST">';
echo 'Message: <br>';
echo '<textarea name="message" cols="60" rows="20"></textarea><br>';
echo "<input type='submit' name='sendMessage' value='send message'>";
echo "</form>";


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['sendMessage'])){

    $user = User::showUserByEmail($connection, $_SESSION['email']);
    $userId = $user->getId();
    $receiverData = User::showUserByUsername($connection, $receiver);
    $receiverId = $receiverData->getId();

    $message = new Message();
    $message->setSenderId($userId);
    $message->setReceiverId($receiverId);
    $message->setIsRead(0);
    $message->setMessage($_POST['message']);
    $message->setCreationDate(date('Y-m-d H:i:s'));
    $message->saveToDB($connection);

    echo "Message has been sent!";
}

$message1 = new Message();
$message1->setSenderId(1);
$message1->setReceiverId(2);
$message1->setIsRead(0);
$message1->setMessage("elo");
$message1->saveToDB($connection);

echo "<br><a href='mainPage.php'> Go back to the main page </a>";
?>
