<?php
    require "../config/config.php";

    $_POST['submit_edit'] = "submit_edit";
    $_POST['user'] = $_SESSION['id'];
    $_POST['cadete'] = 0;
    $_POST['active'] = 1;

    $datos = [
        ["value" => "id", "required" => 1, "custom" => ""],
        ["value" => "origen", "required" => 1, "custom" => "Error, debe ingresar un nombre"],
        ["value" => "depto_origen", "required" => 1, "custom" => "Error, debe ingresar un apellido"],
        ["value" => "destino", "required" => 1, "custom" => "Error, debe ingresar un email"],
        ["value" => "depto_destino", "required" => 1, "custom" => "Error, debe ingresar una contraseña"],        
        ["value" => "destinatario", "required" => 1, "custom" => ""],
        ["value" => "descripcion", "required" => 1, "custom" => ""],
        ["value" => "user", "required" => 1, "custom" => ""],
        ["value" => "cadete", "required" => 1, "custom" => ""],

    ];

    $error = get_form_cp($datos, "orders", ""); 

    // var_dump($error);

    $to_return = null;

	if ($error['status'] == "updated") {
		$to_return = [ "success" => true ];
	}else {
		$to_return = [ "success" => false, "error" => $error ];
	}    

    echo json_encode($to_return);
?>