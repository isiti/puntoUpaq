<?php 
session_start();
include "../includes/config.php";

$id_user = (int)$_SESSION['id'];
$resultado;
$resultado['status'] = 'ok';

if (!empty($_POST))
{
	$id_viaje = $_POST['id_viaje'];//Viaje en la tabla
	$id_dac = $_POST['id_dac'];//ID Dac

	//Tengo que traer los datos del dac, y llenarlos en la base de datos.

	include('../cms/api/CoreFunctions.php');

	$response = array('error' => true, 'msg' => '');

	$_POST['point_username'] = "puntou_test0004";
	$_POST['id'] = 40;
	$_POST['travel_id'] = $id_dac;

	if (isset($_POST['point_username']) && isset($id_dac) && isset($_POST['id'])){
		include('../cms/api/ConnectToDb.php');

		$point_username = $_POST['point_username'];
		$travel_id 		= (int) $_POST['travel_id'];
		$id 			= (int) $_POST['id'];

		$ini = ini_set('soap.wsdl_cache_enabled','0');

		$parametros = array();
		$parametros['usuario'] 		= $point_username;
		$parametros['id'] 			= $travel_id;
		$parametros['control'] 		= $WebService->control;

		$WS = new SoapClient($WebService->url, $parametros);
		$result = $WS->ObtenerPedidoXId($parametros);

		//var_dump($result);
		
		$response['api'] = $result->ObtenerPedidoXIdResult;
		
		//$date = $result->ObtenerPedidoXIdResult->HoraAceptado;

		$amount = $result->ObtenerPedidoXIdResult->Importe;

		$alias_viaje = get_db_row($id_viaje, "alias_id", "travel_logs");

		if ($alias_viaje != NULL && isset($alias_viaje) && ($alias_id != 0 || $alias_viaje != '0'))
		{
			$sql_fijo = "SELECT price FROM travel_fixed_prices WHERE alias_id = $alias_viaje";
			$result_fixed = mysqli_query($dbConn, $sql_fijo);
			if ($result_fixed->num_rows > 0)
			{
				$price = mysqli_fetch_assoc($result_fixed);
				$amount = $price['price'];
			}	
		}

		$firma = get_records_db("logs_signatures","id_travel_logs=".$id_viaje);
		$firma = $firma[0];

		if (isset($firma) && $firma != NULL && isset($firma['url_signature']) && $firma['url_signature'] != '' && $firma['url_signature'] != NULL)
		{
			$sql = "UPDATE travel_logs SET amount = ".str_replace(",", ".", $amount).", status_dac = 6, status = 'completado' WHERE id = ".$id_viaje;
			//echo $sql;
			$result_up = mysqli_query($dbConn,$sql);
			$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$id_viaje."', 'completado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
			$result = mysqli_query($dbConn, $sql);
		}
		else
		{
			$sql = "UPDATE travel_logs SET amount = ".str_replace(",", ".", $amount).", status_dac = 7, status = 'pendiente' WHERE id = ".$id_viaje;
			//echo $sql;
			$result_up = mysqli_query($dbConn,$sql);
			$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$id_viaje."', 'pendiente', NOW(), '1', NOW(), NOW(), 1, 'activo')";
			$result = mysqli_query($dbConn, $sql);
		}

		
	}
	else
	{
		$resultado['status'] = 'nook';
	}
}
else
{
	$resultado['status'] = 'nook';
}

echo json_encode($resultado);

?>
