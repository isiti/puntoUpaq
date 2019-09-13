<?php
	session_start();
	
	require('config.php');
	error_reporting(-1);

	if (isset($_SESSION))
	{
		$notificaciones_nuevas = get_records_db('notification','id_user = '.$_SESSION['id'].' AND new = 1');
		$resultado['status'] = 'OK';
		$resultado['cant'] = 0;
		$query = mysqli_query($dbConn,"UPDATE notification SET new = 0 WHERE id_user = ".$_SESSION['id']);
		//var_dump( mysqli_error($dbConn));
		echo json_encode($resultado);
	}
?>
