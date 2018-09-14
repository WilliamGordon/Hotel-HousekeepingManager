<?php

class Guest extends Model {


    public function addGuestGiveId($firstName, $lastName, $email, $phone)
    {
        $data = [
            ':firstname' => $firstName,
            ':lastname' => $lastName,
            ':email' => $email,
            ':phone' => $phone,
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