<?php

class RoomController extends Controller
{
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

    public function addType()
    {

    }

    public function addRoom($type)
    {

    }

    public function editType($type)
    {

    }

    public function editRoom($room)
    {

    }

    public function nbBedByType()
    {

    }


}

?>