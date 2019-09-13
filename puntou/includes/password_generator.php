<?php
	// incluimos BD y configuraciones
	include('includes/config.php');

	// iniciamos clase que contiene la función de encriptación
	$login = new login();

	// encriptamos el texto
	var_dump($login->encrypt_password($_GET['usuario1']));
?>
