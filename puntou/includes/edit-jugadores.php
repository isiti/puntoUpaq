<?php
require_once(__DIR__ ."/../includes/config.php");
error_reporting(0);
session_start();

$id = $_POST['id'];
$action = $_POST['action'];

if( !empty($id) ) {
	if($action=="del") {
		$_SESSION['jugadores-invitados'][$id] = "";
		unset($_SESSION['jugadores-invitados'][$id]);
	} elseif($action=="add") {
		$_SESSION['jugadores-invitados'][$id] = 1;
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
