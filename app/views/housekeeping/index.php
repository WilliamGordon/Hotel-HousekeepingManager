

<?php $title = 'Housekeeping'; ?>

<?php ob_start(); ?>

<?=$data['name']?>

<p>app/views/housekeeping/index.php</p>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>