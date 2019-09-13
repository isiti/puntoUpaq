<?php	
	require '../config/config.php';    
    
    $response = [];    
    $id = $_GET['id'];    
    $response = get_records_db('tarifas', "id=$id");
    
    echo json_encode($response);
?>