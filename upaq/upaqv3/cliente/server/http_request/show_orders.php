<?php	
	require '../config/config.php';    
    
    $response = [];
    $id = $_SESSION['id'];
    
    $response['orders'] = get_records_db('orders', "user = $id");   
        
    foreach ($response['orders'] as $dato){ $response['id'] = $dato['id']; };

    echo json_encode($response);
?>