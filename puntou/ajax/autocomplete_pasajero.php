<?php
require("../includes/config.php");
set_time_limit(60);

$response = array('error' => true, 'msg' => '');
session_start();

//Variable de búsqueda
$consultaBusqueda = mysqli_real_escape_string($dbConn,strip_tags($_POST['valorBusqueda']));

$return = "";

$table = "vales_pasajeros";
$condition = "nombre LIKE '%$consultaBusqueda%'";
$choferes = get_records_db($table, $condition);

foreach ($choferes as $key => $value) {
	$return.='<option data-id="'.$value['id'].'" data-nombre="'.$value['nombre'].'" data-centro="'.$value['centro_costo'].'" data-domicilio="'.$value['domicilio'].'" data-departamento="'.$value['nombre_departamento'].'" class="li-alias" style="list-style-type: none;background: white;padding: 4px;z-index: 10;cursor:pointer;" value="'.$value['domicilio'].'"><span>'.$value['nombre'].' ('.$value["domicilio"].' - '.$value["centro_costo"].') </span></option>';
}

if (empty($return)) echo '<option style="list-style-type: none;background: white;padding: 4px;z-index: 10;cursor:pointer;" value="sin_resultados"><span>Sin resultados</span></option>';
else echo $return;
return;
?>
