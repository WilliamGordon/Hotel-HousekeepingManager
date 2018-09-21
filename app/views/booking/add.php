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
                        <input type="date" class="form-control" name="availability[checkIn]">
                    </div>
                    <div class="col">
                        <label>Check-out Date</label>
                        <input type="date" class="form-control" name="availability[checkOut]">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label>Type of Room</label>
                        <select class="form-control" name="availability[typeRoom]">
                            <?php
                            foreach($data['typeRooms'] as $type) 
                            {
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
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>