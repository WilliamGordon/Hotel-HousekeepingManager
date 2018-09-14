<?php

class RoomController extends Controller
{
    public function index()
    {
        $listOfRooms = $this->model('Room');

        $this->view('room/index', [
            'roomCat' => $listOfRooms->getRoomCountByType()
        ]);
    }

    public function category($idTypeRoom)
    {
        $listOfRooms = $this->model('Room');
        $this->view('room/category', [
            'listRooms' => $listOfRooms->getRoomsByType($idTypeRoom), 
            'infoType' => $listOfRooms->getInfoType($idTypeRoom), 
            'range' => $listOfRooms->getRangeCapacity($idTypeRoom),
            'roomCat' => $listOfRooms->getRoomCountByType(),
            'idTypeRoom' => $idTypeRoom
            ]);
    }
}

?>