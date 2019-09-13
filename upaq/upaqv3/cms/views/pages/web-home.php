<?php
	if(!isset($_SESSION['id'])) redireccionar('/');
?>

<section id="sec-home">
<?php 
	$type = get_db_row($_SESSION['id'],'type','users');
	if($type != 'dow'){
		require('web-inicio.php'); 
		require('web-cadetes.php'); 
		require('web-users.php'); 
		require('web-pedidos.php'); 
		require('web-pedidos-dow.php'); 
		require('web-tarifas.php'); 
	}else {
		require('web-pedidos-dow.php');
	}
	?>
<?php 
echo "<input id='isDow' value='$type' type='text' hidden>";		
?>
</section>
