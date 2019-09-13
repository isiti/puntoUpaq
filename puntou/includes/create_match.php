<?php
	require("config.php");
	session_start();

	//Recupero los datos que pedi por POST

	$game = $_POST['game'];
	$games = get_records_db("games","descr = '$game'");
    $games = $games[0];
    $game_id = $games['id'];
	$cancha = $_POST['cancha'];
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$cant_j = $_POST['cant_j'];
	$cupo = $_POST['cupo'];
	$equipos = $_POST['equipos'];
	$jugadores = $_POST['jugadores'];
	$value_partido = $_POST['valor'];

	//Para los jugadores, ahora tngo que revisar la sesion

	$hay_jugadores = FALSE;
	$jugadores = "";

	//print_r($_SESSION);

	if (isset($_SESSION['jugadores-invitados']) && !empty($_SESSION['jugadores-invitados']))
	{
		$hay_jugadores = TRUE;
		foreach ($_SESSION['jugadores-invitados'] as $key => $value) {
			//echo "mi key es $key y mi valor es $value";
			if ($value == 1 || $value == '1')
			{
				//echo 'entreq';
				if ($jugadores == "") $jugadores.=$key;
				else $jugadores.=",".$key;
			}
		}
		//echo "mis jugadores son ".$jugadores;
	}

	//Por lo pronto, voy a armar la consulta en dos partes, los campos y los valores

	$campos = "";
	$valores = "";
	$first = TRUE;
	$first_b = TRUE;

	if ($equipos != "")
	{
		if ($first) {$campos .=" teams_ids "; $first = FALSE; }  else $campos .=" ,teams_ids ";
		if ($first_b) {$valores .=" '$equipos' "; $first_b = FALSE; } else $valores .=", '$equipos' ";
	}

	if ($hay_jugadores)
	{
		if ($first) {$campos .=" users_ids "; $first = FALSE; }  else $campos .=" ,users_ids ";
		if ($first_b) {$valores .=" '$jugadores' "; $first_b = FALSE; } else $valores .=", '$jugadores' ";
	}

	if ($first) {$campos .=" room_admin "; $first = FALSE; } else $campos .=" ,room_admin ";
	if ($first_b) {$valores .=" ".$_SESSION['id']; $first_b = FALSE; } else $valores .=" , ".$_SESSION['id'];

	if ($first) {$campos .=" game_id "; $first = FALSE; }  else $campos .=" ,game_id ";
	if ($first_b) {$valores .=" ".$game_id; $first_b = FALSE; } else $valores .=" , ".$game_id;

	if ($first) {$campos .=" terminado "; $first = FALSE; } else $campos .=" ,terminado ";
	if ($first_b) {$valores .=" 'planificando'"; $first_b = FALSE; } else $valores .=" , 'planificando'";

	if ($cancha != "")
	{
		$campos .=" ,cancha ";
		$valores .=", '$cancha' ";
	}

	if ($fecha != "" && $hora != "")
	{
		$campos .=" ,fecha_partido ";

		//$fecha = explode('/', $fecha);
		//$hora  = explode(':', $hora);

		$valores .=", '$fecha $hora' ";
	}

	if ($cant_j != "")
	{
		$cant_j = str_replace('Futbol ', '', $cant_j);
		$campos .=" ,cant_cancha ";
		$valores .=", $cant_j ";
	}

	if ($cupo != "")
	{
		$campos .=" ,cupo ";
		$valores .=", $cupo ";
	}

	if ($value_partido != "" && is_numeric($value_partido))
	{
		$campos .=" ,valor_entrada ";
		$valores .=", $value_partido ";
	}

	$campos.= " ,fCreacion ";
	$valores.= ", NOW() ";

	$sql = "INSERT INTO matchs ($campos) VALUES ($valores)";

	//$dbConn->query($sql);

	//echo $sql;

	//var_dump($_SESSION);

	mysqli_query($dbConn, $sql);

	$last_id = mysqli_insert_id($dbConn);

	//echo $last_id;

	//Por cada jugador que invite, le mando una notificacion que dice que esta invitado a un nuevo partido
	$texto_not = $_SESSION['fullname']." te invita a jugar. <a onclick=\'ver_partido(\"".$last_id."\")\'>Ir al partido</a>.";

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