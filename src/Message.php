<?php

class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $isRead;
    private $message;
    private $creationDate;

    public function __construct()
    {
        $this->id = -1;
        $this->isRead = 0; //not read
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function getIsRead()
    {
        return $this->isRead;
    }

    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public static function loadMessageById(PDO $conn, $id){
        $stmt = $conn->prepare('SELECT * FROM Message WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->senderId = $row['senderId'];
            $loadedMessage->receiverId = $row['receiverId'];
            $loadedMessage->isRead = $row['isRead'];
            $loadedMessage->message = $row['message'];
            $loadedMessage->creationDate = $row['creationDate'];
            return $loadedMessage;
        } else {
            return null;
        }
    }

    public function saveToDB(PDO $pdo)
    {
        if ($this->id == -1) {
            // przygotowanie zapytania

            $sql = "INSERT INTO Message (senderId, receiverId, isRead, message, creationDate) VALUES (:senderId, :receiverId, :isRead, :message, :creationDate)";
            $prepare = $pdo->prepare($sql);

            // Wysłanie zapytania do bazy z kluczami i wartościami do podmienienia
            $result = $prepare->execute(
                [
                    'senderId'     => $this->senderId,
                    'receiverId'   => $this->receiverId,
                    'isRead'       => $this->isRead,
                    'message'      => $this->message,
                    'creationDate' => $this->creationDate,
                ]
            );

            // Pobranie ostatniego ID dodanego rekordu
            $this->id = $pdo->lastInsertId();
            return (bool)$result;
        } else {
            $stmt = $pdo->prepare(
                'UPDATE Message SET senderId=:senderId, receiverId=:receiverId, isRead=:isRead, message=:message, creationDate=:creationDate WHERE id=:id'
            );
            $result = $stmt->execute(
                [ 'senderId'=> $this->senderId,'receiverId'=> $this->receiverId, 'isRead'=> $this->isRead, 'message'=> $this->message, 'creationDate'=>$this->creationDate, 'id'=> $this->id]
            );
            if ($result === true) {
                return true;
            }
        }
        return false;
    }


    public static function loadMessageBySenderId(PDO $conn, $senderId){
        $stmt = $conn->prepare('SELECT * FROM Message WHERE senderId=:senderId');
        $result = $stmt->execute(['senderId'=> $senderId]);
        $ret = [];

        if ($result === true && $stmt->rowCount() > 0)
        {
            foreach ($stmt as $row)
            {
                $loadedSentMessages = new Message();
                $loadedSentMessages->id = $row['id'];
                $loadedSentMessages->senderId = $row['senderId'];
                $loadedSentMessages->receiverId = $row['receiverId'];
                $loadedSentMessages->isRead = $row['isRead'];
                $loadedSentMessages->message = $row['message'];
                $loadedSentMessages->creationDate = $row['creationDate'];
                $ret[] = $loadedSentMessages;
            }
        }
            return $ret;
    }


    public static function loadMessageByReceiverId(PDO $conn, $receiverId){
        $stmt = $conn->prepare('SELECT * FROM Message WHERE receiverId=:receiverId');
        $result = $stmt->execute(['receiverId'=> $receiverId]);
        $ret = [];


        if ($result === true && $stmt->rowCount() > 0)
        {
            foreach ($stmt as $row)
            {
                $loadedSentMessages = new Message();
                $loadedSentMessages->id = $row['id'];
                $loadedSentMessages->senderId = $row['senderId'];
                $loadedSentMessages->receiverId = $row['receiverId'];
                $loadedSentMessages->isRead = $row['isRead'];
                $loadedSentMessages->message = $row['message'];
                $loadedSentMessages->creationDate = $row['creationDate'];
                $ret[] = $loadedSentMessages;
            }
        }
            return $ret;
    }


    public function delete(PDO $conn)
    {
        if ($this->id != -1) {
            $stmt = $conn->prepare('DELETE FROM Message WHERE id=:id');
            $result = $stmt->execute(['id'=> $this->id]);
                if ($result === true) {
                    $this->id = -1;
                    return true;
                }
                return false;
        }
        return true;
    }

}



 ?>
