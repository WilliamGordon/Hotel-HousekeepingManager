<?php $title = 'Daily Task'; ?>

<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-6">
                    <h1 class="display-4">Housekeeping Weekly Tasks</h1>
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
                
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                        <?php
                        foreach ($data['dateRange'] as $date) {
                            echo '<th scope="col">' . $date . '</th>';
                        }                        
                        ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($data['weekInfo'] as $col => $info) 
                        {
                            echo '<tr>';
                            echo '<th scope="row">'. $col .'</th>';
                            foreach ($info as $value) 
                            {
                                echo '<td>'. $value .'</td>';
                            }
                            echo '<tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <br><br>
        </div>
        <div class="col-lg"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>