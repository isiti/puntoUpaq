<?php
	require("config.php");
	session_start();

	//Recupero los datos que pedi por POST

	$cancha = $_POST['cancha'];
	$fecha = $_POST['fecha'];
	$cant_j = $_POST['cant_j'];
	$match_id = $_POST['partido'];
	//Para los jugadores, ahora tngo que revisar la sesion

	

	$sql = "UPDATE matchs SET ";
	$first = TRUE;
	if (isset($cancha) && $cancha != "")
	{
		$sql.=" cancha = '".mysqli_escape_string($dbConn,$cancha)."' ";
		$first = FALSE;
	}

	if (isset($fecha) && $fecha != "")
	{
		if (!$first) $sql.=", ";
		$sql.=" fecha_partido = '".mysqli_escape_string($dbConn, $fecha)."' ";
		$first = FALSE;
	}

	if (isset($cant_j) && $cant_j != "" && is_numeric($cant_j))
	{
		if (!$first) $sql.=", ";
		$sql.=" cant_cancha = '".mysqli_escape_string($dbConn, $cant_j)."' ";
		$first = FALSE;
	}

	$sql.=" WHERE id = ".$match_id;

	//$dbConn->query($sql);

	//echo $sql;

	//var_dump($_SESSION);

	mysqli_query($dbConn, $sql);

	$last_id = mysqli_insert_id($dbConn);

	//echo $last_id;

	//Por cada jugador que invite, le mando una notificacion que dice que esta invitado a un nuevo partido
	
	$response = [
        'id' => $match_id,
        'return_path' => 'first'
    ];

    echo json_encode($response);
?>