<?php	
    require '../config/config.php';  
    
    debug_errors();          
    $response = [];          
    $cadete = [];
    $to_return = [];

    if($_GET['tabla'] == 'dow') { $response = get_records_db("dow", "id=".$_GET['id']); }
    if($_GET['tabla'] == 'orders') { $response = get_records_db("orders", "id=".$_GET['id']); }


    foreach($response as $user){      
        if($user['cadete'] != '0' || $user['status'] != 'sin_iniciar'){ 
            $cadete = get_records_db("users", "id=".$user['cadete']); 
        } else { 
            $cadete = ''; 
        }
    }

    $to_return = [
        "orders" => $response,
        "cadete" => $cadete
    ];

    echo json_encode($to_return);
?>