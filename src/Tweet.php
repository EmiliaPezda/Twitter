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
        $this->userId = $userId;
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
            $loadedTweet->text = $row['tekst'];
            $loadedTweet->creationDate = $row['creationDate'];
            return $loadedTweet;
        } else {
            return null;
        }
    }

    static public function loadAllTweetsByUserId(PDO $conn, $userId)
    {
        $stmt = $conn->prepare('SELECT * FROM Tweet WHERE userId=:userId');
        $result = $stmt->execute(['userId'=> $userId]);
        #tablica, do której  zostaną załadowane obiekty
        $ret = [];

        if ($result === true && $stmt->rowCount() > 0)
        {
            foreach ($stmt as $row)
            {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['tekst'];
                $loadedTweet->creationDate = $row['creationDate'];
                $ret[] = $loadedTweet;
            }
        }
            return $ret;
    }

    static public function loadAllTweets(PDO $conn)
    {
        $sql = "SELECT * FROM Tweet ORDER BY creationDate DESC";

        #tablica, do której  zostaną załadowane obiekty
        $ret = [];
        $result = $conn->query($sql);

        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {

                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['tekst'];
                $loadedTweet->creationDate = $row['creationDate'];

                $ret[] = $loadedTweet;

            }
        }
            return $ret;
    }

    public function saveToDB(PDO $conn) //nie dziala bo id cały czas zwraca 0
    {
        if ($this->id == -1) {
            // przygotowanie zapytania
            $sql = "INSERT INTO Tweet(userId, tekst, creationDate) VALUES (:userId, :tekst, :creationDate)";
            $prepare = $conn->prepare($sql);

            // Wysłanie zapytania do bazy z kluczami i wartościami do podmienienia
            $result = $prepare->execute(
                [
                    'userId'     => $this->userId,
                    'tekst'        => $this->text,
                    'creationDate' => $this->creationDate,
                ]
            );

            // Pobranie ostatniego ID dodanego rekordu
            $this->id = $conn->lastInsertId();
            return (bool)$result;
        } else {
            $stmt = $conn->prepare(
            'UPDATE Tweet SET userId=:userId, text=:text, creationDate=:creationDate WHERE id=:id'
            );
            $result = $stmt->execute(
            [ 'userId'=> $this->userId,'tekst' => $this->text, 'creationDate' => $this->creationDate,'id'=> $this->id]
            );

            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return $this->id;
            }
        return false;
        }
    }

}








 ?>
