<?php

class BookingController extends Controller
{
    //CONTROLLERS
    public function day($date)
    {
        $listOfBookings = $this->model('Booking');

        if(isset($_POST['date'])) { $date = $_POST['date']; }
    
        $this->view('booking/day', [
            'booking' => $listOfBookings->getBookings($date),
            'date' => $date      
            ]);
    }

    public function week($idTypeRoom, $checkIn)
    {
        $room           = $this->model('Room');
        $booking        = $this->model('Booking');
        $Guest          = $this->model('Guest');

        if(isset($_POST['checkIn'])) { $checkIn = $_POST['checkIn']; } 
        
        $dateRange      = $this->getArrayDates($checkIn, 9);
        $roomTypes      = $room->getRoomCountByType();
        $availibility = $this->getAvailability($idTypeRoom, $checkIn, 9);

        $this->view('booking/week', [
            'roomCat'       => $roomTypes,
            'idTypeRoom'    => $idTypeRoom,
            'checkIn'       => $checkIn,
            'dateRange'     => $dateRange,
            'availibility'  => $availibility, 
            ]);
    }

    public function add()
    {
        $room           = $this->model('Room');
        $booking        = $this->model('Booking');
        $guest          = $this->model('Guest');

        if($this->checkIsset($_POST, 'availability'))
        {
            $checkIn    = $_POST['availability']['checkIn'];
            $checkOut   = $_POST['availability']['checkOut'];
            $typeRoom   = $_POST['availability']['typeRoom'];

            $dateRange  = $this->getArrayDates($checkIn, $this->getNumDays($checkIn, $checkOut));
            $info       = $this->getAvailability($typeRoom, $checkIn, ($this->getNumDays($checkIn, $checkOut)));

            $this->view('booking/addAvailibiity', [
                'typeRooms'     => $room->getTypesOfRoom(),
                'dateRange'     => $dateRange,
                'info'          => $info,
            ]);
        } 
        else if ($this->checkIsset($_POST, 'selected'))
        {
            $this->view('booking/addGuestBooking', []);
        }
        else if ($this->checkIsset($_POST, 'guest') && $this->checkIsset($_POST, 'booking'))
        {
            $idGuest =  $guest->addGuestGiveId($_POST['guest']);
                        $booking->addBooking($_POST['booking'], $idGuest);
                
            $this->view('booking/addSuccess', [
                'guest'     => $_POST['guest'],
                'booking'   => $_POST['booking'],
                'idGuest'   => $idGuest,
            ]);
        }
        else 
        {
            $this->view('booking/add', [
                'typeRooms'     => $room->getTypesOfRoom(),
            ]);
        }
    }

    //VALIDATION
    public function checkIsset($post, $keyword)
    {
        $varSetted = false;

        if(isset($post[$keyword]))
        {
            $counter = 0;
            foreach ($post[$keyword] as $key => $value) 
            {
                if(isset($value) && !empty($value))
                {
                    $counter++;
                }
            }

            if($counter == sizeof($post[$keyword]) && $counter != 0)
            {
                $varSetted = true;
            }
        }
        return $varSetted;
    }

    //METHODS

    public function getNumDays($date1, $date2)
    {
        $datetime1 = strtotime($date1);
        $datetime2 = strtotime($date2);
        $secs = $datetime2 - $datetime1;
        $days = $secs / 86400;
        return $days;
    }

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

    public function getAvailability($idTypeRoom, $checkIn, $offset)
    {
        $room           = $this->model('Room');
        $booking        = $this->model('Booking');
        $dateRange      = $this->getArrayDates($checkIn, $offset);
        
        $bookings       = $booking->getAvailability($idTypeRoom, $dateRange);
        $rooms          = $room->getRoomsByType($idTypeRoom);

        $info = [];

        foreach ($rooms as $key => $room) 
        {
            $info[$room['id_room']] = [];
        }

        foreach ($info as $room => $value) 
        {
            foreach ($dateRange as $date) 
            {
                $value[$date.'M'] = $this->isCheckingOut($room, $date, $bookings);   
                $value[$date.'E'] = $this->isCheckingIn($room, $date, $bookings);
            
                if(!$value[$date.'M'] && !$value[$date.'E'])
                {
                    $value[$date.'M'] = $this->isStayingIn($room, $date, $bookings);
                    $value[$date.'E'] = $this->isStayingIn($room, $date, $bookings);
                }
            }
            $info[$room] = $value;
        }

        return $info;
    }
    
    function isCheckingIn($room, $date, $bookings)
    {
        foreach ($bookings as $key => $booking) 
        {
           if($booking['check_in'] == $date && $booking['id_room'] == $room)
           {
               return $booking['id_booking'];
           }
        }
        return false;
    }

    function isCheckingOut($room, $date, $bookings)
    {
        foreach ($bookings as $key => $booking) 
        {
           if($booking['check_out'] == $date && $booking['id_room'] == $room)
           {
               return $booking['id_booking'];
           }
        }
        return false;
    }

    function isStayingIn($room, $date, $bookings)
    {
        foreach ($bookings as $key => $booking) 
        {
           if($booking['check_in'] < $date && $booking['check_out'] > $date && $booking['id_room'] == $room)
           {
               return $booking['id_booking'];
           }
        }
        return false;
    }
}

?>