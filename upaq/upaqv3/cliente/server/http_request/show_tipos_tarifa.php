<?php	
	require '../config/config.php';    
    
    $response = [];        
    $response['tarifas'] = get_records_db('tarifas', "");   
        
    foreach ($response['tarifas'] as $dato){ 
        $response['tipo'] = $dato['tipo']; 
        $response['monto'] = $dato['monto']; 
    };

    echo json_encode($response);
?>