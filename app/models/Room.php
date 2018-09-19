<?php

class Room extends Model {

    public function getRooms(){

        $sql = "SELECT room.id_room, room.num, type_room.type_name, type_room.price,  type_room.capacity,  type_room.kitchen 
                FROM room 
                LEFT JOIN type_room ON room.id_type_room = type_room.id_type_room
                ORDER BY room.id_room";
        
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }

    public function getTypesOfRoom() {

        $sql = "SELECT * FROM type_room";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchall();

        return $results;
    }

    public function getRoomCountByType() {

        $sql = "SELECT type_room.*, COUNT(room.id_type_room) AS Room_count 
                FROM room 
                INNER JOIN type_room ON type_room.id_type_room = room.id_type_room 
                GROUP BY room.id_type_room";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }

    public function getRoomsByType($idTypeRoom) {

        $data = [
            ':id_type_room' => $idTypeRoom,
        ];

        $sql = "SELECT room.id_room, room.num, room.add_info, type_room.type_name FROM room INNER JOIN type_room ON type_room.id_type_room = room.id_type_room WHERE room.id_type_room = :id_type_room";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchall();
    }

    public function getInfoType($idTypeRoom) {
        
        $data = [
            ':id_type_room' => $idTypeRoom,
        ];

        $sql = "SELECT * FROM type_room WHERE id_type_room = :id_type_room";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetch();
    }

    public function getRangeCapacity($idTypeRoom){

        $data = [
            ':id_type_room' => $idTypeRoom,
        ];

        $sql = "SELECT min, max FROM rang_people_room WHERE id_type_room = :id_type_room";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetch();

    }


}



?>