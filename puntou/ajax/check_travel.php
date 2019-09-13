<?php
	require("../includes/config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	$response = array();

	if (isset($_POST))
	{
		$tomado = get_db_row($_POST['travel_id'], "id_users_driver", "travel_logs");
		$chofer = get_db_row($tomado, "fullname", "users");

		$response['chofer'] = '<p class="assignated">Tu chofer asignado es: <br><strong>'.$chofer.'</strong></p><br><br><p class="mess-califica">Califica al conductor al finalizar el viaje.</p>';

		$response['status'] = "OK";

		if ($tomado != 0)
		{
			$response['tomado'] = "si";
		}
		else
		{
			$response['tomado'] = "no";	
		}
	}
	else
	{
		$response['status'] = "NOOK";
	}	

    echo json_encode($response);
?>