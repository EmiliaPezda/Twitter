<?php

class User
{
    private $id;
    private $username;
    private $hashPassword;
    private $email;

    public function __construct()
    {
        $this->id = -1;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getHashPassword()
    {
        return $this->hashPassword;
    }

    public function setHashPassword($hashPassword)
    {
        $this->hashPassword = $hashPassword;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function save(PDO $pdo)
    {
        if ($this->id == -1) {
            // przygotowanie zapytania
            $sql = "INSERT INTO Users(username, email, hash_password) VALUES (:username, :email, :hashPassword)";

            $prepare = $pdo->prepare($sql);
            // Wysłanie zapytania do bazy z kluczami i wartościami do podmienienia
            $result = $prepare->execute(
                [
                    'username'     => $this->username,
                    'email'        => $this->email,
                    'hashPassword' => $this->hashPassword,
                ]
            );

            // Pobranie ostatniego ID dodanego rekordu
            $this->id = $pdo->lastInsertId();

            return (bool)$result;
        } else {
            return null;
        }
    }


    public static function loadUserById(PDO $conn, $id){
        $stmt = $conn->prepare('SELECT * FROM Users WHERE id=:id');
        $result = $stmt->execute(['id'=> $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            #tworzymy nowego użytkownika i wczytujemy dane
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashPassword = $row['hash_password'];
            return $loadedUser;
        } else {
            return null;
        }
    }


    static public function loadAllUsers(PDO $conn){
        $sql = "SELECT * FROM Users";

        #tablica, do której  zostaną załadowane obiekty
        $ret = [];
        $result = $conn->query($sql);

        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {

                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashPassword = $row['hash_password'];

                $ret[] = $loadedUser;

            }
        }
            return $ret;
    }

    static public function showUserByEmail(PDO $connection, $email)
    {
        $stmt = $connection->prepare('SELECT * FROM user WHERE email=:email');
        $result = $stmt->execute(['email'=> $email]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPassword = $row['hash_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }

        return null;
}



}






 ?>
