<?php
include_once 'ifLogged.php';

echo "Logged as: " . $_SESSION['email'];
echo "| <a href=\"myuser.php\">See your profile</a>";
echo "|<a href='messages.php'> Messages</a>";
echo "| <a href=\"logout.php\">Log out</a>";
?>

<form action="" method="POST">
    <br><br>Create tweet:<br>
    <input type="text" name="tweet">
    <input type="submit" value="create">
</form>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet'])){
    $user = User::showUserByEmail($connection, $_SESSION['email']);
    $newTweet = new Tweet();
    $userId = $user->getId();
    $newTweet->setUserId($userId);
    $newTweet->setText($_POST['tweet']);
    $newTweet->setCreationDate(date('Y-m-d H:i:s'));
    $newTweet->saveToDB($connection);
}

$tweets = Tweet::loadAllTweets($connection);
foreach($tweets as $oneTweet) {
    $userName = User::loadUserById($connection,($oneTweet -> getUserId()) ) -> getUsername();
    $tweetId = ($oneTweet -> getId());
    echo '<table> '
        . '<tr> <td>'
        . '<br>User <a href = "user.php?id=' . $oneTweet -> getUserId()
        . '">' . $userName . '</a>' . ' twitted: </a>'
        . ' </td> </tr>';
    echo '<tr> <td height="100%" width="500px">' .  $oneTweet -> getText()
        . '<a href = "tweet.php?TweetId='. $tweetId
        . '">'. '<br> See more' . '</a>'
        . '</td> </tr>';
        echo '</table>';
}







?>
