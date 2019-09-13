<?php
	session_start();
	require('config.php');

	$datos = [
		['value'=>'fullname','required'=>1,'custom'=>"Ingrese su nombre"],
	    ['value'=>'password','required'=>1,'custom'=>"Ingrese una contraseña"],
	    ['value'=>'email','required'=>1,'type'=>'user_reg_email','custom'=>"Este mail ya fue registrado"],
	    ['value'=>'mensaje_pred','required'=>1,'custom'=>"Seleccione una provincia"],
		['value'=>'alias_asociado','required'=>1,'custom'=>"Seleccione un deporte"],
		['value'=>'username','required'=>1,'custom'=>"Seleccione un deporte"],
	    ['value'=>'empresa','required'=>1,'custom'=>"Seleccione una ciudad"]	    	    
	];

	$login = new login();
	$_POST['password'] = $login->encrypt_password($_POST['password']);

	$error = get_form_cp($datos,"users","");

	echo json_encode($error);
?>
