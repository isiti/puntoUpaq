<?php
    require "../config/config.php";

    //$datos = [
        //    ["value" => "delivery", "required" => 1, "custom" => ""],
        //    ["value" => "mudanza", "required" => 1, "custom" => ""],
        //    ["value" => "bultog", "required" => 1, "custom" => ""],
        //    ["value" => "bultopm", "required" => 1, "custom" => ""],
        //    ["value" => "paqueteg", "required" => 1, "custom" => ""],
        //    ["value" => "paquetemp", "required" => 1, "custom" => ""],
        //    ["value" => "tramite", "required" => 1, "custom" => ""],
        //    ["value" => "sobre", "required" => 1, "custom" => ""],
        //];

    $_POST['submit_edit'] = "submit_edit";

    $datos = [
        ["value" => "monto", "required" => 1, "custom" => ""],
    ];

    // MODIFICO PARA SOBRE
    $_POST['id'] = 1;
    $_POST['monto'] = $_POST['sobre'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA TRAMITE
    $_POST['id'] = 2;
    $_POST['monto'] = $_POST['tramite'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA PAQUETE MEDIANNO/PEQUEÑO
    $_POST['id'] = 3;
    $_POST['monto'] = $_POST['paquetemp'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA PAQUETE GRANDE
    $_POST['id'] = 4;
    $_POST['monto'] = $_POST['paqueteg'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA BULTO MEDIANNO/PEQUEÑO
    $_POST['id'] = 5;
    $_POST['monto'] = $_POST['bultopm'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA BULTO GRANDE
    $_POST['id'] = 6;
    $_POST['monto'] = $_POST['bultog'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA MUDANZA
    $_POST['id'] = 7;
    $_POST['monto'] = $_POST['mudanza'];

    $error = get_form_cp($datos, "tarifas", "");

    // MODIFICO PARA DELIVERY
    $_POST['id'] = 8;
    $_POST['monto'] = $_POST['delivery'];

    $error = get_form_cp($datos, "tarifas", "");
    
    // $id_order = mysqli_insert_id($dbConn);
    // var_dump($id_order);

    // var_dump($error);

    $to_return = null;

	if ($error['status'] == "updated") {
		$to_return = [ "success" => true ];
	}else {
		$to_return = [ "success" => false, "error" => $error ];
	}    

    echo json_encode($to_return);
?>