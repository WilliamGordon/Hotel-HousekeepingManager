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
                    $CheckInGuest = date_create($_POST['CheckInSelected']);
                    $CheckOutGuest = date_create($_POST['CheckOutSelected']);
                    $nbNight = date_diff($CheckInGuest,$CheckOutGuest);
                ?>

                <p class="lead">From the <?=$_POST['CheckInSelected']?> to the <?=$_POST['CheckOutSelected']?> </p>
                <p class="lead">Number of Nights : <?=$nbNight->days?> </p>
                <p class="lead">Room ID : <?=$_POST['idRoomSelected']?></p>
            </div>
            </div>
            <form action="#" method="POST" >
                <div class="row">
                    <div class="col">
                        <label>Firstname</label>
                        <input type="text" class="form-control" name="firstName">
                    </div>
                    <div class="col">
                        <label>LastName</label>
                        <input type="text" class="form-control" name="lastName">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="col">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>Number Of Person</label>
                        <input type="number" class="form-control" name="nbPerson">
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

                    <input type="hidden" name="checkIn" value="<?=$_POST['CheckInSelected']?>">
                    <input type="hidden" name="checkOut" value="<?=$_POST['CheckOutSelected']?>">
                    <input type="hidden" name="nbNight" value="<?=$nbNight->days?>">
                    <input type="hidden" name="idRoom" value="<?=$_POST['idRoomSelected']?>">
                    </div>
                </div>
            </form>
        </div>
    <div class="col-lg"></div>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>