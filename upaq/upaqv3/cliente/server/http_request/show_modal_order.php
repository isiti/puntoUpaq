<?php	
	require '../config/config.php';    
    
    $response = [];
    $id = $_GET['id'];    

    $orders = get_records_db('orders', "id = $id");   
    
    foreach ($orders as $dato){
        $response['id'] = $dato['id'];
        $response['origen'] = $dato['origen'];
        $response['depto_origen'] = $dato['depto_origen'];
        $response['destino'] = $dato['destino'];
        $response['depto_destino'] = $dato['depto_destino'];
        $response['tipo'] = $dato['tipo'];
        $response['destinatario'] = $dato['destinatario'];
        $response['descripcion'] = $dato['descripcion'];
        $response['user'] = $dato['user'];
        $response['cadete'] = $dato['cadete'];
        $id_cadete = $dato['cadete'];
        $response['status'] = $dato['status'];
        $response['fModificacion'] = $dato['fModificacion'];
    };
    
    $cadete = get_records_db('users', "id = $id_cadete");
    
    foreach ($cadete as $info){
        $response['name_cadete'] = $info['name'];
        $response['lastname_cadete'] = $info['lastname'];
        $response['email_cadete'] = $info['email'];
        $response['phone_cadete'] = $info['phone'];        
    };

    echo json_encode($response);
?>