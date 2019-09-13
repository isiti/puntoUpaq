<?php
session_start();
include "../includes/config.php";

$id_user = (int)$_SESSION['id'];
$review = (int)$_POST['calificacion'];
$id_viaje = (int)$_POST['id_viaje'];

$id_viajes = get_records_db('travel_logs', 'id = '.$id_viaje, 1);

$id_traveler = (int)$id_viajes[0]['id_users'];
$id_driver = (int)$id_viajes[0]['id_users_driver'];

if(isset($id_user) && !empty($review)) {

	if($id_user == $id_traveler) {
		$id_calificado = $id_driver;
	    $sql_review = mysqli_query(
	      $dbConn,"INSERT INTO reviews (`id_users`, `id_calificado`,`review`, `fModificacionUsuario`, `fModificacion`, `fCreacionUsuario`,`fCreacion`)
	               VALUES ($id_user, $id_calificado, $review, '0000-00-00', CURRENT_TIMESTAMP, '0000-00-00', '0000-00-00' )"
		);
		
		$id_review = mysqli_insert_id($dbConn);

		$sql_travel = mysqli_query(
			$dbConn,"UPDATE travel_logs
			SET id_review_pasajero = $id_review
			WHERE id = $id_viaje;"
		);  
	    
	    $data['insert'] = 'insert ok';
		$data['calificado'] = $id_calificado;
		
	} elseif ($id_user == $id_driver) {
			$id_calificado = $id_traveler;
		    $sql_review = mysqli_query(
		      $dbConn,"INSERT INTO reviews (`id_users`, `id_calificado`,`review`, `fModificacionUsuario`, `fModificacion`, `fCreacionUsuario`,`fCreacion`)
		               VALUES ($id_user, $id_calificado, $review, '0000-00-00', CURRENT_TIMESTAMP, '0000-00-00', '0000-00-00' )"
			);
			
			$id_review = mysqli_insert_id($dbConn);

			$sql_travel = mysqli_query(
				$dbConn,"UPDATE travel_logs
				SET id_review_chofer = $id_review
				WHERE id = $id_viaje;"
			);  

		    $data['insert'] = 'insert ok';
			$data['calificado'] = $id_calificado;
			
		
	} else {
		$data['insert'] = 'insert error';
	}

};

echo json_encode($data);

 ?>
