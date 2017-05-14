<?php

class Comment
{
    private $id;
    private $userId;
    private $postId;
    private $creationDate;
    private $text;

    public function __construct()
    {
        $this->id = -1;
        $this->userId = 0;
        $this->postId = 0;
        $this->text = 0;
        $this->creationDate = 0;
    }

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

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
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

    static public function loadCommentById(PDO $conn, $id)
    {
        $stmt = $conn->prepare('SELECT * FROM Comment WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['userId'];
            $loadedComment->postId = $row['postId'];
            $loadedComment->text = $row['text'];
            $loadedComment->creationDate = $row['creation_date'];
            return $loadedComment;

        } else {
            return null;
        }
    }

    static public function loadAllCommentsByPostId(PDO $conn, $postId)
    {
        $stmt = $conn->prepare('SELECT * FROM Comment WHERE postId=:postId ORDER BY creation_date DESC');
        $result = $stmt->execute(['postId'=> $postId]);
        #tablica, do której  zostaną załadowane obiekty
        $ret = [];

        if ($result === true && $stmt->rowCount() > 0)
        {
            foreach ($stmt as $row)
            {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->postId = $row['postId'];
                $loadedComment->text = $row['text'];
                $loadedComment->creationDate = $row['creation_date'];
                $ret[] = $loadedComment;
            }
        }
            return $ret;
    }

    public function saveToDB(PDO $conn)
    {
        if ($this->id == -1) {
            // przygotowanie zapytania
            $sql = "INSERT INTO Comment (userId, postId, creation_date, text) VALUES (:userId, :postId, :creation_date, :text)";
            $prepare = $conn->prepare($sql);

            // Wysłanie zapytania do bazy z kluczami i wartościami do podmienienia
            $result = $prepare->execute(
                [
                    'userId'     => $this->userId,
                    'postId'     => $this->postId,
                    'creation_date' => $this->creationDate,
                    'text'        => $this->text,
                ]
            );

            // Pobranie ostatniego ID dodanego rekordu
            $this->id = $conn->lastInsertId();
            return (bool)$result;

        } else {
            $stmt = $conn->prepare(
            'UPDATE Comment SET userId=:userId, postId=:postId, creation_date=:creation_date,text=:text WHERE id=:id'
            );
            $result = $stmt->execute(
            ['id'=> $this->id, 'userId'=> $this->userId, 'postId'=> $this->postId, 'creation_date' => $this->creation_date, 'text' => $this->text,]
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
