<?php $title = 'Daily Task'; ?>

<?php ob_start(); ?>

  <?php
                $date = date('Y-m-d');

                if(isset($_POST['date'])){
                    $date =  $_POST['date'];
                }

                $url = ROOT . "/housekeeping/dayPrint/". $date; 
                $url=str_replace(" ","",$url); 
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-6">
                    <h1 class="display-4">Housekeeping Daily Tasks</h1>
                    <br>
                </div>
                <div class="col-6">
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
            <br><br>
            <div class="row" id="allInfo">
                <div class="col-lg">
                <p class="lead">INFO</p>
                <ul class="list-group list-group-flush font-weight-bold">
                    <li class="list-group-item">Departures: <?= sizeof($data['departures']) ?></li>
                    <li class="list-group-item">Arrivals: <?= sizeof($data['arrivals']) ?></li>
                    <li class="list-group-item">Stay-Overs: <?= sizeof($data['stayOvers']) ?></li>
                    <li class="list-group-item">Turn-Overs: <?= sizeof($data['turnOvers']) ?></li>
                </ul>
                </table>                
                </div>
            </div>
            <br><br>
            <div class="row" id="departures">
                <div class="col-lg">
                    <p class="lead">DEPARTURES</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Room Number</th>
                                <th scope="col">ATD</th>
                                <th scope="col">Add Info</th>
                                <th scope="col">Turn-Over</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 0;
                            foreach($data['departures'] as $departure)
                            {
                                echo '<tr>';
                                echo '  <td>'. $departure['id_room'] .'</td>';
                                echo '  <td> 12:00 PM </td>';
                                echo '  <td>'. $departure['add_info'] .'</td>';
                                echo '  <td>Type Of Room</td>';
                                echo '  <td>'. ++$counter .'</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row" id="arrivals">
                <div class="col-lg">
                    <p class="lead">ARRIVALS</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Room Number</th>
                                <th scope="col">ATD</th>
                                <th scope="col">Add Info</th>
                                <th scope="col">Turn-Over</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 0;
                            foreach($data['arrivals'] as $arrivals)
                            {
                                echo '<tr>';
                                echo '  <td>'. $arrivals['id_room'] .'</td>';
                                echo '  <td> 12:00 PM </td>';
                                echo '  <td>'. $arrivals['add_info'] .'</td>';
                                echo '  <td>Type Of Room</td>';
                                echo '  <td>'. ++$counter .'</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row" id="stay-over">
                <div class="col-lg">
                    <p class="lead">STAY-OVERS</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Room Number</th>
                                <th scope="col">ATD</th>
                                <th scope="col">Add Info</th>
                                <th scope="col">Turn-Over</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 0;
                            foreach($data['stayOvers'] as $stayOvers)
                            {
                                echo '<tr>';
                                echo '  <td>'. $stayOvers['id_room'] .'</td>';
                                echo '  <td> 12:00 PM </td>';
                                echo '  <td>'. $stayOvers['add_info'] .'</td>';
                                echo '  <td>Type Of Room</td>';
                                echo '  <td>'. ++$counter .'</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <a class="btn btn-primary" href="

           

                <?php echo $url; ?>

            ">Print</a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>