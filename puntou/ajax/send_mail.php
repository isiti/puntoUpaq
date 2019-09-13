<?php 

session_start();
include "../includes/config.php";

$id_viaje = $_POST['travel_id'];
$dir_firma = $_POST['dir_firma'];

if (isset($id_viaje)) {

    $data_viaje = get_records_db('travel_logs', 'id = '.$id_viaje, 1);

	$from_mail = "info@nexosmart.com.ar";
	$user_name = get_db_row($data_viaje[0]['id_users'], 'fullname', 'users');
	$driver_name = get_db_row($data_viaje[0]['id_users_driver'], 'fullname', 'users');
	$date = $data_viaje[0]['travel_date'];
	$time = $data_viaje[0]['travel_time'];
	$from_address = $data_viaje[0]['from_address'];
	$to_address = $data_viaje[0]['to_address'];
	$amount = $data_viaje[0]['amount'];
	

	$email = "briankette@gmail.com";
	$cuerpo = "<style>
				* { padding: 0; margin: 0 }
				p {padding: 3px 10px; }
				 </style>";
	$cuerpo .= "<div style='text-align:center; padding: 20px 0; width: 100%; background: #1952a8;'><img src='https://www.nexosmart.com.ar/clientes/puntou/img/login_logo.gif' style='margin: 0 auto;' height='60' /></div>";
	$cuerpo .= "<div style='height:5px; background:#424242; width:100%'></div>";
	$cuerpo .= "<div style='clear:both;'></div><br />";
	$cuerpo .= "<div id='mc-total' style='padding-left:10px;'>";

	setlocale(LC_TIME,"es_ES");

	$asunto = "Datalle de viaje";
	$cuerpo .= "<p>".ucwords(strftime("%A %d de %B del %Y"))."</p><br />";
	$cuerpo .= "<div style='color:#1952a8;'>Datos del viaje:</div>";
	$cuerpo .= "<div style='clear:both;'></div><br />";
	$cuerpo .= "<p><strong>Fecha y hora del viaje: </strong>".$date." - ".$time."</p>";
	$cuerpo .= "<p><strong>Pasajero: </strong>".$user_name."</p>";
	$cuerpo .= "<p><strong>Chofer: </strong>".$driver_name."</p>";
	$cuerpo .= "<p><strong>Dirección de partida: </strong>".$from_address."</p>";
	$cuerpo .= "<p><strong>Destino: </strong>".$to_address."</p>";
	$cuerpo .= "<p><strong>Monto del viaje: </strong>".$amount."</p>";
	$cuerpo .= "<img style='display:block' width='200' height='200' src='https://www.nexosmart.com.ar/clientes/puntou/signatures/".$dir_firma."' alt='firma'>";	
	$cuerpo .= "</div>";

	 
	$cabeceras = "MIME-Version: 1.0" . "\r\n" . "Content-type:text/html;charset=UTF-8" . "\r\n" . "From: $from_mail" . "\r\n";
	 
	if(mail($email,$asunto,$cuerpo,$cabeceras)){
		$respuesta['status'] = "mail enviado";
	}else{
		$respuesta['status'] = "mail no enviado";
	}
}

echo json_encode($respuesta);

?>