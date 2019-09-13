<?php	
	require '../config/config.php';    
    
    $response = [];    
    $response = get_records_db('users', "type='user'");
    echo json_encode($response);
?>