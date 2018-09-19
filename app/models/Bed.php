<?php

class Bed extends Model {

    public function getBedsByTypeRoom($idTypeRoom)
    {
        $data = [
            ':id_type_room' => $idTypeRoom
        ];

        $sql = "SELECT * FROM bed WHERE id_type_room = :id_type_room";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchall();

    }

    public function getBedTypes()
    {
        $sql = "SELECT type_bed.*, COUNT(bed.id_bed) AS count_bed FROM type_bed INNER JOIN bed ON type_bed.id_type_bed = bed.id_type_bed GROUP BY bed.id_type_bed";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }

    public function getAllBeds()
    {
        $sql = "SELECT * FROM bed";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }

    
    public function getCountBedByTypeByRoom($idTypeRoom, $idTypeBed)
    {

        $data = [
            ':id_type_room' => $idTypeRoom,
            ':id_type_bed' => $idTypeBed,
        ];

        $sql = "SELECT COUNT(id_bed) as count_bed FROM bed WHERE id_type_room = :id_type_room AND id_type_bed = :id_type_bed";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetch()[0];
    }


}



?>