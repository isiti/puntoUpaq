<?php
	require("../includes/config.php");
    session_start();

    $id_user = $_SESSION['id'];

    $travel_status = get_records_db("travel_logs","id_users = ".$id_user." AND id_users_driver != 0 AND id_users_driver != -1 AND amount = 0 AND status != 'cancelado' AND status != 'completado' AND status != 'prueba'");

    if (!empty($travel_status)) {
        $response['tomado'] = 'si';
        foreach ($travel_status as $key => $value) {
            $response['id_viaje'] = $value['id'];
        }
    } else {
        $response['tomado'] = 'no';
    }
    
    echo json_encode($response);
    
?>