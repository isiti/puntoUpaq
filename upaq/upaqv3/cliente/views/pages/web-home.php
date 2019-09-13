<?php
	if(!isset($_SESSION['id'])) redireccionar('/');
?>

<section id="home" class="home">
	<!-- formulario carga de pedidos -->
	<?php include("views/pages/web-form.php"); ?>
	<!-- tabla de pedidos -->
	<?php include("views/pages/web-pedidos.php"); ?>
	<!-- mensaje cierre -->
	<?php include("views/pages/web-end.php"); ?>
</section>



