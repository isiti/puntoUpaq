<?php
require("../includes/config.php");
session_start();

if (!empty($_POST)) {

    $amount = get_db_row($_POST['travel_id'], "amount", "travel_logs");

    if ($amount > 0) {
       $data['viaje_finalizado'] = 'si';
    } else {
        $data['viaje_finalizado'] = 'error';
    }

    $status = get_db_row($_POST['travel_id'], "status", "travel_logs");

    if ($status == "cancelado") {
        $data['cancelado'] = "si";
    } else {
        $data['cancelado'] = "no";
    }
}

echo json_encode($data);
?>