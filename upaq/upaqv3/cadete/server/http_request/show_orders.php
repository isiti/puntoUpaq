<?php	
	require '../config/config.php';    

    $response = [];             
    
    if($_GET['flag'] == 'my_orders'){        
        $response['orders'] = get_records_db('orders', "cadete = ".$_SESSION['id']); 
        $response['dow'] = get_records_db('dow', "cadete = ".$_SESSION['id']); 
    } else {
        $response['orders'] = get_records_db('orders', "status = 'sin_iniciar' AND active='y' AND validado='y'");
        $response['dow'] = get_records_db('dow', "status = 'sin_iniciar' AND active='y' AND validado='y'"); 
    }

        
    foreach ($response['orders'] as $dato){ $response['id_orders'] = $dato['id']; };    
    foreach ($response['dow'] as $dato){ $response['id_dow'] = $dato['id']; };    

    echo json_encode($response);
?>