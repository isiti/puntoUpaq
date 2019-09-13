<?php
	require("config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	//Recupero los datos que pedi por POST

	$nombre = $_POST['nombre'];
	$imagen = (isset($_POST['imagen']) ? $_POST['imagen'] : "../img/gray.png");
	$team = $_POST['team'];
	
	//Para los jugadores, ahora tngo que revisar la sesion

	$hay_jugadores = FALSE;
	$jugadores = "";
	
	//print_r($_SESSION);

	if (isset($_SESSION['jugadores-invitados-team']) && !empty($_SESSION['jugadores-invitados-team']))
	{
		$hay_jugadores = TRUE;
		foreach ($_SESSION['jugadores-invitados-team'] as $key => $value) {
			//echo "mi key es $key y mi valor es $value";
			if (($value == 1 || $value == '1') && $key != $_SESSION['id'])
			{
				//echo 'entreq';
				if ($jugadores == "") $jugadores.=$key;
				else $jugadores.=",".$key;
			}
		}
		//echo "mis jugadores son ".$jugadores;
		$_SESSION['jugadores-invitados-team'] = NULL;
		unset($_SESSION['jugadores-invitados-team']);
	}
	
	$team_act = get_records_db("teams","id = $team");
	$team_act = $team_act[0];

	$sql = "UPDATE teams SET ";

	$first = TRUE;

	if ($team_act['name'] != $nombre)
	{
		$sql.= " name = '".$nombre."' ";
		$first = FALSE;
	}

	if ($imagen != $team_act['id_images'] && $imagen != "../img/gray.png")
	{
		if (!$first) $sql.=" , ";
		$sql.=" id_images = '".$imagen."'";
		$first = FALSE;
	}

	$sql.=" WHERE id = ".$team;

	//$dbConn->query($sql);

	//echo $sql;

	//var_dump($_SESSION);

	if (!$first)
	{
		mysqli_query($dbConn, $sql);

		$last_id = mysqli_insert_id($dbConn);

		$ultimo_id = mysqli_insert_id($dbConn);
	}

	//Por cada jugador que invite, le mando una notificacion que dice que esta invitado a un nuevo partido
	$texto_not = $_SESSION['fullname']." te invitó a formar parte de un equipo, <a onclick=\'ver_invitacion(\"".$team."\")\'>ver la invitacion</a>.";

	$a_enviar = explode(',', $jugadores);

	foreach ($a_enviar as $key => $value) {
		$sql = "INSERT INTO notification (id_user, date, message, new, fcreacion) VALUES ($value, NOW(), '$texto_not', 1, NOW())";
		mysqli_query($dbConn, $sql);
		//echo $sql;
	}

	$response = [
        'id' => $last_id,
        'return_path' => 'first'
    ];

    echo json_encode($response);
?>