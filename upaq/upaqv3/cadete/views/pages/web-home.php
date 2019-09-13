<?php
	if(!isset($_SESSION['id'])) redireccionar('/');
?>

<section id="home" class="home">
    <?php require('web-presentacion.php'); ?>
    <?php require('web-orders.php'); ?>
    <?php require('web-info.php'); ?>
    <?php require('web-btn-float.php'); ?>
    <?php require('web-end.php'); ?>
    <?php require('web-pedidos.php'); ?>
</section>