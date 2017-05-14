<?php
include_once '../bootstrap.php';
include_once 'ifLogged.php';

if($_SESSION['logged'] == null){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');
}

//username data
$user = User::showUserByEmail($connection,  $_SESSION['email']);
$username = $user->getUsername();
$userId = $user->getId();
echo "<h3> Messages of user $username </h3>";

#received messages button
echo '<form  action = "" method="GET">
<input type="submit" name="receivedMessages" value="See received messages">
</from>' . "<br>" . "<br>";

#sent messages button
echo '<form  action = "" method="GET">
<input type="submit" name="sentMessages" value="See sent messages">
</from>'. "<br>". "<br>";

if($_SERVER['REQUEST_METHOD'] == "GET" && isset ($_GET['receivedMessages'])){
    $messagesSent = Message::loadMessageByReceiverId($connection,$userId);

    echo "<strong> Received messages: </strong><br>";
    #display all messages
    foreach($messagesSent as $oneMessage) {
        $sender = User::loadUserById($connection, $oneMessage -> getSenderId());
        $text = $oneMessage -> getMessage();
        $messageId = $oneMessage->getId();
        echo '<table border="solid black" width="50%"> '
            . '<tr> <td width="30%">'
            . '<br> Sender: ' .'</td>'
             . '<td>' . $sender->getUsername()
            . ' </td> </tr>';
        echo '<tr> <td width="30%">'
        . '<br> Message sent on: ' . '</td>'
         . '<td>' . $oneMessage -> getCreationDate()
        . ' </td> </tr>';
        echo '<tr> <td width="30%">'
        . '<br> Message: ' . '</td>'
        . '<td>';
        if(strlen($text) > 30 && $oneMessage->getIsRead() == 0){
            echo '<strong>' . substr($text, 0, 30) . "... </strong>";
        } elseif(strlen($text) > 30 && $oneMessage->getIsRead() == 1) {
            echo substr($text, 0, 30) . "...";
        } elseif($text <= 30  && $oneMessage->getIsRead() == 0){
            echo "<strong> $text </strong>";
        } else {
            echo $text;
        }
        echo "<a href='seeMessage.php?messageId=$messageId'> See message</a>";
        echo ' </td> </tr>';
        echo '</table>';
    }

}

if($_SERVER['REQUEST_METHOD'] == "GET" && isset ($_GET['sentMessages'])){
    $messagesSent = Message::loadMessageBySenderId($connection,$userId);

    echo "<strong> Sent messages: </strong><br>";
    #display all messages
    foreach($messagesSent as $oneMessage) {
        $sender = User::loadUserById($connection, $oneMessage -> getReceiverId());
        $text = $oneMessage -> getMessage();
        $messageId = $oneMessage->getId();
        echo '<table border="solid black" width="50%"> '
            . '<tr> <td width="30%">'
            . '<br> Receiver: ' .'</td>'
             . '<td>' . $sender->getUsername()
            . ' </td> </tr>';
        echo '<tr> <td width="30%">'
        . '<br> Message sent on: ' . '</td>'
         . '<td>' . $oneMessage -> getCreationDate()
        . ' </td> </tr>';
        echo '<tr> <td width="30%">'
        . '<br> Message: ' . '</td>'
        . '<td>';
        if(strlen($text) > 30 && $oneMessage->getIsRead() == 0){
            echo '<strong>' . substr($text, 0, 30) . "... </strong>";
        } elseif(strlen($text) > 30 && $oneMessage->getIsRead() == 1) {
            echo substr($text, 0, 30) . "...";
        } elseif($text <= 30  && $oneMessage->getIsRead() == 0){
            echo "<strong> $text </strong>";
        } else {
            echo $text;
        }
        echo "<a href='seeMessage.php?messageId=$messageId'> See message</a>";
        echo ' </td> </tr>';
        echo '</table>';
    }

}

echo "<a href='mainPage.php'> Go back to the main page </a>";
