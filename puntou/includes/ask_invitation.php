<?php
	require("config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	$team_id = $_POST['team_id'];

	$creador = get_db_row($team_id,"id_creador","teams");
	$nombre = get_db_row($team_id,"name","teams");

	//Por cada jugador que invite, le mando una notificacion que dice que esta invitado a un nuevo partido
	$texto_not = $_SESSION['fullname']." quiere formar parte de tu equipo ".$nombre.", <a onclick=\'ver_pedido(\"".$_SESSION['id']."\", \"".$team_id."\")\'>ver la peticion</a>.";

	foreach ($a_enviar as $key => $value) {
		$sql = "INSERT INTO notification (id_user, date, message, new, fcreacion) VALUES ($creador, NOW(), '$texto_not', 1, NOW())";
		mysqli_query($dbConn, $sql);
		//echo $sql;
	}

	$response = [
        'id' => $last_id,
        'return_path' => 'first'
    ];

    echo json_encode($response);
?>