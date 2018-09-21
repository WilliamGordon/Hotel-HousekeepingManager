<?php $title = 'Bookings'; ?>
<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col">
                    <h1 class="display-4">Guest Information</h1>
                    <hr>
                    <br>
                    <?php
                    $CheckInGuest   = date_create($_POST['selected']['checkIn']);
                    $CheckOutGuest  = date_create($_POST['selected']['checkOut']);
                    $nbNight        = date_diff($CheckInGuest,$CheckOutGuest);
                    ?>
                    <p class="lead">From the <?= $_POST['selected']['checkIn'] ?> to the <?= $_POST['selected']['checkOut'] ?></p>
                    <p class="lead">Number of Nights : <?=$nbNight->days?></p>
                    <p class="lead">Room ID : <?=$_POST['selected']['idRoom']?> </p>
                </div>
            </div>
            <form action="#" method="POST">
                <div class="row">
                    <div class="col">
                        <label>Firstname</label>
                        <input type="text" class="form-control" name="guest[firstName]">
                    </div>
                    <div class="col">
                        <label>LastName</label>
                        <input type="text" class="form-control" name="guest[lastName]">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>Email</label>
                        <input type="email" class="form-control" name="guest[email]">
                    </div>
                    <div class="col">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="guest[phone]">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>Number Of Person</label>
                        <input type="number" class="form-control" name="booking[nbPerson]">
                    </div>
                    <div class="col">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <input type="submit" class="btn btn-secondary" value="Send">
                    </div>
                    <div class="col">
                        <input type="hidden" name="booking[checkIn]"    value="<?= $_POST['selected']['checkIn'] ?>">
                        <input type="hidden" name="booking[checkOut]"   value="<?= $_POST['selected']['checkOut'] ?>">
                        <input type="hidden" name="booking[nbNight]"    value="<?= $nbNight->days ?>">
                        <input type="hidden" name="booking[idRoom]"     value="<?= $_POST['selected']['idRoom']?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>