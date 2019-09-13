<?php 
session_start();
include "../includes/config.php";

$detalles_viaje = array();
$detalles_viaje['status'] = "NO_ES_DRIVER";

if ($_SESSION['is_driver'])
{
	$id_user = (int)$_SESSION['id'];

	//Me fijo si hay un viaje para mi movil

	$numero_de_movil = get_records_db("movil_to_chofer", "id_user = ".$id_user);

	$numero_de_movil = $numero_de_movil[0];

	$num = (int)$numero_de_movil['numero_movil'];

	$sql = " SELECT * FROM travel_logs WHERE id_users_driver = $num AND (status LIKE 'inmediato' OR status LIKE 'agendado' OR status = 'reservado' OR status = 'en_progreso' OR status = 'prueba') "; //'%$id_user%'
	$db_viajes = mysqli_query($dbConn, $sql);
	$detalles_viaje = array();

	if( ($db_viajes->num_rows)>0 ) {
		
		$viaje = mysqli_fetch_assoc($db_viajes);
		$detalles_viaje['travel_id'] = $viaje['id'];
		$detalles_viaje['id_dac'] = $viaje['id_dac'];
		$detalles_viaje['direccion_origen'] = $viaje['from_address'];
		$detalles_viaje['direccion_destino'] = $viaje['to_address'];
		$detalles_viaje['observacion'] = $viaje['observations_general'];
		$detalles_viaje['mensaje'] = $viaje['message'];
		//$detalles_viaje['pasajero'] = 
		

		$string = $viaje['from_address'];

	    $string = trim($string);
	 
	    $string = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('n', 'N', 'c', 'C',),
	        $string
	    );

	    $string = $string.",Bahia Blanca, Buenos Aires, Argentina";
	    $address = rawurlencode(utf8_encode($string));
	    
	     
	    // google map geocode api url
	    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}"."&key=AIzaSyD-r6h1sqaeJCQDeDzD5t4m5nuFKM8NGBc";

	    $resp_json = file_get_contents($url);

	    // decode the json
	    $resp = json_decode($resp_json, true);

	    $lati = 0;
	    $longi = 0;
	 
	    // response status will be 'OK', if able to geocode given address
	    if($resp['status']=='OK'){
	 
	        // get the important data
	        $lati = $resp['results'][0]['geometry']['location']['lat'];
	        $longi = $resp['results'][0]['geometry']['location']['lng'];	         
	    }
	    else
	    {
	    	//var_dump($resp);
	    	//var_dump($address);
	    	//$response['error'] = "ERRORDIR";
	    }

	    $detalles_viaje['latitud_viaje'] = $lati;
	    $detalles_viaje['longitud_viaje'] = $longi;

	    $detalles_viaje['status'] = "NUEVO_VIAJE";

	    $sql = "UPDATE travel_logs SET id_users_driver = $id_user WHERE id = ".$viaje['id'];
	    $result_update = mysqli_query($dbConn, $sql);
	}
	else
	{
		$detalles_viaje['status'] = "SIN_VIAJES";
	}
}

echo json_encode($detalles_viaje);

?>
