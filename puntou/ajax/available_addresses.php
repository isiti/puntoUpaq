<?php
//error_reporting(E_ALL); ini_set('display_startup_errors',1);ini_set('display_errors',1);
require("../includes/config.php");
//error_reporting(E_ALL); ini_set('display_startup_errors',1);ini_set('display_errors',1);
include('../cms/api/CoreFunctions.php');
//error_reporting(E_ALL); ini_set('display_startup_errors',1);ini_set('display_errors',1);
include('../cms/api/ConnectToDb.php');
//error_reporting(E_ALL); ini_set('display_startup_errors',1);ini_set('display_errors',1);
session_start();

$return = "";

$return.= '<li data-index="ua" data-alias="0"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">Ubicación Actual</span></li>';

if ($_SESSION['alias_asociado'] != NULL)
{
	$point_alias 			= $_SESSION['alias_asociado'];
	$point_username 		= "puntou_test0004";

	$ini = ini_set('soap.wsdl_cache_enabled','0');

	$parametros = array();
	$parametros['usuario'] 		= $point_username;
	$parametros['alias']   		= $point_alias;
	$parametros['control'] 		= $WebService->control;

	$WS = new SoapClient($WebService->url, $parametros);
	$result = $WS->ObtenerDireccionDeAliasSimilares($parametros);
	//$response['api'] = $result;
	//var_dump($result);

	$aliases = json_decode(json_encode($result->ObtenerDireccionDeAliasSimilaresResult->ALIAS, true));
	//var_dump($aliases->Direccion);
	if ($aliases->Direccion != NULL)
	{
		if (!empty($aliases->Direccion))
		//$return.='<option data-id="'.$aliases->IdAlias.'" data-address="'.$aliases->Direccion.'" data-note="'.$aliases->Comentario.' - '.$aliases->Anexo.'" class="li-alias" style="list-style-type: none;background: white;padding: 4px;z-index: 10;cursor:pointer;" value="'.$aliases->Direccion.'"><span>'.$aliases->Direccion.'</span></option>';
			$return.= '<li data-index="add-'.$aliases->IdAlias.'" data-alias="'.$aliases->IdAlias.'"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$aliases->Direccion.'</span></li>';
	}
	else
	foreach ($aliases as $key => $value) {
		$elemento = json_decode(json_encode($value, true));
		//var_dump($elemento);
		//var_dump($elemento->IdAlias);
		//echo "espacio";
		//var_dump($elemento[0]);
		if (!empty($elemento->Direccion))
		//$return.='<option data-id="'.$elemento->IdAlias.'" data-address="'.$elemento->Direccion.'" data-note="'.$elemento->Comentario.' - '.$elemento->Anexo.'" class="li-alias" style="list-style-type: none;background: white;padding: 4px;z-index: 10;cursor:pointer;" value="'.$elemento->Direccion.'"><span>'.$elemento->Direccion.'</span></option>';
			$return.= '<li data-index="add-'.$elemento->IdAlias.'" data-alias="'.$elemento->IdAlias.'"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$elemento->Direccion.'</span></li>';
	}

	$point_alias 			= $_SESSION['alias_empresa'];
	
	//$parametros = array();
	$parametros['alias']   		= $point_alias;
	
	$WS = new SoapClient($WebService->url, $parametros);
	$result = $WS->ObtenerDireccionDeAliasSimilares($parametros);
	
	//var_dump($result);

	$aliases = json_decode(json_encode($result->ObtenerDireccionDeAliasSimilaresResult->ALIAS, true));

	//var_dump($aliases);
	
	if ($aliases->Direccion != NULL)
	{
		if (!empty($aliases->Direccion))
			$return.= '<li data-index="add-'.$aliases->IdAlias.'" data-alias="'.$aliases->IdAlias.'"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$aliases->Direccion.'</span></li>';
	}
	else
	foreach ($aliases as $key => $value) {
		$elemento = json_decode(json_encode($value, true));
		if (!empty($elemento->Direccion))
			$return.= '<li data-index="add-'.$elemento->IdAlias.'" data-alias="'.$elemento->IdAlias.'"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$elemento->Direccion.'</span></li>';
	}
}

echo $return;
return;
?>