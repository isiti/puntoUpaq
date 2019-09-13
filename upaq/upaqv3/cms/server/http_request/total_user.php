<?php	
	require '../config/config.php';    
    
    $type = $_GET['type'];
    $response = count(get_records_db('users', "type='$type'")); 

    echo json_encode($response);
?>