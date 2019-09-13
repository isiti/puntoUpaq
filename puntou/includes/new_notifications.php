<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		$notificaciones_nuevas = get_records_db('notification','id_user = '.$_SESSION['id'].' AND new = 1');
		$resultado['status'] = 'OK';
		$resultado['cant'] = count($notificaciones_nuevas);
		echo json_encode($resultado);
	}
?>
