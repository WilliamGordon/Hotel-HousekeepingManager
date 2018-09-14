<?php

class BookingController extends Controller
{
    public function index($date)
    {
        // $listOfBookings = $this->model('Booking');

        // //HACK!!
        // if(isset($_POST['date']))
        // {
        //     $date = $_POST['date'];
        // }

        // $this->view('booking/index', [
        //     'booking' => $listOfBookings->getBookings($date),
        //     'date' => $date      
        //     ]);
    }

    
    public function day($date)
    {
            $listOfBookings = $this->model('Booking');

            //HACK!!
            if(isset($_POST['date']))
            {
                $date = $_POST['date'];
            }
    
            $this->view('booking/day', [
                'booking' => $listOfBookings->getBookings($date),
                'date' => $date      
                ]);
    }


    public function week($idTypeRoom, $checkIn)
    {
        $typesOfRooms = $this->model('Room');
        $bookings = $this->model('Booking');
        $Guest = $this->model('Guest');

        if(isset($_POST['checkIn']))
        {
            $checkIn = $_POST['checkIn'];
        } 


        $checkOut = date ("Y-m-d", strtotime("+9 day", strtotime($checkIn)));
        
        $datesOfOccupacy = [];
            $date = $checkIn;
            $end_date = $checkOut;
            while (strtotime($date) <= strtotime($end_date)) {
                array_push($datesOfOccupacy, $date);
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            }

        $this->view('booking/week', [
            'roomCat' => $typesOfRooms->getRoomCountByType(),
            'idTypeRoom' => $idTypeRoom,
            'rooms' => $typesOfRooms->getRoomsByType($idTypeRoom),
            'typeRooms' => $typesOfRooms->getTypesOfRoom(),
            'bookings' => $bookings->getAvailability($idTypeRoom, $checkIn, $checkOut),
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'datesOfOccupacy' => $datesOfOccupacy
            ]);
    }

    public function add()
    {
        $typesOfRooms = $this->model('Room');
        $bookings = $this->model('Booking');
        $Guest = $this->model('Guest');

        if(isset($_POST['checkIn'], $_POST['checkOut'], $_POST['typeRoom']))
        {
            $checkIn = $_POST['checkIn'];
            $checkOut = $_POST['checkOut']; 
            $typeRoom = $_POST['typeRoom'];
            $datesOfOccupacy = [];

            $date = $checkIn;
            $end_date = $checkOut;
            while (strtotime($date) <= strtotime($end_date)) {
                array_push($datesOfOccupacy, $date);
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
            
            $this->view('booking/addAvailibiity', [
                'typeRooms' => $typesOfRooms->getTypesOfRoom(),
                'rooms' => $typesOfRooms->getRoomsByType($typeRoom),
                'bookings' => $bookings->getAvailability($typeRoom, $checkIn, $checkOut),
                'checkIn' => $checkIn,
                'checkOut' => $checkOut,
                'datesOfOccupacy' => $datesOfOccupacy
            ]);
        } else if (isset($_POST['CheckInSelected'], $_POST['CheckOutSelected'], $_POST['idRoomSelected'])) {

            $this->view('booking/addGuestBooking', []);

        } else if(isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['nbPerson']))
        {

            $firstName = $_POST['firstName']; 
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $nbPerson = $_POST['nbPerson'];
            $checkIn = $_POST['checkIn'];
            $checkOut = $_POST['checkOut'];
            $nbNight = $_POST['nbNight'];
            $idRoom = $_POST['idRoom'];

            $idGuest = $Guest->addGuestGiveId($firstName, $lastName, $email, $phone);
            $bookings->addBooking($checkIn, $checkOut, $nbNight, $nbPerson, $idGuest, $idRoom);
            
            $this->view('booking/addSuccess', [
                'firstName' => $firstName, 
                'lastName' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'nbPerson' => $nbPerson,
                'checkIn' => $checkIn,
                'checkOut' => $checkOut,
                'nbNight' => $nbNight,
                'idRoom' => $idRoom,
                'idGuest' => $idGuest,
            ]);
        }
        else {
            $this->view('booking/add', [
                'typeRooms' => $typesOfRooms->getTypesOfRoom(),
            ]);
        }
    }
}

?>