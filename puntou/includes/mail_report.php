<?php
	require("config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	$problema = $_POST['problema'];
	$tipo = $_POST['tipo'];

	$array_mail = [
               "",
               "",
               "".$problema,
               "Se reporto un problema de Matchat.",
               "Tipo de Problema : ".$tipo,
               "",          
               "www.matchat.com.ar <support@matchat.com>",
               "www.matchat.com.ar <support@matchat.com>",
               "#009def"
              ];

    send_mail("maxirodr@nexosmart.com.ar","Matchat :: Reporte recibido",$array_mail,$html="");

	$response = [
        'id' => $last_id,
        'return_path' => 'first'
    ];

    echo json_encode($response);
?>