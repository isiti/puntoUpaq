<?php
    require("../includes/config.php");
    session_start();

    $response['status'] = "ok";

    $movil = $_SESSION['username'];

    $choferes = get_records_db('movil_to_chofer', 'numero_movil = '.$movil);
    
    $num_chferes = count($choferes);

    $content = "";

    if ($num_chferes > 1) {
        $response['cant_chofer'] = "varios";
        for ($i=0; $i < $num_chferes; $i++) { 
            $nombre_chofer = $choferes[$i]['nombre_chofer'];

            $content .= '<option value="'.$nombre_chofer.'">'.$nombre_chofer.'</option>';

            $response['cant_chofer'] = "varios";

            $response['content'] = $content;
        }        
    } else {
        $response['cant_chofer'] = "unico";
    }


    echo json_encode($response);
?>