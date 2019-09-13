<?php
	require("../includes/config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	$response = array();

	$id_viaje = $_POST['id_viaje'];
	$lat = $_POST['lat_actual'];
	$long = $_POST['long_actual'];

	if (isset($_SESSION['id']) && !empty($_SESSION['id']))
	{
		$id_user = $_SESSION['id'];

		$sql = "INSERT INTO `travel_coordenadas` (`id_travel`, `id_user`, `lat`, `lng`) VALUES ('$id_viaje', '$id_user', '$lat', '$long')";
		//echo $sql;
		mysqli_query($dbConn, $sql);

		$response['status'] = 'ok';
	}
	else
	{
		$response['status'] = 'NOOK';
	}
	
	echo json_encode($response);
?>