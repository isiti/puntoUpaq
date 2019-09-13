<?php 
session_start();
include "../includes/config.php";

$id_user = (int)$_SESSION['id'];
$resultado;
$resultado['status'] = 'ok';
$is_driver = get_db_row($_SESSION['id'], "is_driver", "users");

if ($is_driver == 0) {
	$sql = " SELECT * FROM travel_logs WHERE id_users LIKE '%$id_user%' AND (travel_date < CURDATE() OR (travel_date = CURDATE() AND travel_time < current_time())) AND status != 'cancelado'"; 
	$db_viajes = mysqli_query($dbConn, $sql);
	$div_viaje = "";
	if( ($db_viajes->num_rows)>0 ) {
		foreach($db_viajes as $key => $value){			
			
			if ($value['id_review_pasajero'] == 0) {
				$div_review = ' <input type="button" id="'.$value['id'].'" class="btn_p_review8" value="Calificar"/>';
			}else {
				$div_review = '';
			}

			$new_date = date("d-m-Y", strtotime($value['travel_date']));

			$div_viaje .= '	<div data_id="'.$value['id'].'" class="div_travel">
								<div class="viaje-detalle-lugares">
									<span>'.$value['from_address'].' <i class="fas fa-long-arrow-alt-right"></i> '.$value['to_address'].'</span>
								</div>
								<div class="viaje-detalle-datos">
									<span>'.$new_date.' <i class="fas fa-circle"></i> '.$value['travel_time'].' <i class="fas fa-circle"></i> $'.$value['amount'].'</span>
								</div>
							</div>
							<div class="div_btn_review" style="text-align: center;">
								'.$div_review.'
							</div>
							<hr>  
						   ';
	
		}
		$resultado['datos'] = $div_viaje;
	}else{
	
		$div_viaje .=  ' <div class="sin_datos">
							<span>Todavía no realizaste ningún viaje.</span>
						</div>';
	
		$resultado['status'] = 'no ok';
		$resultado['noDatos'] = $div_viaje;
	}
	
	echo json_encode($resultado);	
} else {
	$sql = " SELECT * FROM travel_logs WHERE id_users_driver LIKE '%$id_user%' AND status != 'cancelado' "; //'%$id_user%'
	$db_viajes = mysqli_query($dbConn, $sql);
	$div_viaje = "";
	if( ($db_viajes->num_rows)>0 ) {
		foreach($db_viajes as $key => $value){
			
			$id_viaje = $value["id"];
			$sql_firma = "SELECT * FROM logs_signatures WHERE id_travel_logs LIKE '%$id_viaje%' ";
			$db_firma = mysqli_query($dbConn, $sql_firma);
			$div_firma = '';

			if( ($db_firma->num_rows) > 0 ) {
				foreach($db_firma as $key => $valor){
					if (empty($valor['url_signature'])) {
						$div_firma = ' <input style="margin-left: 5px;" type="button" data_id_firma="'.$value['id'].'" class="btn_p_firma" value="Firmar"/><input style="margin-left: 5px;" type="button" data_id_firma="'.$value['id'].'" class="btn_p_vale" value="Vale"/>';
						
					}else {
						$div_firma = '';
						
					}
				}
			} else {
				$div_firma = ' <input style="margin-left: 5px;" type="button" data_id_firma="'.$value['id'].'" class="btn_p_firma" value="Firmar"/><input style="margin-left: 5px;" type="button" data_id_firma="'.$value['id'].'" class="btn_p_vale" value="Vale"/>';
			}
			
			$nombre_img = $id_user."-".$id_viaje."-signature.png";
			$url_web = "../signatures/";
			$filePath = $url_web.$nombre_img;

			if (file_exists($filePath)) {

			} else {
				$div_firma = ' <input style="margin-left: 5px;" type="button" data_id_firma="'.$value['id'].'" class="btn_p_firma" value="Firmar"/><input style="margin-left: 5px;" type="button" data_id_firma="'.$value['id'].'" class="btn_p_vale" value="Vale"/>';
			}

			$new_date = date("d-m-Y", strtotime($value['travel_date']));

			$div_viaje .= '	<div class="viaje-detalle-lugares">
								<span>'.$value['from_address'].' <i class="fas fa-long-arrow-alt-right"></i> '.$value['to_address'].'</span>
							</div>
							<div class="viaje-detalle-datos">
								<span>'.$new_date.' <i class="fas fa-circle"></i> '.$value['travel_time'].' <i class="fas fa-circle"></i> $'.$value['amount'].'</span>
							</div>
							<div class="div_btn_review" style="text-align: center;">
								'.$div_firma.'
							</div>
							<hr>  
						   ';
	
		}
		$resultado['datos'] = $div_viaje;
	}else{
	
		$div_viaje .=  ' <div class="sin_datos">
							<span>Todavía no realizaste ningún viaje.</span>
						</div>';
	
		$resultado['status'] = 'no ok';
		$resultado['noDatos'] = $div_viaje;
	}
	
	echo json_encode($resultado);	
}

?>
