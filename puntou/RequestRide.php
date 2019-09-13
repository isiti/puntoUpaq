<?php
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
set_time_limit(60);

include('CoreFunctions.php');
include('"../includes/config.php"');

$response = array('error' => true, 'msg' => '');

/*$_POST['point_name'] = "Remis Universitario";
$_POST['point_username'] = "puntou_test0004";
$_POST['point_address_name'] = "Sarmiento";
$_POST['point_address_number'] = "201";
$_POST['passenger'] = "nombre pasajero";
$_POST['id'] = 40;*/
//var_dump($_POST);
if (!isset($minutos)) $minutos = 30;


if (isset($_POST['point_name']) && isset($_POST['point_username']) && isset($_POST['point_address_name']) && isset($_POST['point_address_number']) && isset($_POST['passenger']) && isset($_POST['id'])){
	include('ConnectToDb.php');

	$point_name 			= $_POST['point_name'];
	$point_username 		= $_POST['point_username'];
	$point_address_name 	= $_POST['point_address_name'];
	$point_address_number   = $_POST['point_address_number'];
	$passenger 				= $_POST['passenger'];
	$alias_id				= (int) $_POST['alias_id'];
	$id 					= (int) $_POST['id'];

	// is_cc
	$is_cc = get_db_row($id_viaje, 'is_cc', 'travel_logs');
	$respuesta['is_cc'] = $is_cc;
	var_dump("cc: ".$is_cc);

	if (!isset($comment)) $comment = '-';
	if (!isset($anexo)) $anexo = '-';

	$ini = ini_set('soap.wsdl_cache_enabled','0');

	$parametros = array();

	if ($alias_id == 0 || ($alias_id != 0 && $is_cc == 1))
	{
		$parametros['usuario'] 		= $point_username;
		$parametros['calle']   		= $point_address_name;
		$parametros['altura']  		= $point_address_number;
		$parametros['comentario'] 	= $comment;
		$parametros['anexo']		= $anexo;
		$parametros['visible'] 		= 'false';
		$parametros['minutos'] 		= $minutos;
		$parametros['control'] 		= $WebService->control;
	}
	else
	{
		$parametros['usuario'] 		= $point_username;
		$parametros['id']  			= $alias_id;
		$parametros['comentario'] 	= $comment;
		$parametros['anexo']		= $anexo;
		$parametros['visible'] 		= 'false';
		$parametros['minutos'] 		= $minutos;
		$parametros['control'] 		= $WebService->control;
	}
	//echo "<br>Params:<br>";
	var_dump("parametros: ".$parametros);

	$WS = new SoapClient($WebService->url, $parametros);


	if ($alias_id != 0 && $is_cc == 1)
	{
		$result = $WS->SolicitarViaje($parametros);
		var_dump("cc");
	}
	elseif ($alias_id == 0 && $is_cc == 0)
	{
		$result = $WS->SolicitarViaje_corporativo($parametros);
		var_dump("corp.");
	}
	else
	{
		$result = $WS->SolicitarViajePorAlias_ID($parametros); // ???
		var_dump("alias");
	}
	$response['api'] = $result;

	var_dump("resultado: ".$result);

	// Change status and SET ID on DB (si es cc)
	if ($alias_id != 0 && $is_cc == 1) $travel_id = (int) $response['api']->SolicitarViajeResult->IdPedido;
	else $travel_id = (int) $response['api']->SolicitarViajePorAlias_IdResult->IdPedido;
	$response['travel_id'] = $travel_id;
	var_dump("travel_id: ".$travel_id);

	// Change status and SET ID on DB (si es corporativo)
	if ($alias_id == 0) $travel_id = (int) $response['api']->SolicitarViaje_corporativoResult->IdPedido;
	else $travel_id = (int) $response['api']->SolicitarViajePorAlias_IdResult->IdPedido;
	//var_dump($response['api']);
	$response['travel_id'] = $travel_id;
	var_dump("travel_id: ".$travel_id);
	//$response

	/*if ($travel_id != 0){
		$update = $mysqli->query("UPDATE travels SET travel_id=$travel_id, status=3 WHERE ID=$id");
		if ($update)
			$response['error'] = false;
	}
	else {
		$response['msg'] = 'La API no respondió';
	}*/
	//($result);
	//var_dump($response);

}
else {
	$response['msg'] = 'Faltan datos';
}

echo json_encode($response);

?>
