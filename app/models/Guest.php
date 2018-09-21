<?php

class Guest extends Model {


    public function addGuestGiveId($guest)
    {
        $data = [
            ':firstname'    => $guest['firstName'],
            ':lastname'     => $guest['lastName'],
            ':email'        => $guest['email'],
            ':phone'        => $guest['phone'],
        ];

        $sql = "INSERT INTO guest (firstname, lastname, email, phone) VALUES (:firstname, :lastname, :email, :phone);";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return $pdo->lastInsertId();
    }

    public function getAllGuest()
    {
        $sql = "SELECT id_guest FROM guest";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
     
        return $stmt->fetchall();
    }
}



?>