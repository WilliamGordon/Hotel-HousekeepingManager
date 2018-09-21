<?php

class HousekeepingController extends Controller
{
    //////////////
    //CONTROLLER//
    //////////////

    public function day($date)
    {
        $bookings   = $this->model('Booking');
        $Rooms      = $this->model('Room');

        if(isset($_POST['date'])) { $date = $_POST['date']; }

        $departures     = $bookings->getAllDepartures($date);
        $arrivals       = $bookings->getAllArrivals($date);
        $turnOvers      = [];

        foreach ($departures as $departure) 
        {
            foreach ($arrivals as $arrival) 
            {
                if($departure['check_out'] == $arrival['check_in'] && $departure['id_room'] == $arrival['id_room'])
                {
                    array_push($turnOvers, $departure['id_room']);
                }
            }
        }
        
        $this->view('housekeeping/day', [
            'date'          => $date,
            'departures'    => $departures,
            'arrivals'      => $arrivals,
            'stayOvers'     => $bookings->getAllStayOvers($date),
            'turnOvers'     => $turnOvers,
            ]);
    }

    public function dayPrint($date)
    {
        $bookings   = $this->model('Booking');
        $Rooms      = $this->model('Room');

        if(isset($_POST['date'])) { $date = $_POST['date']; }

        $usageSheets = $this->usageSheetDay($date);
        $departures     = $bookings->getAllDepartures($date);
        $arrivals       = $bookings->getAllArrivals($date);
        $turnOvers      = [];

        foreach ($departures as $departure) 
        {
            foreach ($arrivals as $arrival) 
            {
                if($departure['check_out'] == $arrival['check_in'] && $departure['id_room'] == $arrival['id_room'])
                {
                    array_push($turnOvers, $departure['num']);
                }
            }
        }

        $this->view('housekeeping/dayPrint', [
            'date'          => $date,
            'departures'    => $departures,
            'arrivals'      => $arrivals,
            'stayOvers'     => $bookings->getAllStayOvers($date),
            'turnOvers'     => $turnOvers,
            'sheetsUsage'   => $usageSheets,
            ]);
    }   
    
    public function week($startDate)
    {
        $bookings   = $this->model('Booking');
        $Rooms      = $this->model('Room');

        if(isset($_POST['date'])){ $startDate = $_POST['date']; }

        $this->view('housekeeping/week', [
            'weekInfo'  => $this->getInfoWeek($startDate),
            'dateRange' => $this->getArrayDates($startDate, 6),
            ]);
    }

    public function linen($startDate)
    {
        $rooms  = $this->model('Room');
        $beds   = $this->model('Bed');

        if(isset($_POST['date'])){ $startDate = $_POST['date']; }

        $typesRoom  = $rooms->getRoomCountByType();
        $typeBed    = $beds->getBedTypes();

        $infoWeek           = $this->getInfoWeek($startDate);
        $dateRange          = $this->getArrayDates($startDate, 6);
        $dateDepType        = $this->IgetInfoWeekByType($startDate);
        $AllInfoBedsRoom    = $this->nbBedByType();
        $usageSheetWeek     = $this->usageSheetWeek($startDate);

        $this->view('housekeeping/linen', [
            'bedInfo'       => $AllInfoBedsRoom,
            'typeRoom'      =>  $typesRoom,
            'weekInfo'      => $this->getInfoWeek($startDate),
            'dateRange'     => $this->getArrayDates($startDate, 6),
            'typeDepWeek'   => $this->IgetInfoWeekByType($startDate),
            'usageSheet'    => $usageSheetWeek,
        ]);
    }

    ///////////
    //METHODS//
    ///////////

    public function getInfoDay($date)
    {
        $bookings   = $this->model('Booking');
        $Rooms      = $this->model('Room');

        $listTypeRoom   = $Rooms->getRoomCountByType();
        $typeDepDay     = [];

        foreach ($listTypeRoom as $key => $value) 
        {
            $typeDepDay[$value['id_type_room']] = $bookings->CountDeparturesByType($date, $value['id_type_room']); 
        }

        return $typeDepDay;
    }


    public function usageSheetDay($date)
    {
        $usageSheetDay = [
            'nbKing' => 0,
            'nbQueen' => 0,
            'nbSingle' => 0,
        ];

        $infoDay = $this->getInfoDay($date);

            foreach ($infoDay as $idTypeRoom => $value) 
            {
                switch ($idTypeRoom) {
                    case 1:         //id_type_room
                        $usageSheetDay['nbKing'] += ($value * 2) * 2;
                        break;
                    case 2:
                        $usageSheetDay['nbKing'] += $value * 2;
                        break;    
                    case 3:
                        $usageSheetDay['nbQueen'] += $value * 2;
                        $usageSheetDay['nbSingle'] += ($value * 2) * 2;
                        break;
                    case 4:
                        $usageSheetDay['nbQueen'] += $value * 2;
                        break;
                    case 5:
                        $usageSheetDay['nbQueen'] += $value * 2;
                        break;
                    case 6:
                        $usageSheetDay['nbQueen'] += $value * 2;
                        break;
                    case 7:
                        $usageSheetDay['nbQueen'] += $value * 2;
                        break;
                    case 8:
                        $usageSheetDay['nbQueen'] += $value * 2;
                        break;
                }    
            }
        return $usageSheetDay;
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

    public function getInfoWeek($startDate)
    {
        $bookings = $this->model('Booking');
        $Rooms = $this->model('Room');

        $dateRange = $this->getArrayDates($startDate, 6);

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

        return $allInfo; 
    }

    
    public function getInfoWeekByType($startDate)
    {
        $bookings = $this->model('Booking');
        $Rooms = $this->model('Room');

        $mainArray = [];

        $listTypeRoom = $Rooms->getRoomCountByType();

        foreach ($listTypeRoom as $key => $value) {
            $mainArray[$value['id_type_room']] = [];
        }

        $dateRange = $this->getArrayDates($startDate, 6);

        foreach ($mainArray as $keys => $values) {

            foreach ($dateRange as $key => $value) {
                $values[$value] = $bookings->CountDeparturesByType($value, $keys);;
            }
            $mainArray[$keys] = $values;
        }

        return $mainArray;
    }

    public function IgetInfoWeekByType($startDate)
    {
        $bookings = $this->model('Booking');
        $Rooms = $this->model('Room');

        $mainArray = [];

        $listTypeRoom = $Rooms->getRoomCountByType();
        $dateRange = $this->getArrayDates($startDate, 6);

        foreach ($dateRange as $key => $value) {
            $mainArray[$value] = [];
        }

        foreach ($mainArray as $keys => $values) {
            foreach ($listTypeRoom as $key => $value) {
                $values[$value['id_type_room']] = $bookings->CountDeparturesByType($keys, $value['id_type_room']);;
            }
            $mainArray[$keys] = $values;
        }

        return $mainArray;
    }

  

    public function usageSheetWeek($startDate)
    {
        $dateRange = $this->getArrayDates($startDate, 6);
        $dateDepType = $this->IgetInfoWeekByType($startDate);

        $usageSheetWeek = [
            'nbKing' => [],
            'nbQueen' => [],
            'nbSingle' => [],
        ];

        foreach ($usageSheetWeek as $key => $value) {
            foreach ($dateRange as $date) {
                $value[$date] = 0;
            }
            $usageSheetWeek[$key] = $value;
        }

        foreach ($dateDepType as $date => $depType) 
        {
            foreach ($depType as $idTypeRoom => $value) 
            {
                switch ($idTypeRoom) {
                    case 1:         //id_type_room
                        $usageSheetWeek['nbKing'][$date] += ($value * 2) * 2;
                        break;
                    case 2:
                        $usageSheetWeek['nbKing'][$date] += $value * 2;
                        break;    
                    case 3:
                        $usageSheetWeek['nbQueen'][$date] += $value * 2;
                        $usageSheetWeek['nbSingle'][$date] += ($value * 2) * 2;
                        break;
                    case 4:
                        $usageSheetWeek['nbQueen'][$date] += $value * 2;
                        break;
                    case 5:
                        $usageSheetWeek['nbQueen'][$date] += $value * 2;
                        break;
                    case 6:
                        $usageSheetWeek['nbQueen'][$date] += $value * 2;
                        break;
                    case 7:
                        $usageSheetWeek['nbQueen'][$date] += $value * 2;
                        break;
                    case 8:
                        $usageSheetWeek['nbQueen'][$date] += $value * 2;
                        break;
                }    
            }
        }

        $usageSheetWeek['nbKing']['sum'] = array_sum($usageSheetWeek['nbKing']);
        $usageSheetWeek['nbQueen']['sum'] = array_sum($usageSheetWeek['nbQueen']);
        $usageSheetWeek['nbSingle']['sum'] = array_sum($usageSheetWeek['nbSingle']);

        return $usageSheetWeek;
    }

    public function nbBedByType()
    {
        $rooms = $this->model('Room');
        $beds = $this->model('Bed');

        $typesRoom =  $rooms->getRoomCountByType();
        $king = [];
        $queen = [];
        $single = [];

        foreach ($typesRoom as $type) 
        {
            $king[$type['type_name']] = $beds->getCountBedByTypeByRoom($type['id_type_room'], 1) * $type['Room_count'];
            $queen[$type['type_name']] = $beds->getCountBedByTypeByRoom($type['id_type_room'], 2) * $type['Room_count'];
            $single[$type['type_name']] = $beds->getCountBedByTypeByRoom($type['id_type_room'], 3) * $type['Room_count'];
        }

        $AllInfoBedsRoom = [
            'king' => $king,
            'queen' => $queen,
            'single' => $single,
        ];

        return $AllInfoBedsRoom;
    }
}

?>