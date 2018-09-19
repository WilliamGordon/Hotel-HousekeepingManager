<?php

class Booking extends Model {

    public function getNameCheckIn($idRoom, $checkIn)
    {
        $sql = "SELECT DISTINCT booking.id_booking, booking.id_guest FROM booking INNER JOIN room ON booking.id_room = $idRoom WHERE booking.check_in = '$checkIn'";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getNameCheckOut($idRoom, $checkOut)
    {
        $sql = "SELECT DISTINCT booking.id_booking, booking.id_guest FROM booking INNER JOIN room ON booking.id_room = $idRoom WHERE booking.check_out = '$checkOut'";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getNameCheckStays($idRoom, $date)
    {
        $sql = "SELECT DISTINCT booking.id_booking, booking.id_guest FROM booking INNER JOIN room ON booking.id_room = $idRoom WHERE booking.check_in < '$date' AND booking.check_out > '$date'";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getBookings($date){

        //DO NOT PASS THE DATE!!!!
        $data = [
            ':date' => $date,
        ];

        $sql = "SELECT booking.id_booking, guest.firstname, guest.lastname, booking.check_in, booking.check_out, booking.nb_night, booking.nb_person, booking.id_guest, booking.id_room, type_room.type_name 
                FROM booking 
                LEFT JOIN room ON room.id_room = booking.id_room
                LEFT JOIN type_room ON room.id_type_room = type_room.id_type_room
                LEFT JOIN guest ON guest.id_guest = booking.id_guest
                WHERE booking.check_in = '$date'
                ORDER BY guest.id_guest";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        
        return $stmt->fetchall();
    }

    public function getAvailability($typeOfRoom, $checkIn, $checkOut){

        $sql = "SELECT booking.* FROM `booking` 
                INNER JOIN room ON booking.id_room = room.id_room 
                INNER JOIN type_room ON room.id_type_room = type_room.id_type_room 
                WHERE booking.check_out >= '$checkIn' AND booking.check_in <= '$checkOut' AND type_room.id_type_room = '$typeOfRoom'
                ORDER BY booking.check_in ASC";
        
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();

    }

    public function addBooking($checkIn, $checkOut, $nbNight, $nbPerson, $idGuest, $idRoom) {

        $data = [
            ':nb_night' => $nbNight,
            ':nb_person' => $nbPerson,
            ':id_guest' => $idGuest,
            ':id_room' => $idRoom,
        ];

        $sql = "INSERT INTO booking (check_in, check_out, nb_night, nb_person, id_guest, id_room) 
                VALUES ('$checkIn', '$checkOut', :nb_night, :nb_person, :id_guest, :id_room);";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }

    public function getAllDepartures($date){
        
        $sql = "SELECT * FROM booking WHERE check_out = '$date'";

        $sql = "SELECT booking.*, room.num FROM booking 
        INNER JOIN room ON room.id_room = booking.id_room
        WHERE booking.check_out = '$date' ORDER BY ABS(room.num)";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }

    public function getAllArrivals($date){
        $sql = "SELECT booking.*, room.num FROM booking 
        INNER JOIN room ON room.id_room = booking.id_room
        WHERE booking.check_in = '$date' ORDER BY ABS(room.num)";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }

    public function getAllStayOvers($date){

        $sql = "SELECT booking.*, room.num FROM booking 
        INNER JOIN room ON room.id_room = booking.id_room
        WHERE booking.check_in < '$date' AND booking.check_out > '$date' ORDER BY ABS(room.num)";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchall();
    }


    public function getDeparturesCount($date){
        $sql = "SELECT COUNT(id_booking) FROM booking WHERE check_out = '$date'";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getArrivalsCount($date){
        $sql = "SELECT COUNT(id_booking) FROM booking WHERE check_in = '$date'";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getStayOversCount($date){
        $sql = "SELECT COUNT(id_booking) FROM booking WHERE check_in < '$date' AND check_out > '$date'";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function CountDeparturesByType($date, $type){

        $sql = "SELECT COUNT(*) AS nb_departures from booking INNER JOIN room ON room.id_room = booking.id_room INNER JOIN type_room ON type_room.id_type_room = room.id_type_room WHERE booking.check_out = '$date' AND type_room.id_type_room = $type";

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch()[0];
    }


}



?>