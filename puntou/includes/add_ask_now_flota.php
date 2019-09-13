<?php
	require("config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	if (!empty($_POST))
	{
		$datos = [
			['value'=>'applicant'],
			['value'=>'applicant_company'],
			['value'=>'id_users','type'=>'number'],
			['value'=>'id_dac','type'=>'number'],
			['value'=>'travel_date'],
			['value'=>'travel_time'],
			['value'=>'travel_type'],
			['value'=>'from_address'],
			['value'=>'to_address'],
			['value'=>'id_users_driver','type'=>'number'],
			['value'=>'amount','type'=>'number'],
			['value'=>'duration','type'=>'number'],
			['value'=>'status'],
			['value'=>'minutos_anticipacion'],
			['value'=>'message'],
			['value'=>'alias_id'],
			['value'=>'observations_general']
		];

		array_push($datos, ['value'=>'status_dac']);

		$_POST['id_users'] = (int)$_SESSION['id'];
		
		//ID_DAC

		$_POST['id_dac'] = -1;

		$_POST['applicant'] = $_SESSION['fullname'];
		$_POST['applicant_company'] = $_SESSION['fullname'];

		//$_POST['alias_id'] = 0;
		$_POST['alias_id'] = 0;
		
		//date
		
		$_POST['travel_date'] = date("Y-m-d");
		$_POST['travel_time'] = date("H:i");
		$_POST['minutos_anticipacion'] = 0;
		
		$_POST['travel_type'] = 10;

		$_POST['from_address'] = $_POST['ubicacion_actual'];
		$_POST['to_address'] = $_POST['adonde_vas'];

		//id_users_driver
		$_POST['id_users_driver'] = -1;

		//Amount

		$_POST['amount'] = -1;

		//Duration

		$_POST['duration'] = -1;

		//Observations
		$_POST['observations'] = "-";

		$_POST['status_dac'] = 96;

		$_POST['minutos_anticipacion'] = 10;

		$_POST['message'] = $_SESSION['mensaje_pred'];

		$_POST['observations_general'] = "-";

		$string = $_POST['ubicacion_actual'];

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
		
		//Status

		$_POST['status'] = 'agendado';

		$hora_mostrar = "P/ ".str_replace(" ","",$_POST['hora']);

		$sql = "INSERT INTO `travel_logs` (`applicant`, `applicant_company`, `id_users`, `alias_id`, `id_dac`, `travel_date`, `travel_time`, `minutos_anticipacion`, `travel_type`, `from_address`, `lat_from`, `long_from` ,`from_address_2`, `from_address_3`, `to_address`, `to_address_2`, `to_address_3`, `id_users_driver`, `amount`, `duration`, `observations`, `observations_2`, `observations_3`, `observations_general`, `message`, `status_dac`, `status`, `by_app`, `is_cc` , `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('', '', '".$_SESSION['id']."', ".$_POST['alias'].", 0, '".$_POST['travel_date']."', '".$_POST['travel_time']."', 0, 0, '".$_POST['from_address']."','".$lati."','".$longi."' ,  '', '', '".$_POST['to_address']."', '', '', 0, 0, 0, '', '', '', '".$_POST['comentario']."', '(APP) ".$_POST['message']."', 71, 'inmediato', 1, 1, '".$_SESSION['id']."', NOW(), NOW(), '".$_SESSION['id']."', 'activo')";
		if (!empty($_POST)) {
			
			$result = mysqli_query($dbConn, $sql);
			$id_viaje = mysqli_insert_id($dbConn);

			$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$id_viaje."', 'agendado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
			$result = mysqli_query($dbConn, $sql);

			 $response['id'] = $id_viaje;
		}	
	}

    echo json_encode($response);
?>