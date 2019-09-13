<?php
	require("config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	//Recupero los datos que pedi por POST

	$game = $_POST['game'];
	$games = get_records_db("games","descr = '$game'");
    $games = $games[0];
    $game_id = $games['id'];
	$nombre = $_POST['nombre'];
	$imagen = (isset($_POST['imagen']) ? $_POST['imagen'] : "../img/gray.png");
	
	//Para los jugadores, ahora tngo que revisar la sesion

	$hay_jugadores = FALSE;
	$jugadores = "".$_SESSION['id'];

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

	
	//$my_blob = file_get_contents($imagen);
	//$res = file_put_contents('../img/'.$fname, file_get_contents($imagen));

	//echo $imagen;

	//var_dump($_FILES);

	//Por lo pronto, voy a armar la consulta en dos partes, los campos y los valores

	$campos = "";
	$valores = "";
	$first = TRUE;
	$first_b = TRUE;

	if ($first) {$campos .=" name "; $first = FALSE; } else $campos .=" ,name ";
	if ($first_b) {$valores .=" '".$nombre."'"; $first_b = FALSE; } else $valores .=" , '".$nombre."'";

	if ($first) {$campos .=" id_games "; $first = FALSE; }  else $campos .=" ,id_games ";
	if ($first_b) {$valores .=" ".$game_id; $first_b = FALSE; } else $valores .=" , ".$game_id;

	if ($first) {$campos .=" id_images "; $first = FALSE; } else $campos .=" ,id_images ";
	if ($first_b) {$valores .="'".$imagen."'"; $first_b = FALSE; } else $valores .=","."'".$imagen."'";

	$campos .=" ,id_city ";
	$valores .=", ".$_SESSION['id_city'];

	$campos .=" ,id_creador ";
	$valores .=", ".$_SESSION['id'];

	$campos.= " ,fCreacion ";
	$valores.= ", NOW() ";

	$sql = "INSERT INTO teams ($campos) VALUES ($valores)";

	//$dbConn->query($sql);

	//echo $sql;

	//var_dump($_SESSION);

	mysqli_query($dbConn, $sql);

	$last_id = mysqli_insert_id($dbConn);

	$ultimo_id = mysqli_insert_id($dbConn);

	//secho $last_id;
	if ($_SESSION['id_team'] != NULL && $_SESSION['id_team'] != "") $last_id = $_SESSION['id_team'].",".$last_id;

	$sql = "UPDATE users SET id_team = ".$last_id." WHERE id = ".$_SESSION['id'];
	mysqli_query($dbConn, $sql);

	//Por cada jugador que invite, le mando una notificacion que dice que esta invitado a un nuevo partido
	$texto_not = $_SESSION['fullname']." te invitó a formar parte de un equipo, <a onclick=\'ver_invitacion(\"".$ultimo_id."\")\'>ver la invitacion</a>.";

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