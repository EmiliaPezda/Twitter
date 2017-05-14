<?php
include_once '../bootstrap.php';
include_once 'ifLogged.php';

if($_SESSION['logged'] == null){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');
}

if($_SERVER['REQUEST_METHOD'] == "GET" && isset ($_GET['messageId']))
{
    $messageId = $_GET['messageId'];
    $message = Message::loadMessageById($connection, $messageId);
    $message->setIsRead(1);
    $message->saveToDB($connection);

    //get data about sender
    $senderId = $message->getSenderId();
    $sender = User::loadUserById($connection, $senderId);
    $senderName = $sender->getUsername();

    //get data about receiver
    $receiverId = $message->getReceiverId();
    $receiver = User::loadUserById($connection, $receiverId);
    $receiverName = $receiver->getUsername();

    echo "Sender:     " . $senderName . "<br>";
    echo "Receiver:    " . $receiverName . "<br><br>";
    echo "Message: <br>" . $message->getMessage() . "<br>";

}
echo "<br><a href='messages.php'> Go back to messages </a>";
echo "<br><a href='mainPage.php'> Go back to the main page </a>";
?>
