<?php

class Tweet
{
    private $id;
    private $userId;
    private $text;
    private $creationDate;

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->username = $userId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function __construct()
    {
        $this->id = -1;
        $this->userId = 0;
        $this->text = 0;
        $this->creationDate = 0;
    }

    public static function loadTweetById(PDO $conn, $id){
        $stmt = $conn->prepare('SELECT * FROM Tweet WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            #tworzymy nowego tweeta i wczytujemy dane
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            return $loadedTweet;
        } else {
            return null;
        }
    }
}








 ?>
