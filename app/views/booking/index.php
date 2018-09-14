<?php $title = 'Bookings'; ?>

<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-2 offset-1">
                    <h1 class="display-4">Bookings</h1>
                    <br>
                </div>
                <div class="col-6 offset-1">
                    <div class="row">
                        <div class="col">
                            <br>
                            <form action="#" method="POST">
                            <input type="date" name="date" class="form-control" value="<?php echo $data['date']; ?>">
                        </div>
                        <div class="col">
                            <br>
                            <input type="submit" class="btn">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Check-in</th>
                        <th scope="col">Check-out</th>
                        <th scope="col">Nb Nights</th>
                        <th scope="col">Nb Person</th>
                        <th scope="col">Guest ID</th>
                        <th scope="col">Room ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['booking'] as $room) { ?>
                    <tr>
                        <th scope="row">
                            <?= $room['id_booking'] ?>
                        </th>
                        <td>
                            <?= $room['firstname'] ?>
                        </td>
                        <td>
                            <?= $room['lastname'] ?>
                        </td>
                        <td>
                            <?= $room['type_name'] ?>
                        </td>
                        <td>
                            <?= $room['check_in'] ?>
                        </td>
                        <td>
                            <?= $room['check_out'] ?>
                        </td>
                        <td class="text-center">
                            <?= $room['nb_night'] ?>
                        </td>
                        <td class="text-center">
                            <?= $room['nb_person'] ?>
                        </td>
                        <td class="text-center">
                            <?= $room['id_guest'] ?>
                        </td>
                        <td class="text-center"> 
                            <?= $room['id_room'] ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
                <a class="btn btn-secondary" href="<?php echo ROOT; ?>/booking/add">Add Booking</a>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>