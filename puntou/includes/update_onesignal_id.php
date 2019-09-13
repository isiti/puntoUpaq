<?php
	session_start();
	require('config.php');

	if (isset($_SESSION) && isset($_POST['id']))
	{
		$id = $_POST['id'];
		if ($id != $_SESSION['onesignal_player_id'])
		{
			$sql = "UPDATE users SET onesignal_player_id = '$id' WHERE id = ".$_SESSION['id'];
			$result = mysqli_query($dbConn, $sql);
			$_SESSION['onesignal_player_id'] = $id;
			$resultado = "actualizado";
		}
		else
		{
			$resultado = "noactualizadoporigual";
			//var_dump($_SESSION);
		}
	}
	else
	{
		$resultado = "noactualizadoporerror";
	}

	echo json_encode($resultado);
?>
