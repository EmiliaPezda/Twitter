<?php
include_once '../bootstrap.php';
include_once 'ifLogged.php';

if($_SESSION['logged'] == null){
    die('You are not logged in <br>
    <a href="login.php"> Log in</a>');

}

if($_SERVER['REQUEST_METHOD'] === "GET"){
        $showedUserId = $_GET['id'];
        $showedUser = User::loadUserById($connection,$showedUserId);
        $userLogged = User::showUserByEmail($connection, $_SESSION['email']);
        $loggedUserId = $userLogged->getId();
    if (isset($_GET['id']))
    {
        $tweets = Tweet::loadAllTweetsByUserId($connection, $showedUserId);

        $username = $showedUser->getUsername();
        echo "<h3>All tweets of user  $username </h3>";
        if($showedUserId !== $loggedUserId)
        {
        echo '<form action="sendMessage.php" method="GET">';
        echo "<input type='submit' name='sendMessage' value='send message to $username'>";
        echo "</form>". "<br>";
        }
        foreach($tweets as $oneTweet)
        {
            echo '<table> '
                . '<tr> <td>' . '"' . $oneTweet -> getText() . '"' . '<br>'
                . '</td> </tr>';
            echo '<tr> <td>' . 'Created on: ' . $oneTweet -> getCreationDate() . '</td> </tr>';
            $comments = Comment::loadAllCommentsByPostId($connection, $oneTweet->getId());
            if(count($comments) > 0)
            {            // licze ich ilosc w tablicy
                $commentAmount = count($comments);
            } else
            {
                $commentAmount = 0;
            }
            echo '<tr> <td>' . 'Comments: ' . $commentAmount .'</td> </tr>';
            echo '</table>';
            echo "<br>";
        }
    }
}


echo "<br><a href=mainPage.php> Go back to main page </a>";

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['sendMessage'])){
    echo "lolo";
    header("Location: sendMessage.php");
}


 ?>
