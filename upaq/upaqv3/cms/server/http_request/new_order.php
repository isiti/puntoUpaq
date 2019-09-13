<?php

require "../config/config.php";
    
    $to_return = null;
    $_POST['user'] = $_SESSION['id'];
    $_POST['cadete'] = 0;
    $_POST['active'] = 'y';
    $_POST['submit'] = "submit";


    // obtengo las coordenadas
    require('coordinates.php');
    
    if($_POST['tablaDb'] == 'orders'){        

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
    }
    
    if($_POST['tablaDb'] == 'dow'){

        $datos = [
            ["value" => "origen", "required" => 1],
            ["value" => "destino", "required" => 1],
            ["value" => "n_solicitante", "required" => 1],
            ["value" => "solicitante", "required" => 1],
            ["value" => "tipo", "required" => 1],
            ["value" => "aprobador", "required" => 1],
            ["value" => "prioridad", "required" => 1],
            ["value" => "proveedor", "required" => 1],
            ["value" => "contacto", "required" => 1],
            ["value" => "detalle", "required" => 1],  
            ["value" => "lat_origen", "required" => 1],
            ["value" => "long_origen", "required" => 1],
            ["value" => "lat_destino", "required" => 1],
            ["value" => "long_destino", "required" => 1]  
        ];   

        $error = get_form_cp($datos, "dow", "");
    }


    ($error['status'] == "added") ? $to_return = [ "success" => true, "data" => $datos ] : $to_return = [ "success" => false, "error" => $error ];
       

    echo json_encode($to_return);

?>