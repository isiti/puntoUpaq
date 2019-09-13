<?php
require_once(__DIR__ ."/../includes/config.php");
error_reporting(0);
session_start();

$action = $_POST['action'];
$inv = $_POST['inv'];

if( !empty($inv) ) {
	if($action=="aceptar") {
		$id = $_SESSION['id'];

		$sql= "UPDATE emergency_invitation SET accept_user_id = ".$id." WHERE id = ".$inv;
		mysqli_query($dbConn, $sql);

		$invitacion = get_records_db('emergency_invitation', 'categories = "activo" AND id ='.$inv);
    	$invitacion = $invitacion[0];

    	$mensaje1 = "El jugador ".$_SESSION['fullname']." acepto tu invitacion de emergencia!";

		$sql = "INSERT INTO `notification` (`id_user`, `date`, `message`, `message_alt`, `new`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES (".$invitacion['user_id'].", CURRENT_TIMESTAMP, '$mensaje1', '$mensaje1', 1, '', CURRENT_TIMESTAMP, '', '', 'activo')";
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
