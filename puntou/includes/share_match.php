<?php
ob_start();
session_start();
include("config.php");

$mail = $_POST['email'];
$name = $_POST['name'];

$registro = get_records_db("users", "email = '".$mail."'");

$result = "No_OK";

if (!empty($registro))
{
	$registro=$registro[0];
	foreach ($registro as $key => $value) {
		$_SESSION[$key] = $value;
	}

	$result= "OK";
}
else
{
	$pass = substr(md5(uniqid(rand())),0,12);

	$login = new login();
	$pass_enc = $login->encrypt_password($pass);

	$sql = "INSERT INTO `users` (`fullname`, `password`, `email`, `gender`, `id_province`, `id_city`, `id_images`, `id_team`, `id_games`, `position`, `ignored_games`, `date`, `act_day`, `act_time`, `status`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `tipo`, `categories`) VALUES ('$name', '$pass_enc', '$mail', '', '1', '1', NULL, NULL, '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', CURRENT_TIMESTAMP, '', '', 'user', 'activo')";

	//echo $sql;

	$result = mysqli_query($dbConn,$sql);

	$registro = get_records_db("users", "email = '".$mail."'");

	if (!empty($registro))
	{
		$registro=$registro[0];
		foreach ($registro as $key => $value) {
			$_SESSION[$key] = $value;
		}
	}

	$result= "OK";
}

echo json_encode($result);

?>