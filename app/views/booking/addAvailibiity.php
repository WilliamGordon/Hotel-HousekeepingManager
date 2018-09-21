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
            <form action="#" method="POST">
                <div class="row">
                    <div class="col">
                        <label>Check-In Date</label>
                        <input type="date" class="form-control" name="availability[checkIn]" value="<?= $data['dateRange'][0] ?>">
                    </div>
                    <div class="col">
                        <label>Check-out Date</label>
                        <input type="date" class="form-control" name="availability[checkOut]" value="<?=end($data['dateRange'])?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label>Type of Room</label>
                        <select class="form-control" name="availability[typeRoom]">
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
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <?php
                        foreach ($data['dateRange'] as $date) 
                        {
                            echo '<th scope="col" colspan="2">' . $date . '</th>';
                        }
                        ?>
                        <th>Book</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($data['info'] as $room => $dateGuest) 
                {
                    echo '<tr>';
                    echo '<th scope="row">' . $room . '</th>';

                    foreach ($dateGuest as $key => $value) 
                    {
                        if($value)
                        {
                            echo '<td bgcolor="#FCEDE9">'. $value .'</td>';
                        } 
                        else
                        {
                            echo '<td bgcolor="#CDEAA1"></td>';    
                        }
                    }
                    echo '<td>';

                    if(array_sum($dateGuest) == 0)
                    {
                        echo '<form method="POST" action="#">';
                        echo '<input type=hidden name="selected[checkIn]"   value="'. $data['dateRange'][0] .'">';
                        echo '<input type=hidden name="selected[checkOut]"  value="'. end($data['dateRange']) .'">';
                        echo '<input type=hidden name="selected[idRoom]"    value="'. $room .'">';
                        echo '<input type="submit" class="btn btn-secondary btn-sm" value="book">';
                        echo '</form>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>