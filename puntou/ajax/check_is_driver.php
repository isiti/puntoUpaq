<?php
    session_start();
    include "../includes/config.php";

    if ($_SESSION['is_driver'])
    {
    	$resultado['is_driver'] = "OK";	
    }
    else
    {
    	$resultado['is_driver'] = "NOOK";	
    }    

    echo json_encode($resultado);
?>