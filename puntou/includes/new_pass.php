<?php
	session_start();
	require('config.php');

	//Paso 1 : Actualizo el pass de la cuenta

	$datos = [['value'=>'password','required'=>1,'custom'=>"Ingrese una contraseña"]];

	$login = new login();
	$_POST['password'] = $login->encrypt_password($_POST['password']);

	$_POST['id'] = $_SESSION['id'];

	$error = get_form_cp($datos,"users","");

	//Paso 2 - Cambio el estado de claimed a 1

	$datos = [['value'=>'claimed','custom'=>""]];

	$_POST['id'] = $_SESSION['id_recover'];
	$_POST['claimed'] = 1;

	$error = get_form_cp($datos,"recover",""); 

	echo json_encode($error);
?>
