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
                            <span class="float-right">
                                <?= $data['guest']['firstName']?>
                                <?= $data['guest']['lastName']?>
                            </span>
                        </li>
                        <li class="list-group-item">Email:
                            <span class="float-right">
                                <?= $data['guest']['email']?>
                            </span>
                        </li>
                        <li class="list-group-item">Phone Number:
                            <span class="float-right">
                                <?= $data['guest']['phone']?>
                            </span>
                        </li>
                        <li class="list-group-item">ID ROOM :
                            <span class="float-right">
                                <?= $data['booking']['idRoom']?>
                            </span>
                        </li>
                        <li class="list-group-item">ID GUEST :
                            <span class="float-right">
                                <?= $data['idGuest']?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            Will be Chekcing in the
                            <?= $data['booking']['checkIn']?> and Checking Out the
                            <?= $data['booking']['checkOut']?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>