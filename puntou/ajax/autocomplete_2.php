<?php
require("../includes/config.php");
set_time_limit(60);

$response = array('error' => true, 'msg' => '');
session_start();

//Variable de búsqueda
$consultaBusqueda = mysqli_real_escape_string($dbConn,strip_tags($_POST['valorBusqueda']));

$return = "";

$table = "movil_to_chofer";
$condition = "numero_movil = $consultaBusqueda";
$choferes = get_records_db($table, $condition);

foreach ($choferes as $key => $value) {
	$return.='<option data-id="'.$value['id'].'" data-nombre="'.$value['nombre_chofer'].'" class="li-alias" style="list-style-type: none;background: white;padding: 4px;z-index: 10;cursor:pointer;" value="'.$value['numero_movil'].'"><span>'.$value['numero_movil'].' ('.$value["nombre_chofer"].') </span></option>';
}

if (empty($return)) echo '<option style="list-style-type: none;background: white;padding: 4px;z-index: 10;cursor:pointer;" value="sin_resultados"><span>Sin resultados</span></option>';
else echo $return;
return;
?>
