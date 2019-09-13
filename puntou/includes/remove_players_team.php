<?php
	require_once(__DIR__ ."/../includes/config.php");
	session_start();

	$playid = $_POST['playid'];
	$teamid = $_POST['teamid'];

	$user = get_records_db('users',' id = '.$playid);

	$jugador = $user[0];

	$equipos = explode(',', $jugador['id_team']);

	$nuevo = "";

	foreach ($equipos as $key => $value) {
		if ($value != $teamid)
		{
			if ($nuevo == "") $nuevo=$value;
			else $nuevo.=","+$value;
		}
	}

	//var_dump($nuevo);

	if ($nuevo == "")
	{
		$sql = "UPDATE users SET id_team = NULL WHERE id = ".$playid;
	}
	else
	{
		$sql = "UPDATE users SET id_team = '".$nuevo."' WHERE id = ".$playid;
	}

	
	$result = mysqli_query($dbConn,$sql);

	//var_dump($sql);
	$resultado['status'] = 'OK';

	echo json_encode($resultado);

?>
