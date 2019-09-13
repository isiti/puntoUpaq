<?php	
	require '../config/config.php';    
    
    $response = [];            
    if($_GET['mode'] == 'dow'){ $response['orders'] = get_records_db('dow', "id = ".$_GET['id']); }         
    
    if($_GET['mode'] == 'upaq'){ 
        $response['orders'] = get_records_db('orders', "id = ".$_GET['id']); 
        foreach ($response['orders'] as $value) {
            $response['users'] = get_records_db('users', "id = ".$value['user']); 
        }
    }
    
    echo json_encode($response);
?>