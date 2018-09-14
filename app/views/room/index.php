<?php $title = 'Rooms'; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="col"></div>
    <div class="col-8">
    <h1 class="display-4">Room Category</h1>
                    <hr>
    <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum cum dolore fugiat possimus itaque dolor saepe, repellendus tenetur. Quia, officiis expedita atque rerum ullam consequuntur mollitia labore asperiores dolor maiores!</p>


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
                <tr>
                    <th scope="row">
                        <?= ucwords($room['type_name']) ?>
                    </th>
                    <td class="text-center">
                        <?= $room['Room_count'] ?>
                    </td>
                    <td class="text-center">
                        <a class="btn"  href="room/category/<?=$room['id_type_room']?>" >List</a>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td>
                        <input class="btn" type="button" value="Add a type of room">
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="col"></div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>