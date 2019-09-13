<?php
	session_start();
	require('config.php');

	$datos = [
		['value'=>'fullname','required'=>1,'custom'=>"Ingrese su nombre"],
	    ['value'=>'gender','required'=>1,'custom'=>"Seleccione un género"],
	    ['value'=>'id_province','required'=>1,'custom'=>"Seleccione una provincia"],
	    ['value'=>'id_city','required'=>1,'custom'=>"Seleccione una ciudad"],
	    ['value'=>'id_games','required'=>1,'custom'=>"Seleccione un deporte"],
	    ['value'=>'password','required'=>1,'custom'=>"Ingrese una contraseña"]
	];

	$login = new login();
	$_POST['password'] = $login->encrypt_password($_POST['password']);

	if ($_POST['email']!=$_SESSION['email']) array_push($datos, ['value'=>'email','required'=>1,'type'=>'user_reg_email','custom'=>"Este mail ya fue registrado"]);

	if (!empty($_POST['id_images']) && $_POST['id_images']!="")
		array_push($datos, ['value'=>'id_images','required'=>1,'custom'=>"Seleccione una imagen"]);

	$_POST['id'] = $_SESSION['id'];

	$error = get_form_cp($datos,"users","");

	echo json_encode($error);
?>
