<?php
    require "../config/config.php";

    $_POST['submit'] = "submit";
    $_POST['user'] = $_SESSION['id'];
    $_POST['cadete'] = 0;
    $_POST['active'] = 1;

    // obtengo las coordenadas
    require('coordinates.php');

    $datos = [
        ["value" => "origen", "required" => 1, "custom" => "Error, debe ingresar un nombre"],
        ["value" => "depto_origen"],
        ["value" => "destino", "required" => 1, "custom" => "Error, debe ingresar un email"],
        ["value" => "depto_destino"],
        ["value" => "tipo", "required" => 1, "custom" => "Error, debe ingresar un numero de Teléfono"],
        ["value" => "destinatario", "required" => 1, "custom" => ""],
        ["value" => "descripcion", "required" => 1, "custom" => ""],
        ["value" => "user", "required" => 1, "custom" => ""],
        ["value" => "cadete", "required" => 1, "custom" => ""],
        ["value" => "lat_origen", "required" => 1, "custom" => ""],
        ["value" => "long_origen", "required" => 1, "custom" => ""],
        ["value" => "lat_destino", "required" => 1, "custom" => ""],
        ["value" => "long_destino", "required" => 1, "custom" => ""],

    ];

    $error = get_form_cp($datos, "orders", "");
    
    // $id_order = mysqli_insert_id($dbConn);
    // var_dump($id_order);

    // var_dump($error);

    $to_return = null;

	if ($error['status'] == "added") {
		$to_return = [ "success" => true ];
	}else {
		$to_return = [ "success" => false, "error" => $error ];
	}    

    echo json_encode($to_return);
?>