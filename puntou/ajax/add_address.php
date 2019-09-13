<?php
	require("../includes/config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	$type = ucfirst($_POST['type']);
	$dir = $_POST['direccion'];

	$tipo_dir = get_records_db('address_type',"description LIKE '%$type%'");

	$cat = 0;

	if (!empty($tipo_dir))
	{
		$cat = $tipo_dir[0]['id'];
	}
	//var_dump($tipo_dir);

	$creador = $_SESSION['id'];

	$sql = "INSERT INTO addresses_saved (id_users, address, type, fCreacion, fCreacionUsuario) VALUES ($creador, '$dir', $cat, NOW(), $creador)";
	mysqli_query($dbConn, $sql);
	//echo $sql;
	

	$response = [
        'result' => 'OK'
    ];

    echo json_encode($response);
?>