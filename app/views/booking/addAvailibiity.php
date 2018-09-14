<?php $title = 'Bookings'; ?>

<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
            <div class="col">
                <h1 class="display-4">Room availability</h1>
                <hr>
                <br>
            </div>
            </div>
            <form action="#" method="POST" >
                <div class="row">
                    <div class="col">
                        <label>Check-In Date</label>
                        <input type="date" class="form-control" name="checkIn">
                    </div>
                    <div class="col">
                        <label>Check-out Date</label>
                        <input type="date" class="form-control" name="checkOut">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <br>
                        <label>Type of Room</label>
                        <select class="form-control" name="typeRoom">
                            <?php
                            foreach($data['typeRooms'] as $type) {
                                echo '<option value="'.$type['id_type_room'].'">'. $type['type_name'] . ' - ' . number_format($type['price'], 2). '$ ' .'</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-secondary">
                        <?php

                            ?>
                    </div>
                </div>
            </form>
          <br><br>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                        <?php
                        foreach ($data['datesOfOccupacy'] as $date) {
                            echo '<th colspan="2">'. $date .'</th>';
                        }
                        ?>
                            <th>Book</th>
                        </tr>
                    </thead>
                        <?php
                            $GuestCheckIn = date('Y-m-d', strtotime($data['datesOfOccupacy'][0]));
                            $GuestCheckOut = date('Y-m-d', strtotime(end($data['datesOfOccupacy'])));

                            foreach ($data['rooms'] as $room) {
                                echo '<tr>';
                                echo '<td>'.$room['num'].'</td>';
                                $counterBooking = 0;
                                $nbNights = sizeof($data['datesOfOccupacy']);
                                foreach ($data['datesOfOccupacy']  as $date) {
                                    $selected = false;
                                    $isCheckIn = false;
                                    $isCheckOut = false;
                                    $turnOver = false;
                                    $tempDateCO = "";
                                    $tempDateCI = "";
                                    foreach ($data['bookings'] as $booking) {
                                        
                                        $tryDate = date('Y-m-d', strtotime($date));
                                        $tryCheckIn =  date('Y-m-d', strtotime($booking['check_in']));
                                        $tryCheckOut =  date('Y-m-d', strtotime($booking['check_out']));
                                        
                                        if(($room['id_room'] == $booking['id_room']) && ($tryDate >= $tryCheckIn) && ($tryDate <= $tryCheckOut))
                                        {
                                            $selected = true;
                                            $debug = $booking['id_guest'];

                                            if($tryDate == $tryCheckIn)
                                            {
                                                $isCheckIn = true;
                                                $tempDateCI = $tryCheckIn;

                                                if($tempDateCI == $tempDateCO)
                                                {
                                                    $turnOver = true;
                                                }
                                            }

                                            if($tryDate == $tryCheckOut)
                                            {
                                                $isCheckOut = true;
                                                $tempDateCO = $tryCheckOut;
                                            }
                                        }
                                    }
                                    

                                    if(!$selected || ($tempDateCO == $GuestCheckIn) || ($tempDateCI == $GuestCheckOut)){
                                        $counterBooking++;
                                    }
                                    
                                    if($selected && !$isCheckIn && !$isCheckOut) {
                                        echo "<td bgcolor='#FCEDE9'></td><td bgcolor='#FCEDE9'></td>";
                                    }
                                    else if($selected && $isCheckIn) {

                                        if($turnOver)
                                        {
                                            echo "<td bgcolor='#FCEDE9'></td><td bgcolor='#FCEDE9'></td>";
                                        }else {
                                            echo "<td bgcolor='#CDEAA1'></td><td bgcolor='#FCEDE9'></td>";
                                        }

                                    }
                                    else if ($selected && $isCheckOut) {
                                        echo "<td bgcolor='#FCEDE9'></td><td bgcolor='#CDEAA1'></td>";
                                    }
                                    else{
                                        echo "<td bgcolor='#CDEAA1'></td><td bgcolor='#CDEAA1'></td>";
                                    }
                                }

                                if(sizeOf($data['datesOfOccupacy']))

                                echo '<td class="text-center">';

                                if($counterBooking == $nbNights)
                                {
                                    echo '<form method="POST" action="#">';
                                    echo '<input type=hidden name="CheckInSelected" value="'. $GuestCheckIn .'">';
                                    echo '<input type=hidden name="CheckOutSelected" value="'. $GuestCheckOut .'">';
                                    echo '<input type=hidden name="idRoomSelected" value="'. $room['id_room'] .'">';
                                    echo '<input type="submit" class="btn btn-secondary btn-sm" value="book">';
                                    echo '</form>';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        ?>
                    <tbody>
                    </tbody>
                </table>
        </div>
    <div class="col-lg"></div>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>