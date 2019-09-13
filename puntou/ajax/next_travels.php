<?php 
session_start();
include "../includes/config.php";

$id_user = (int)$_SESSION['id'];
$resultado;
$resultado['status'] = 'ok';
$is_driver = get_db_row($_SESSION['id'], "is_driver", "users");

if ($is_driver == 0) {
	$sql = " SELECT * FROM travel_logs WHERE id_users LIKE ".$id_user." AND (travel_date > CURDATE() OR (travel_date = CURDATE() AND travel_time > current_time())) AND status != 'agendado' AND status != 'inmediato'"; 
	$db_viajes = mysqli_query($dbConn, $sql);
	$div_viaje = "";
	if( ($db_viajes->num_rows)>0 ) {
		foreach($db_viajes as $key => $value){

			$new_date = date("d-m-Y", strtotime($value['travel_date']));

			if ($value['status'] == 'cancelado') {
				$cancelado = ' <span class="tag_cancelado">Cancelado</span> ';
			}else {
				$cancelado = '<span> $'.$value['amount'].'</span>';
			}

			$div_viaje .= '	<div class="viaje-detalle-lugares">
								<span>'.$value['from_address'].' <i class="fas fa-long-arrow-alt-right"></i> '.$value['to_address'].'</span>
							</div>
							<div class="viaje-detalle-datos">
								<span>'.$new_date.' <i class="fas fa-circle"></i> '.$value['travel_time'].' <i class="fas fa-circle"></i><span>'.$cancelado.'</span></span>
							</div>
							<hr>  
						   ';
	
        }
		$resultado['datos'] = $div_viaje;
	}else{
	
		$div_viaje .=  ' <div class="sin_datos">
							<span>No tenés viajes reservados.</span>
						</div>';
	
		$resultado['status'] = 'no ok';
		$resultado['noDatos'] = $div_viaje;
	}
	
    echo json_encode($resultado);
}