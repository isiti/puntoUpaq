<?php
$url_web = $_SERVER['SERVER_NAME'];
$base_url_web = "";
$index_web = "index.php";

$domain="matchat";
if( $_SERVER['SERVER_NAME']=="www.".$domain.".com.ar" || $_SERVER['SERVER_NAME']==$domain.".com.ar" ) {
    $database = "puntou_corporativo"; //database name
    $mysql_user = "puntou_corporativo"; //database user name
    $mysql_password = "nXIm3le7kw"; //database user password
    $mysql_host = "localhost";
} else {
    $url_web = $url_web."/clientes/puntou_corporativo/"; //LOCALHOST
    $base_url_web = "/clientes/puntou_corporativo/"; //LOCALHOST

    $database = "puntou_corporativo"; //database name
    $mysql_user = "root"; //database user name LOCALHOST
    $mysql_password = ""; //database user password LOCALHOST
    $mysql_host = "localhost";
}


$permisos_generales=array('admin','vendedor','super premium','premium','user');

//funciones
require "functions.php";
require "functions_extras.php";
$dbConn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $database);
	if(!$dbConn) {
		echo 'Error M1_conn. Administrador?'; var_dump($dbConn); var_dump($mysql_host);
		exit;
	}

if (!mysqli_set_charset($dbConn, "utf8")) {
 		echo 'Error M1. Administrador?';
		exit;
}

//logout function
if (isset($_GET['logout']) && $_GET['logout']=="true"){
    foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
    $_SESSION = array();
    session_unset();
    session_destroy();
    $_SESSION = "";
    redireccionar($index_web, $url_web);
}


?>
