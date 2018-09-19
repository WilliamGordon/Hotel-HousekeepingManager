<?php $title = 'Home'; ?>

<?php ob_start(); ?>

<?php $content = ob_get_clean(); ?>

<?php require('../app/views/templates/main.php'); ?>