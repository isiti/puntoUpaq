<?php

set_time_limit(60);
include('CoreFunctions.php');

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

	if (!isset($comment)) $comment = '-';
	if (!isset($anexo)) $anexo = '-';

	$ini = ini_set('soap.wsdl_cache_enabled','0');

	$parametros = array();

	if ($alias_id == 0)
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
	//var_dump($parametros);

	$WS = new SoapClient($WebService->url, $parametros);
	
	if ($alias_id == 0)	$result = $WS->SolicitarViaje_corporativo($parametros);
	else $result = $WS->SolicitarViajePorAlias_ID($parametros);
	$response['api'] = $result;

	// Change status and SET ID on DB
	if ($alias_id == 0) $travel_id = (int) $response['api']->SolicitarViaje_corporativoResult->IdPedido;
	else $travel_id = (int) $response['api']->SolicitarViajePorAlias_IdResult->IdPedido;
	//var_dump($response['api']);
	$response['travel_id'] = $travel_id;
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