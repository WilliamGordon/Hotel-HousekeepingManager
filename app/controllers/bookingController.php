<?php

class BookingController extends Controller
{

    public function getArrayDates($startDate, $offSet)
    {

        $endDate =  date ("Y-m-d", strtotime('+'.$offSet.' day', strtotime($startDate)));

        $dateRange = [];
        $date = $startDate;
        $end_date = $endDate;
        while (strtotime($date) <= strtotime($end_date)) {
            array_push($dateRange, $date);
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        return $dateRange;
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

    public function getAvailibility($idTypeRoom, $checkIn, $offset)
    {

        $room           = $this->model('Room');
        $booking        = $this->model('Booking');

        $dateRange      = $this->getArrayDates($checkIn, 9);
        $rooms          = $room->getRoomsByType($idTypeRoom);

        $availibility = [];

        foreach ($rooms as $key => $value) 
        {
            $availibility[$value['id_room']] = [];
        }


        foreach ($availibility as $room => $datesAndGuests) 
        {
            foreach ($dateRange as $date) 
            {
                $datesAndGuests[$date.'M'] = $booking->getNameCheckOut($room, $date);
                $datesAndGuests[$date.'E'] = $booking->getNameCheckIn($room, $date);

                if(!$datesAndGuests[$date.'M'] && !$datesAndGuests[$date.'E'])
                {
                    $datesAndGuests[$date.'M'] = $booking->getNameCheckStays($room, $date);
                    $datesAndGuests[$date.'E'] = $booking->getNameCheckStays($room, $date);
                }
            }
            $availibility[$room] = $datesAndGuests;
        }

        return $availibility;
    }


    public function week($idTypeRoom, $checkIn)
    {
        $room           = $this->model('Room');
        $booking        = $this->model('Booking');
        $Guest          = $this->model('Guest');

        if(isset($_POST['checkIn']))
        {
            $checkIn = $_POST['checkIn'];
        } 
        
        $dateRange      = $this->getArrayDates($checkIn, 9);
        $roomTypes      = $room->getRoomCountByType();
        $availibility = $this->getAvailibility($idTypeRoom, $checkIn, 9);

        $this->view('booking/week', [
            'roomCat' => $roomTypes,
            'idTypeRoom' => $idTypeRoom,
            'checkIn' => $checkIn,
            'dateRange' => $dateRange,
            'availibility' => $availibility, 
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