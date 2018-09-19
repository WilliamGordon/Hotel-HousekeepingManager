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
                                <thead>
                                    <tr class="text-center">
                                        <?php
                 echo '<th scope="col">#</th>';
                foreach ($data['dateRange'] as $date) 
                {
                    echo '<th scope="col" colspan="2">' . $date . '</th>';
                }
            ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                foreach ($data['availibility'] as $room => $dateGuest) 
                {
                    echo '<tr>';
                    echo '<th scope="row">' . $room . '</th>';
                    
                    foreach ($dateGuest as $key => $value) 
                    {
                        if($value)
                        {
                            echo '<td bgcolor="#FCEDE9">'. $value['id_booking'] .'</td>';
                        } 
                        else
                        {
                            echo '<td bgcolor="#CDEAA1"></td>';    
                        }
                    }
                    echo '</tr>';
                }
            ?>
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