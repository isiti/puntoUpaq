<?php
require_once(__DIR__ ."/../includes/config.php");
error_reporting(0);
session_start();

$team = $_POST['team'];
$action = $_POST['action'];
$jugador = $_POST['jugador'];

$jugador_que_pide = get_records_db("users","id = ".$jugador);
$jugador_que_pide = $jugador_que_pide[0];

if( !empty($team) ) {
	if($action=="aceptar") {
		$id = $jugador_que_pide['id'];
		if ($jugador_que_pide['id_team'] == "" || $jugador_que_pide['id_team'] == NULL)
		{
			$teams_id = $team;
		}
		else
		{
			$teams_id= $jugador_que_pide['id_team'].",".$team;	
		}
		$sql= "UPDATE users SET id_team = '".$teams_id."' WHERE id = ".$jugador_que_pide;
		mysqli_query($dbConn, $sql);
		//echo $sql;
	} elseif($action=="rechazar") {
		

	} else {
		echo json_encode(['error'=>"El ID/acción es incorrecto"]);
		return;
	}
	//print_r($_SESSION['carrito']);
	//var_dump(empty($_SESSION['carrito']));
	echo json_encode(['error'=>"",'response'=>"OK $id", 'empty'=>$empty]);
} else {
	echo json_encode(['error'=>"El ID es incorrecto: $id "]);
}

?>
