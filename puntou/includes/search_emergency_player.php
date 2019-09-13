<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		$game = $_POST['game'];
		$cancha = $_POST['cancha'];
		$hora = $_POST['hora'];

		$jugadores = get_records_db("users", "categories = 'activo' AND id_games = $game AND id !=".$_SESSION['id']);

		$sql = "INSERT INTO emergency_invitation (`user_id`, `hora`, `cancha`, `game_id`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES (".$_SESSION['id'].", '".$hora."', '".$cancha."', ".$game.", '', NOW(), NOW(), '', 'activo')";

		mysqli_query($dbConn, $sql);

		$last_id = mysqli_insert_id($dbConn);

		$mensaje1 = "Hay un partido urgente que le falta un jugador, ver detalles.";

		$mensaje2 = "Necesitan de tu ayuda: un partido a punto de comenzar necesita completar, <a onclick=\'ver_partido_emergencia(\"".$last_id."\")\'>ver invitación<a>";

		foreach ($jugadores as $key => $value) {
			$sql = "INSERT INTO `notification` (`id_user`, `date`, `message`, `message_alt`, `new`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES (".$value['id'].", CURRENT_TIMESTAMP, '$mensaje2', '$mensaje1', 1, '', CURRENT_TIMESTAMP, '', '', 'activo')";
			mysqli_query($dbConn, $sql);				
		}

		echo json_encode("OK");		
	}
?>
