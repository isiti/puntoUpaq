<?php
require("../includes/config.php");
session_start();

/**
 * Optimized algorithm from http://www.codexworld.com
 *
 * @param float $latitudeFrom
 * @param float $longitudeFrom
 * @param float $latitudeTo
 * @param float $longitudeTo
 *
 * @return float [km]
 */
function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
{
    $rad = M_PI / 180;
    //Calculate distance from latitude and longitude
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin($latitudeFrom * $rad) 
        * sin($latitudeTo * $rad) +  cos($latitudeFrom * $rad)
        * cos($latitudeTo * $rad) * cos($theta * $rad);

    return acos($dist) / $rad * 60 *  1.853;
}

$data = array();
$data['afuera'] = 'no';

if (!empty($_POST)) {

    //Recibo por POST el id del viaje. Con eso, busco la ultima posicion del chofer, y calculo la distancia. Si la distancia es menor a 100 metros, entonces "esta llegando"

    $id_viaje = $_POST['travel_id'];

    $viaje = get_records_db("travel_logs", "id = ".$id_viaje);

    $viaje = $viaje[0];

    $conductor = $viaje['id_users_driver'];

    //

    $ultima_posicion = get_records_db("travel_coordenadas","id_travel=".$id_viaje." AND id_user=".$conductor,1,"DESC","id");
    //var_dump($ultima_posicion);
    $ultima_posicion = $ultima_posicion[0];

    //

    if (!empty($viaje['lat_from']) && !empty($viaje['long_from']) && $viaje['lat_from']!="" && $viaje['long_from']!="" && $viaje['lat_from']!=0 && $viaje['long_from']!=0 && $viaje['lat_from']!="0" && $viaje['long_from']!="0")
    {
    	if (!empty($ultima_posicion) && $ultima_posicion['lat'] != 0 && $ultima_posicion['lat'] != "" && $ultima_posicion['lng'] != 0 && $ultima_posicion['lng'] != "")
    	{
    		//Parece que anda todo bien
    		$data['status'] = "Datos Correctos";

    		$distancia = getDistance((float)$viaje['lat_from'],(float)$viaje['long_from'],(float)$ultima_posicion['lat'],(float)$ultima_posicion['lng']);
    		//Devuelve la distancia en kilometros
    		if ($distancia <= 0.1 )
    		{
    			$data['afuera'] = "si";
    		}
    		$data['distancia'] = $distancia;
    	}
    	else
    	{
    		$data['status'] = "No se puede encontrar la posicion del chofer";
    		//var_dump($ultima_posicion);
    	}
    }
    else
    {
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

	    if ($lati != 0 && $longi != 0)
	    {
	    	$sql = "UPDATE travel_logs SET lat_from = '$lati', long_from = '$longi' WHERE id = $id_viaje";
	    	$consulta = mysqli_query($dbConn,$sql);
	    	$data['status'] = "Direccion Actualizada";
	    }
	    else
	    {
	    	$data['status'] = "No se pudo conseguir la direccion";
	    }	    
	}  
	
	$status = get_db_row($_POST['travel_id'], "status", "travel_logs");

    if ($status == "cancelado") {
        $data['cancelado'] = "si";
    } else {
        $data['cancelado'] = "no";
    }
}

$data['distancia'] = 0.01;
$data['afuera'] = "si";

echo json_encode($data);
?>