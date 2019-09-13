<?php
ob_start();
session_start();
include("config.php");

if (isset($_POST['submit'])) {
	$datos = [
		"users",
		"username",
		"password",
		"en_US"
	];

	$login = new login();
	$login = $login->start_login($datos,false);
	//var_dump($login);

	//Se realizo la sesion
	if ($_SESSION['is_driver']==1 || $_SESSION['is_driver']=="1")
	{
		//Si hay multiples viajes
		$viajes = get_records_db("travel_logs", "status_dac = '5' AND id_user_driver = '".$_SESSION['id']."'");
		if (!empty($viajes))
		{
			foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
		    $_SESSION = array();
		    session_unset();
		    session_destroy();
		    $_SESSION = "";
			echo "ocupado";
		}
		else
		{
			echo "script";
		}
	}
	else
	{
		echo "script";
	}
}

?>