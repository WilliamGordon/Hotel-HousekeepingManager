<?php $title = 'Bookings'; ?>
<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col">
                    <h1 class="display-4">Booking Sucessfully Encoded!</h1>
                    <hr>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                    <ul class="list-group list-group-flush font-weight-bold">
                        <li class="list-group-item">Full Name:
                            <span class="float-right"><?= $data['firstName']?> <?= $data['lastName']?></span>
                        </li>
                        <li class="list-group-item">Email:
                            <span class="float-right"><?= $data['email']?></span>
                        </li>
                        <li class="list-group-item">Phone Number:
                            <span class="float-right"> <?= $data['phone']?></span>
                        </li>
                        <li class="list-group-item">ID ROOM :
                            <span class="float-right"><?= $data['idRoom']?></span>
                        </li>
                        <li class="list-group-item">ID GUEST :
                            <span class="float-right"><?= $data['idGuest']?></span>
                        </li>
                        <li class="list-group-item">
                            Will be Chekcing in the <?= $data['checkIn']?> and Checking Out the <?= $data['checkOut']?></p>
                        </li>
                </div>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>