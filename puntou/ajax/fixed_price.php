<?php 

include "../includes/config.php";

$id_user = (int)$_SESSION['id'];
$resultado;

if (!empty($_POST)) {

    $alias_id = get_db_row($_POST['id_viaje'], "alias_id", "travel_logs");

    $coincidencia = get_records_db('travel_fixed_prices',"alias_id LIKE '%$alias_id%'");

    $price = 0;

    if (!empty($coincidencia)) {
        $price = $coincidencia[0]['price'];
        $resultado['price'] = $price;
	} else {
        $resultado['price'] = $price;
    }

    $resultado['status'] = 'ok';

} else {
	$resultado['status'] = 'nook';
}

echo json_encode($resultado);

?>