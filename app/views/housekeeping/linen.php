<?php $title = 'Linen'; ?>

<?php ob_start(); ?>


<div class="container">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-6">
                    <h1 class="display-4">Linen Usage</h1>
                    <br>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            <br>
                            <form action="#" method="POST">
                                <input type="date" name="date" class="form-control" value="<?php echo $data['dateRange'][6]; ?>">
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
                <div class="col">

                    <div class="row">
                        <div class="col">

                            <p class="lead">Number Of beds Sorted by Type of Room</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <?php
                    foreach ($data['typeRoom'] as $type) 
                    {
                        echo '<th>' . $type['type_name'] . '</th>';
                    }
                    ?>
                                        <th scope="col">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                
                foreach ($data['bedInfo'] as $key => $value) 
                {
                    echo '<tr>';
                    echo '<th scope="row">' . $key .'</th>';
                    $temp = 0;
                    foreach ($value as $count) 
                    {
                        echo '<td>' . $count . '</td>';
                        $temp += $count;
                    }

                    echo '<td>' . $temp . '</td>';
                    echo '</tr>';
                }

                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p class="lead">Usage of Sheets For The Week</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <?php
                    foreach ($data['dateRange'] as $date) 
                    {
                        echo '<th>' . $date . '</th>';
                    }
                    ?>
                                        <th scope="col">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                
                foreach ($data['usageSheet'] as $key => $value) 
                {
                    echo '<tr>';
                    echo '<th scope="row">' . $key .'</th>';
                    $temp = 0;
                    foreach ($value as $count)
                    {
                        echo '<td>' . $count . '</td>';
                    }
                    echo '</tr>';
                }
                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>