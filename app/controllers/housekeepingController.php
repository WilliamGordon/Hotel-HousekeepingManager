<?php

class HousekeepingController extends Controller
{
    public function index()
    {
        $this->view('housekeeping/index', []);
    }

    public function dayPrint($date)
    {
        $bookings = $this->model('Booking');
        $Rooms = $this->model('Room');

        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }

        $departures = $bookings->getAllDepartures($date);
        $arrivals = $bookings->getAllArrivals($date);
        $turnOvers = [];

        foreach ($departures as $departure) {
            foreach ($arrivals as $arrival) {
                if($departure['check_out'] == $arrival['check_in'] && $departure['id_room'] == $arrival['id_room'])
                {
                    array_push($turnOvers, $departure['num']);
                }
            }
        }
        $this->view('housekeeping/dayPrint', [
            'date' => $date,
            'departures' => $departures,
            'arrivals' => $arrivals,
            'stayOvers' => $bookings->getAllStayOvers($date),
            'turnOvers' => $turnOvers,
            ]);

    }   

    public function day($date)
    {
        $bookings = $this->model('Booking');
        $Rooms = $this->model('Room');

        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }

        $departures = $bookings->getAllDepartures($date);
        $arrivals = $bookings->getAllArrivals($date);
        $turnOvers = [];

        foreach ($departures as $departure) {
            foreach ($arrivals as $arrival) {
                if($departure['check_out'] == $arrival['check_in'] && $departure['id_room'] == $arrival['id_room'])
                {
                    array_push($turnOvers, $departure['id_room']);
                }
            }
        }
        $this->view('housekeeping/day', [
            'date' => $date,
            'departures' => $departures,
            'arrivals' => $arrivals,
            'stayOvers' => $bookings->getAllStayOvers($date),
            'turnOvers' => $turnOvers,
            ]);
    }

    public function week($startDate)
    {
        $bookings = $this->model('Booking');
        $Rooms = $this->model('Room');

        if(isset($_POST['date'])){
            $startDate = $_POST['date'];
        }

        $endDate =  date ("Y-m-d", strtotime("+6 day", strtotime($startDate)));
        
        $dateRange = [];
        $date = $startDate;
        $end_date = $endDate;
        while (strtotime($date) <= strtotime($end_date)) {
            array_push($dateRange, $date);
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        $depaturesWeek = [];
        $arrivalsWeek = [];
        $StayOverWeek = [];
        $turnOverWeek = [];

        foreach ($dateRange as $date) 
        {
            $depaturesWeek[$date] = $bookings->getDeparturesCount($date)[0];
            $arrivalsWeek[$date] = $bookings->getArrivalsCount($date)[0];
            $StayOverWeek[$date] = $bookings->getStayOversCount($date)[0];

            $departures = $bookings->getAllDepartures($date);
            $arrivals = $bookings->getAllArrivals($date);
            $turnOvers = 0;

            foreach ($departures as $departure) {
                foreach ($arrivals as $arrival) {
                    if($departure['check_out'] == $arrival['check_in'] && $departure['id_room'] == $arrival['id_room'])
                    {
                        $turnOvers++;
                    }
                }
            }

            $turnOverWeek[$date] = $turnOvers;
        }

        $allInfo = array(
            'departures' => $depaturesWeek,
            'arrivals' => $arrivalsWeek,
            'stays' => $StayOverWeek,
            'turn' => $turnOverWeek,
        );

        $this->view('housekeeping/week', [
            'date' => $date,
            'weekInfo' => $allInfo,
            'dateRange' => $dateRange,
            ]);
    }

    public function linen($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('housekeeping/linen', ['name' => $user->name]);
    }

}

?>