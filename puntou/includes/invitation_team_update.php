<?php
require_once(__DIR__ ."/../includes/config.php");
error_reporting(0);
session_start();

$team = $_POST['team'];
$action = $_POST['action'];

if( !empty($team) ) {
	if($action=="aceptar") {
		$id = $_SESSION['id'];
		if ($_SESSION['id_team'] == "" || $_SESSION['id_team'] == NULL)
		{
			$teams_id = $team;
		}
		else
		{
			$teams_id= $_SESSION['id_team'].",".$team;	
		}
		$sql= "UPDATE users SET id_team = '".$teams_id."' WHERE id = ".$_SESSION['id'];
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
