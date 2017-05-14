<?php

include_once '../bootstrap.php';
include_once 'ifLogged.php';

if($_SESSION['logged'] == null){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');

}

if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (isset($_GET['TweetId'])) {
        $tweet = Tweet::loadTweetById($connection, $_GET['TweetId']);
        $user = $tweet->getUserId();
        $author = User::loadUserById($connection, $user);
        $authorName = $author->getUsername();


        echo "<strong> Text: </strong>" . $tweet->getText() . "<br>";
        echo "<strong> Author: </strong>" . $authorName . "<br>";

    }
}


 echo "<br><h4>Comments</h4>";

$comments = Comment::loadAllCommentsByPostId($connection, $_GET['TweetId']);
foreach($comments as $oneComment) {
    $userName = User::loadUserById($connection,($oneComment -> getUserId()) ) -> getUsername();
    $userId = $oneComment -> getUserId();
    $commentId = ($oneComment -> getId());
    $commentDate = $oneComment->getCreationDate();
    echo '<table> '
        . '<tr> <td>'
        . '<br>User <a href = "user.php?id=' . $oneComment -> getUserId()
        . '">' . $userName . '</a>' . ' commented on ' . $commentDate . ':</a>'
        . ' </td> </tr>';
    echo '<tr> <td height="100%" width="500px">' .  $oneComment -> getText()
        . '</td> </tr>';
        echo '</table>';
}


echo "<br><br>Create comment";
echo '<form action ="" method="POST">
<input type="text" name="comment" placeholder="Enter your comment">
<input type="submit" value="add comment">
</from>';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST['comment'])){
    $addComment = new Comment();
    $user = User::showUserByEmail($connection, $_SESSION['email']);
    $userId = $user->getId();
    $addComment->setUserId($userId);
    $addComment->setPostId($_GET['TweetId']);
    $addComment->setText($_POST['comment']);
    $addComment->setCreationDate(date('Y-m-d H:i:s'));
    $addComment->saveToDB($connection);
    echo "Comment has been added <br>";
    }
}
echo "<br><a href=mainPage.php> Go back to main page </a>";
