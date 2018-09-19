<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <style>
        body {
            height: 595px;
            width: 842px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="container-fluid  ">
        <div class="row">
            <div class="col text-center">
                <br>
                <h5>Daily Assignement Room Sheet<h5>
                        <br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h6>Date:
                            <?= $data['date']?>
                        </h6>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-2 pl-5">
                        <p>Arrivals:</p>
                    </div>
                    <div class="col pl-5">
                        <p>
                            <?php
                        foreach ($data['arrivals'] as $arrival) {
                            echo $arrival['num'] . str_repeat('&nbsp;', 5);;
                        }
                        ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 pl-5">
                        <p>Departures:</p>
                    </div>
                    <div class="col pl-5">
                        <p>
                            <?php
                        foreach ($data['departures'] as $departure) {
                            echo $departure['num'] . str_repeat('&nbsp;', 5);;
                        }
                        ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 pl-5">
                        <p>Stays:</p>
                    </div>
                    <div class="col pl-5">
                        <p>
                            <?php
                        foreach ($data['stayOvers'] as $stayOver) {
                            echo $stayOver['num'] . str_repeat('&nbsp;', 5);
                        }
                        ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item">Arrivals: <span class="float-right"><?=sizeof($data['arrivals'])?></span></li>
                    <li class="list-group-item">Departures: <span class="float-right"><?=sizeof($data['departures'])?></span></li>
                    <li class="list-group-item">Stay-Overs: <span class="float-right"><?=sizeof($data['stayOvers'])?></span></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-4 ">
            <br><br>
                <h6>Spécial Task For Today</h6>
            </div>
            <div class="col"></div>
        </div>
       
        <div class="row">
            <div class="col">
                <ul>
                    <li>Replace this</li>
                    <li>Repaire that</li>
                    <li>Clean This</li>
                    <li>Arrival room 2 need that for Anniversery</li>
                </ul>
            </div>
            <div class="col-3">
                <h6>Sheets Usage</h6>
                <ul class="list-group">
                    <li class="list-group-item">King: <span class="float-right"><?=$data['sheetsUsage']['nbKing']?></span></li>
                    <li class="list-group-item">Queen: <span class="float-right"><?=$data['sheetsUsage']['nbQueen']?></span></li>
                    <li class="list-group-item">Single: <span class="float-right"><?=$data['sheetsUsage']['nbSingle']?></span></li>
                </ul>
            </div>    
        </div>
    </div>
</body>

</html>