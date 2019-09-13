<?php	
	require '../config/config.php';    
    
    $status = $_GET['status'];
    $table = $_GET['table'];

    if($status == 'en_proceso'){
        $response = count(get_records_db("$table", "status='aceptado' OR status='buscando' OR status='entregando'"));     
    }else{
        $response = count(get_records_db("$table", "status='$status'"));         
    }

    echo json_encode($response);
?>