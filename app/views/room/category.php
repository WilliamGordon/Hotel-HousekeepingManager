<?php $title = 'Rooms'; ?>
<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg">
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
                                                <a class="btn" href="<?php echo ROOT; ?>/room/category/<?=$room['id_type_room']?>">List</a>
                                            </td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>
                                                    <a class="btn btn-secondary" href="<?php echo ROOT; ?>/room/addType">Add a type of room</a>
                                                    <br>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col text-center">
                            <h1 class="display-4">
                                <?=ucwords($data['listRooms'][0]['type_name'])?>
                            </h1>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 float-left">
                            <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum cum
                                dolore fugiat
                                possimus
                            </p>
                        </div>
                        <div class="col-6 float-left">
                            <ul class="list-group list-group-flush font-weight-bold">
                                <li class="list-group-item">Capacity:

                                    <span class="float-right">
                                        <?= $data['range']['min'] ?> -
                                        <?= $data['range']['max'] ?></span>
                                </li>
                                <li class="list-group-item">Price:
                                    <span class="float-right">
                                        <?= number_format($data['infoType']['price'],2) ?> $</span>
                                </li>
                                <li class="list-group-item">Kitchen:
                                    <span class="float-right">
                                        <?php if($data['infoType']['kitchen'])
                        {
                            echo '<span class="badge badge-primary badge-pill">1</span>';
                        } else {
                            echo '<span class="badge badge-danger badge-pill">0</span>';
                        } ?>
                                    </span>
                                </li>
                                <li class="list-group-item">Tub:
                                    <span class="float-right">
                                        <?php if($data['infoType']['tub'])
                        {
                            echo '<span class="badge badge-primary badge-pill">1</span>';
                        } else {
                            echo '<span class="badge badge-danger badge-pill">0</span>';
                        } ?>
                                    </span>
                                </li>
                            </ul>
                            <br>
                            <a class="btn btn-secondary" href="<?php echo ROOT; ?>/room/editType/<?= $data['infoType']['id_type_room'] ?>">Edit Setting</a>
                            <br>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col"></div>
                        <div class="col-8">
                            <br>
                            <br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Room ID</th>
                                        <th class="text-center" scope="col">Room Number</th>
                                        <th class="text-center" scope="col">Info</th>
                                        <th class="text-center" scope="col"></th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['listRooms'] as $room) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $room['id_room'] ?>
                                        </th>
                                        <td class="text-center">
                                            <?= $room['num'] ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $room['add_info'] ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-danger btn-sm" href="room/category/<?=$room['id_type_room']?>">delete</a>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-secondary btn-sm" href="room/category/<?=$room['id_type_room']?>">edit</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>
                                            <a class="btn btn-secondary" href="<?php echo ROOT; ?>/room/addRoom/<?= $data['infoType']['id_type_room'] ?>">Add room</a>
                                            <br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</div>






<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>