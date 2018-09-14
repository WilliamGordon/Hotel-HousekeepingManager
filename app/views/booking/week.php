<?php $title = 'Rooms'; ?>
<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col text-center">
                            <div class="row">
                                <br><br><br>
                            </div>
                            <div class="row">
                                <div class="col-4 text-center">
                                    <h1 class="display-5">
                                        Room Category
                                    </h1>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Type of Room</th>
                                                <th class="text-center" scope="col">Room Count</th>
                                                <th class="text-center" scope="col">Explore</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['roomCat'] as $room) { ?>
                                            <?php if($room['id_type_room'] == $data['idTypeRoom'])
                                            {
                                                echo '<tr class="table-secondary">';
                                            } else
                                            {
                                                echo '<tr>';
                                            }
                                            ?>
                                            <th scope="row">
                                                <?= ucwords($room['type_name']) ?>
                                            </th>
                                            <td class="text-center">
                                                <?= $room['Room_count'] ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn" href="
                                                
                                                <?php
                                                $date = date('Y-m-d');

                                                if(isset($_POST['checkIn'])){
                                                    $date =  $_POST['checkIn'];
                                                } else if (isset($data['checkIn']))
                                                {
                                                    $date = $data['checkIn'];
                                                }
                                                $url = ROOT . "/booking/week/"
                                                    . $room['id_type_room'] . "/" . $date; $url=str_replace(" ","",$url);

                                                echo $url;
                                                ?>
                                                ">List</a>
                                            </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col text-center">
                            <h1 class="display-4">
                                Calendar Bookings
                            </h1>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 float-left">
                        </div>
                        <div class="col-6 float-left">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <label>Check-In Date</label>
                                        <input type="date" class="form-control" name="checkIn" <?php echo 'value="' .
                                            $date .'"'; ?>
                                        >
                                    </div>
                                    <div class="col-3">
                                        <br>
                                        <input type="submit" class="btn btn-secondary btn-sm" value="check">
                                    </div>
                                </div>
                            </form>
                            <br>
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <?php
                        foreach ($data['datesOfOccupacy'] as $date) {
                            echo '<th colspan="2">'. $date .'</th>';
                        }
                        ?>
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
                            }
                        ?>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>