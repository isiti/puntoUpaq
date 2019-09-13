<?php	
	require '../config/config.php';    
    
    $response = [];    
    $response = get_records_db('users', "type='cadete'");
    echo json_encode($response);
?>