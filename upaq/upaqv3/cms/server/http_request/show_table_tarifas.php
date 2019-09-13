<?php	
	require '../config/config.php';    
    
    $response = [];    
    $response = get_records_db('tarifas', "active=1");
    echo json_encode($response);
?>