<?php
	require 'includes/config.php';
	//error_reporting(-1);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	//Significado de los status_dac:

	/*
	*	0 = Viaje ingresado al sistema y sin confirmar (se debe confirmar desde el cms)
	*	1 = Viaje ingresado al sistema y confirmado (Se debe requerir el viaje con RequestRide)
	*	2 = Viaje requerido con RequestRide (Se debe confirmar)
	*	3 = Viaje confirmado (En espera a que el viaje se tome)
	*	4 = Viaje con Movil reservado (un numero de movil ya se dirige al lugar)
	*	5 = Viaje en curso (numero de movil existe y hora tambien, se espera a que se finalice)
	*	6 = Viaje finalizado correctamente
	*	97 = Viaje cancelado por falta de confirmacion (pasada la fecha, nunca fue confirmado)
	*	98 = Viaje marcado para cancelar
	*	99 = Viaje cancelado
	*/

	$table = "travel_logs";
	$condition = "categories = 'activo' AND status != 'cancelado' AND status != 'completado'";
	$viajes = get_records_db($table,$condition);

	echo "Cantidad de viajes : ".count($viajes)."<br><br>";

	//var_dump(date_default_timezone_get());

	//var_dump($viajes);

	foreach ($viajes as $key => $viaje) {
		//Para cada viaje, checkeo el status_dac, que me va a decir el estado actual con respecto a la api
		switch ($viaje['status_dac']){
			case 0:
				$minutos = round((strtotime($viaje['travel_date']." ".$viaje['travel_time']) - time()) / 60);

				if ($minutos <= 0)
				{
					//Nunca lo confirmo, y se paso la fecha del viaje, lo cancelo
					$sql = "UPDATE travel_logs SET status = 'cancelado', status_dac = 97 WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
					echo "El viaje se cancelo con minutos $minutos<br>";
					$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'cancelado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
					$result = mysqli_query($dbConn, $sql);
				}
			break;
			case 1:
				//Viaje ingresado al sistema (Se debe requerir el viaje con RequestRide)
				$direccion = trim($viaje['from_address']);

				$_POST['direccion'] = $direccion;
				$alias = $viaje['alias_id'];
				
				$dir = explode(' ', $direccion);
				$cant = count($dir);
				$direccion_del_viaje = "";
				$i = 0;
				while ($i < $cant-1) {
					if ($direccion_del_viaje == "") $direccion_del_viaje = $dir[$i];
					else $direccion_del_viaje .= " ".$dir[$i];
					$i++;
				}
				$numero_direccion = $dir[$cant-1];

				if (empty($numero_direccion)) $numero_direccion = 0;

				$_POST['cant'] = $cant;
				$_POST['dir'] = $dir;
				$_POST['point_name'] = $viaje['applicant_company'];
				$_POST['point_address_name'] = $direccion_del_viaje;
				$_POST['point_address_number'] = $numero_direccion;
				$_POST['passenger'] = $viaje['applicant'];
				$comment = $viaje['message'];//." ".$viaje['observations_general'];
				$anexo = /*$viaje['message']." ".*/$viaje['observations_general'];
				$_POST['alias_id'] = $viaje['alias_id'];


				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;
				$_POST['is_cc'] = $viaje['is_cc'];
				$minutos_anticipacion = (int) $viaje['minutos_anticipacion'];
				//Revisar zona horaria del servidor

				$minutos = round((strtotime($viaje['travel_date']." ".$viaje['travel_time']) - time()) / 60) - $minutos_anticipacion;

				//echo date(time());

				//echo date_default_timezone_get();
				//echo $minutos;
				//echo "<br>";
				//echo strtotime($viaje['travel_date']." ".$viaje['travel_time']);
				//echo "<br>";
				//echo time();

				if ($minutos <= 0)
				{
					//Nunca lo confirmo, y se paso la fecha del viaje, lo cancelo
					$sql = "UPDATE travel_logs SET status = 'cancelado', status_dac = 97 WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
					echo "El viaje se cancelo (2) con minutos $minutos y tiempo ".date_default_timezone_get()."<br>";
					$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'cancelado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
					$result = mysqli_query($dbConn, $sql);

				}
				else
				{
					require 'cms/api/RequestRide.php';

					if ($response['travel_id']!=0)
					{
						$sql = "UPDATE travel_logs SET status_dac = 2, id_dac = ".$response['travel_id']." WHERE id = ".$viaje['id'];
						$result = mysqli_query($dbConn, $sql);
					}
					else
					{
						echo "El viaje no se cancelo (3), pero vino con travel_id 0<br>";
						var_dump($response);
						echo "<br>";
					}
				}
			break;
			case 2:
				//Viaje requerido con RequestRide (Se debe confirmar)
				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;

				$_POST['travel_id'] = $viaje['id_dac'];

				require 'cms/api/ConfirmRide.php';

				if ($response['error']=='OK')
				{
					$sql = "UPDATE travel_logs SET status_dac = 3 WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					echo "El viaje no se confirmo (4)<br>";
					var_dump($response);
					echo "<br>";
				}
			break;
			case 3:
				//Viaje confirmado (En espera a que el viaje se tome)
				$_POST['travel_id'] = $viaje['id_dac'];
				echo "<br>Entro en viaje confirmado, espero check:<br>";

				if (!empty($_POST['travel_id']))
				{
					require 'cms/api/ObtenerPedidoXID.php';
					//isset($response['api']->NroMovil) && !empty($response['api']->NroMovil) && is_numeric($response['api']->NroMovil)
					//isset($response['api']->HoraAceptado) && !empty($response['api']->HoraAceptado)
					//var_dump($response['api']->HoraAceptado);
					if ($response['msg'] == "OK" && (isset($response['api']->HoraAceptado) && !empty($response['api']->HoraAceptado)) && ($response['viaje_aceptado'] == "SI"))
					{
						//echo "entre1";
						if (isset($response['api']->NroMovil) && !empty($response['api']->NroMovil) && is_numeric($response['api']->NroMovil))
						{
							$sql = "UPDATE travel_logs SET status_dac = 5, status = 'en_progreso', id_users_driver = '".$response['api']->NroMovil."' WHERE id = ".$viaje['id'];
							$result = mysqli_query($dbConn, $sql);
							echo "El viaje se ocupo bien con query $sql<br>";
							$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'en_progreso', NOW(), '1', NOW(), NOW(), 1, 'activo')";
							$result = mysqli_query($dbConn, $sql);
						}
						else
						{
							//echo "entre2";
							// $sql = "UPDATE travel_logs SET status_dac = 4, id_users_driver = '".$response['api']->NroMovil."' WHERE id = ".$viaje['id'];
							// $result = mysqli_query($dbConn, $sql);
							// echo "El viaje ya fue aceptado con query $sql<br>";
						}

						//El viaje fue aceptado, asi que mando la super notificacion

						$sql = "SELECT onesignal_player_id FROM users WHERE id = ".$response['api']->NroMovil;
						$resu = mysqli_query($dbConn, $sql);
						$user = mysqli_fetch_assoc($resu);
						$osid = $user['onesignal_player_id'];

						if (isset($osid) && !empty($osid))
				        {
				            $mensaje = "Tenes un nuevo viaje! Abri la aplicacion de PuntoU para verlo!";
				            $fields = array(
				                'app_id' => '3397c8d9-1d4c-44c6-9b66-c999b268f84f',
				                'include_player_ids' => [$osid],
				                'contents' => array("en" => $mensaje),
				                'headings' => array("en"=>"Nuevo viaje"),
				                'web_url' => "https://www.nexosmart.com.ar/clientes/puntou"
				                );

				            $fields = json_encode($fields);
				            //print("\nJSON sent:\n");
				            //print($fields);

				            $ch = curl_init();
				            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
				            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				                   'Authorization: Basic M2ZNDYtMjA4ZGM2ZmE5ZGFj'));
				                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				                   curl_setopt($ch, CURLOPT_HEADER, FALSE);
				                   curl_setopt($ch, CURLOPT_POST, TRUE);
				                   curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				                   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

				            $response = curl_exec($ch);
				            curl_close($ch);
				        }
					}
					else
					{
						//echo "entre3";
						//$response['msg'] == "OK" && (isset($response['api']->HoraAceptado) && !empty($response['api']->HoraAceptado)) && ($response['viaje_aceptado'] == "SI")
						if ($response['msg'] != "OK")
						{
							echo "entre3|1";
						}
						else if (!(isset($response['api']->HoraAceptado) && !empty($response['api']->HoraAceptado)))
						{
							echo "entre3|2";
						}
						else
						{
							var_dump($response['viaje_aceptado']);
							echo "entre3|3";
						}
						if (!isset($response['api']) || empty($response['api']))
						{
							//$sql = "UPDATE travel_logs SET status_dac = 99, status = 'cancelado' WHERE id = ".$viaje['id'];
							//$result = mysqli_query($dbConn, $sql);
							echo "La response vino vacia, te dejo el dump:<br>";
							var_dump($response);
						}
					}
				}
				else
				{
					echo "El viaje entro vacio, asi que no hago nada<br>";
				}

			break;
			case 4:
				//Viaje con Movil reservado (un numero de movil ya se dirige al lugar)
				$_POST['travel_id'] = $viaje['id_dac'];

				require 'cms/api/ObtenerPedidoXID.php';

				if (isset($response['api']->NroMovil) && !empty($response['api']->NroMovil) && is_numeric($response['api']->NroMovil))
				{
					if (isset($response['api']->HoraOcupadoMovil) && !empty($response['api']->HoraOcupadoMovil))
					{
						$sql = "UPDATE travel_logs SET status_dac = 5, status = 'en_progreso' WHERE id = ".$viaje['id'];
						$result = mysqli_query($dbConn, $sql);
						echo "El viaje se ocupo bien con query $sql<br>";
						$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'en_progreso', NOW(), '1', NOW(), NOW(), 1, 'activo')";
						$result = mysqli_query($dbConn, $sql);
					}
				}
			break;
			case 5:
				//Viaje en curso (numero de movil existe y hora tambien, se espera a que se finalice)
				$_POST['travel_id'] = $viaje['id_dac'];

				require 'cms/api/ObtenerPedidoXID.php';

				if (isset($response['api']->Importe) && floatval($response['api']->Importe) > 0)
				{
					$sql = "UPDATE travel_logs SET status_dac = 7, status = 'pendiente' WHERE id = ".$viaje['id'];
				 	$result = mysqli_query($dbConn, $sql);
				}

				// if (!isset($response['api']) || empty($response['api']) || $response['viaje_finalizado'] == "SI")
				// {
				// 	$sql = "UPDATE travel_logs SET status_dac = 6, status = 'completado' WHERE id = ".$viaje['id'];
				// 	$result = mysqli_query($dbConn, $sql);
				// }
			break;
			case 7:
				$firma = get_records_db("logs_signatures","id_travel_logs=".$viaje['id']);
				$firma = $firma[0];

				if (isset($firma) && $firma != NULL && isset($firma['url_signature']) && $firma['url_signature'] != '' && $firma['url_signature'] != NULL)
				{
					$sql = "UPDATE travel_logs SET status_dac = 6, status = 'completado' WHERE id = ".$viaje['id'];
				 	$result = mysqli_query($dbConn, $sql);
				 	$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'completado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
						$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					//var_dump($firma);
					var_dump($viaje['id']);
					var_dump(isset($firma));
					var_dump($firma != NULL);
					var_dump(isset($firma['url_signature']));
					var_dump($firma['url_signature'] != '');
				}
			break;
			case 72:
				//El viaje es desde la app, pero no se todavia si es corporativo o flota comun, asi que una vez que sea eso lo requesteo
				$direccion = trim($viaje['from_address']);

				$_POST['direccion'] = $direccion;
				$alias = $viaje['alias_id'];
				
				$dir = explode(' ', $direccion);
				$cant = count($dir);
				$direccion_del_viaje = "";
				$i = 0;
				while ($i < $cant-1) {
					if ($direccion_del_viaje == "") $direccion_del_viaje = $dir[$i];
					else $direccion_del_viaje .= " ".$dir[$i];
					$i++;
				}
				$numero_direccion = $dir[$cant-1];
				$numero_direccion = str_replace("N*", "", $numero_direccion);

				if (empty($numero_direccion)) $numero_direccion = 0;

				$_POST['cant'] = $cant;
				$_POST['dir'] = $dir;
				$_POST['point_name'] = $viaje['applicant_company'];
				$_POST['point_address_name'] = $direccion_del_viaje;
				$_POST['point_address_number'] = $numero_direccion;
				$_POST['passenger'] = $viaje['applicant'];
				$comment = $viaje['message'];//." ".$viaje['observations_general'];
				$anexo = /*$viaje['message']." ".*/$viaje['observations_general'];
				$_POST['alias_id'] = $viaje['alias_id'];


				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;
				$_POST['is_cc'] = $viaje['is_cc'];
				
				$minutos = 0;

				require 'cms/api/RequestRideFlota.php';

				if ($response['travel_id']!=0)
				{
					$sql = "UPDATE travel_logs SET status_dac = 2, id_dac = ".$response['travel_id']." WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					echo "El viaje no se cancelo (3), pero vino con travel_id 0<br>";
					var_dump($response);
					echo "<br>";
				}			
			break;
			case 74:
				$direccion = trim($viaje['from_address']);

				$_POST['direccion'] = $direccion;
				$alias = $viaje['alias_id'];
				
				$dir = explode(' ', $direccion);
				$cant = count($dir);
				$direccion_del_viaje = "";
				$i = 0;
				while ($i < $cant-1) {
					if ($direccion_del_viaje == "") $direccion_del_viaje = $dir[$i];
					else $direccion_del_viaje .= " ".$dir[$i];
					$i++;
				}
				$numero_direccion = $dir[$cant-1];
				$numero_direccion = str_replace("N*", "", $numero_direccion);

				if (empty($numero_direccion)) $numero_direccion = 0;

				$_POST['cant'] = $cant;
				$_POST['dir'] = $dir;
				$_POST['point_name'] = $viaje['applicant_company'];
				$_POST['point_address_name'] = $direccion_del_viaje;
				$_POST['point_address_number'] = $numero_direccion;
				$_POST['passenger'] = $viaje['applicant'];
				$comment = $viaje['message'];//." ".$viaje['observations_general'];
				$anexo = /*$viaje['message']." ".*/$viaje['observations_general'];
				$_POST['alias_id'] = $viaje['alias_id'];


				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;
				$_POST['is_cc'] = $viaje['is_cc'];
				$minutos_anticipacion = (int) $viaje['minutos_anticipacion'];
				//Revisar zona horaria del servidor

				$minutos = round((strtotime($viaje['travel_date']." ".$viaje['travel_time']) - time()) / 60) - $minutos_anticipacion;
				
				require 'cms/api/RequestRideFlota.php';

				if ($response['travel_id']!=0)
				{
					$sql = "UPDATE travel_logs SET status_dac = 2, id_dac = ".$response['travel_id']." WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					echo "El viaje no se cancelo (3), pero vino con travel_id 0<br>";
					var_dump($response);
					echo "<br>";
				}				
			break;
			case 81:
				//El viaje es desde la app, pero no se todavia si es corporativo o flota comun, asi que una vez que sea eso lo requesteo
				$direccion = trim($viaje['from_address']);

				$_POST['direccion'] = $direccion;
				$alias = $viaje['alias_id'];
				
				$dir = explode(' ', $direccion);
				$cant = count($dir);
				$direccion_del_viaje = "";
				$i = 0;
				while ($i < $cant-1) {
					if ($direccion_del_viaje == "") $direccion_del_viaje = $dir[$i];
					else $direccion_del_viaje .= " ".$dir[$i];
					$i++;
				}
				$numero_direccion = $dir[$cant-1];

				if (empty($numero_direccion)) $numero_direccion = 0;

				$_POST['cant'] = $cant;
				$_POST['dir'] = $dir;
				$_POST['point_name'] = $viaje['applicant_company'];
				$_POST['point_address_name'] = $direccion_del_viaje;
				$_POST['point_address_number'] = $numero_direccion;
				$_POST['passenger'] = $viaje['applicant'];
				$comment = $viaje['message'];//." ".$viaje['observations_general'];
				$anexo = /*$viaje['message']." ".*/$viaje['observations_general'];
				$_POST['alias_id'] = $viaje['alias_id'];


				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;
				$_POST['is_cc'] = $viaje['is_cc'];
				
				$minutos = 0;

				require 'cms/api/RequestRide.php';

				if ($response['travel_id']!=0)
				{
					$sql = "UPDATE travel_logs SET status_dac = 2, id_dac = ".$response['travel_id']." WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					echo "El viaje no se cancelo (3), pero vino con travel_id 0<br>";
					var_dump($response);
					echo "<br>";
				}			
			break;
			case 82:
				//El viaje es desde la app, pero no se todavia si es corporativo o flota comun, asi que una vez que sea eso lo requesteo
				//Viaje ingresado al sistema (Se debe requerir el viaje con RequestRide)
				$direccion = trim($viaje['from_address']);

				$_POST['direccion'] = $direccion;
				$alias = $viaje['alias_id'];
				
				$dir = explode(' ', $direccion);
				$cant = count($dir);
				$direccion_del_viaje = "";
				$i = 0;
				while ($i < $cant-1) {
					if ($direccion_del_viaje == "") $direccion_del_viaje = $dir[$i];
					else $direccion_del_viaje .= " ".$dir[$i];
					$i++;
				}
				$numero_direccion = $dir[$cant-1];

				if (empty($numero_direccion)) $numero_direccion = 0;

				$_POST['cant'] = $cant;
				$_POST['dir'] = $dir;
				$_POST['point_name'] = $viaje['applicant_company'];
				$_POST['point_address_name'] = $direccion_del_viaje;
				$_POST['point_address_number'] = $numero_direccion;
				$_POST['passenger'] = $viaje['applicant'];
				$comment = $viaje['message'];//." ".$viaje['observations_general'];
				$anexo = /*$viaje['message']." ".*/$viaje['observations_general'];
				$_POST['alias_id'] = $viaje['alias_id'];


				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;
				$_POST['is_cc'] = $viaje['is_cc'];
				$minutos_anticipacion = (int) $viaje['minutos_anticipacion'];
				//Revisar zona horaria del servidor

				$minutos = round((strtotime($viaje['travel_date']." ".$viaje['travel_time']) - time()) / 60) - $minutos_anticipacion;
				
				require 'cms/api/RequestRide.php';

				if ($response['travel_id']!=0)
				{
					$sql = "UPDATE travel_logs SET status_dac = 2, id_dac = ".$response['travel_id']." WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					echo "El viaje no se cancelo (3), pero vino con travel_id 0<br>";
					var_dump($response);
					echo "<br>";
				}				
			break;
			case 94:
				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;

				$_POST['travel_id'] = $viaje['id_dac'];

				require 'cms/api/ConfirmRide.php';

				if ($response['error']=='OK')
				{
					$sql = "UPDATE travel_logs SET status_dac = 3 WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
				}
				else
				{
					echo "El viaje no se confirmo (94)<br>";
					var_dump($response);
					echo "<br>";
				}
			break;
			case 96:
				//El viaje inmediato ingreso en la base de datos pero por alguna razon no paso a reservado/agendado/etc y quedo ahi
				$direccion = $viaje['from_address'];
				$dir = explode(' ', $direccion);
				$cant = count($dir);
				$direccion_del_viaje = "";
				$i = 0;
				while ($i < $cant-1) {
					if ($direccion_del_viaje == "") $direccion_del_viaje = $dir[$i];
					else $direccion_del_viaje .= " ".$dir[$i];
					$i++;
				}
				$numero_direccion = $dir[$cant-1];

				$_POST['point_name'] = $viaje['applicant_company'];
				$_POST['point_address_name'] = $direccion_del_viaje;
				$_POST['point_address_number'] = (int)preg_replace('/[^0-9]/', '', $numero_direccion);//$numero_direccion;
				$_POST['passenger'] = $viaje['applicant'];
				$comment = $viaje['message']." ".$viaje['observations_general'];
				$anexo = $viaje['message']." ".$viaje['observations_general'];
				$_POST['alias_id'] = $viaje['alias_id'];
				$_POST['is_cc'] = $viaje['is_cc'];

				$_POST['point_username'] = "puntou_test0004";
				$_POST['id'] = 40;
				//$minutos_anticipacion = (int) $viaje['minutos_anticipacion'];
				$minutos_anticipacion = 0;


				require 'cms/api/RequestRide.php';

				if ($response['travel_id']!=0)
				{
					//$sql = "UPDATE travel_logs SET status_dac = 2, id_dac = ".$response['travel_id']." WHERE id = ".$viaje['id'];
					//$result = mysqli_query($dbConn, $sql);
					$_POST['travel_id'] = $response['travel_id'];

				 	//require '../cms/api/ConfirmRide.php';

				 	$sql = "UPDATE travel_logs SET status = 'inmediato', status_dac = 95, id_dac = ".$_POST['travel_id']." WHERE id = ".$viaje['id'];
				 	//var_dump($sql);
				 	$result = mysqli_query($dbConn, $sql);
				 	$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'inmediato', NOW(), '1', NOW(), NOW(), 1, 'activo')";
					$result = mysqli_query($dbConn, $sql);
				}

			break;
			case 98:
				//Viaje marcado para cancelar
				//echo "Entre";
				if ($viaje['id_dac']!=0)
				{
					$_POST['id'] = $viaje['id_dac'];
					$_POST['point_username'] = "puntou_test0004";

					require 'cms/api/CancelRide.php';

					if ($response['status']=='OK')
					{
						$sql = "UPDATE travel_logs SET status_dac = 99, status = 'cancelado' WHERE id = ".$viaje['id'];
						$result = mysqli_query($dbConn, $sql);
						$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'cancelado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
						$result = mysqli_query($dbConn, $sql);
					}
				}
				else
				{
					$sql = "UPDATE travel_logs SET status_dac = 99, status = 'cancelado' WHERE id = ".$viaje['id'];
					$result = mysqli_query($dbConn, $sql);
					$sql = "INSERT INTO `travel_state_history` (`travel_id`, `status`, `change_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES ('".$viaje['id']."', 'cancelado', NOW(), '1', NOW(), NOW(), 1, 'activo')";
					$result = mysqli_query($dbConn, $sql);
				}
			break;
		}
	}
?>
