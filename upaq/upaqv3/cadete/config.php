<?php
$url_web = $_SERVER['SERVER_NAME'];

$domain="midominio";
if( $_SERVER['SERVER_NAME']=="www.".$domain.".com.ar" || $_SERVER['SERVER_NAME']==$domain.".com.ar" ) {
	
	// en servidor	
	// -> Direcciones para redireccion
	$base_url_web = "/clientes/cms-braian";	
	$url_web = $url_web.$base_url_web; 
	// -> Credenciales.
	$database = "upaq_new"; 
	$mysql_user = "braian";
	$mysql_password = "93381";
	$mysql_host = "localhost";

} else {

	// en local	
	// -> Direcciones para redireccion
//	$base_url_web = "/clientes/NexoSmart-Templates/cms-braian";
    $base_url_web = "/clientes/constructorapp/cms";
	$url_web = $url_web.$base_url_web; 	
	// -> Credenciales.
	$database = "constructor"; 
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_host = "localhost";

}


// -> Incluyo frameworks para el back
include(__DIR__."/../frameworks/nexosmart/functions.php");


// -> Conexión a la base de datos.
$dbConn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $database);
	if(!$dbConn) {
		echo 'Error M1. Administrador?';
		exit;
	}

if (!mysqli_set_charset($dbConn, "utf8")) {
 		echo 'Error M2. Administrador?';
		exit;
}

// -> Logout del CMS
if($_GET['logout']=="true") {
	foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
	$_SESSION = array();
	session_unset();
	session_destroy();
    $_SESSION = "";
	redireccionar("/home", $url_web);
}

?>
