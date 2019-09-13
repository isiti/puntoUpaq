<?php	
	require '../config/config.php';    
        
    $response = [];    

    if($_GET['tablaDb'] == 'dow') { $response = get_records_db("dow", "active = 'y'"); }
    if($_GET['tablaDb'] == 'orders') { $response = get_records_db("orders", "active = 'y'"); }

    echo json_encode($response);
?>