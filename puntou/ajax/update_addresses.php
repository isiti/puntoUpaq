<?php
	require("../includes/config.php");
	session_start();
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	//Primero, saco todas las direcciones del usuario, ordenadas en orden ascendente

	//$direcciones = get_records_db('addresses_saved',"id_users = ".$_SESSION['id'],'ASC','type');

	$string_dirs = "";

	$cat_id_actual = 0;
	$cat_id_anterior = 0;

	$cat_name_actual = "";
	$cat_name_anterior = "";

	$tipos = get_records_db('address_type','',10,'ASC','id');

	foreach ($tipos as $key => $value) {
		$direcciones = get_records_db('addresses_saved',"type = ".$value['id']." AND id_users = ".$_SESSION['id']);
		if (empty($direcciones))
		{
			if ($value['id'] == 1)
				$string_dirs.=	'<div class="config-favoritos-item config-favoritos-casa">
									<i class="fa fa-home" style="font-size: 25px;"></i> <span>Agregar Casa</span>
								</div>
								<div class="separador2"></div>';
			else if ($value['id'] == 2)
				$string_dirs.=	'<div class="config-favoritos-item config-favoritos-trabajo">
									<i class="mdi mdi-briefcase" style="font-size: 25px;"></i> <span>Agregar Trabajo</span>
								</div>
								<div class="separador2"></div>';
			else if ($value['id'] == 3)
				$string_dirs.= '<div class="config-favoritos-item config-favoritos-otro">
									<i class="mdi mdi-star" style="font-size: 25px;"></i> <span>Agregar Otra</span>
								</div>';
		}
		else
		{
			foreach ($direcciones as $key2 => $value2) {
				if ($value['id'] == 1)
					$string_dirs.=	'<div class="config-favoritos-item config-favoritos-casa">
										<i class="fa fa-home" style="font-size: 25px;"></i> <span>'.$value2['address'].'</span>
									</div>';
				else if ($value['id'] == 2)
					$string_dirs.=	'<div class="config-favoritos-item config-favoritos-trabajo">
										<i class="mdi mdi-briefcase" style="font-size: 25px;"></i> <span>'.$value2['address'].'</span>
									</div>';
				else if ($value['id'] == 3)
					$string_dirs.= '<div class="config-favoritos-item config-favoritos-otro">
										<i class="mdi mdi-star" style="font-size: 25px;"></i> <span>'.$value2['address'].'</span>
									</div>';
			}

			if ($value['id'] == 1)
				$string_dirs.=	'<div class="config-favoritos-item config-favoritos-casa">
									<i class="fa fa-home" style="font-size: 25px;"></i> <span>Agregar Casa</span>
								</div>
								<div class="separador2"></div>';
			else if ($value['id'] == 2)
				$string_dirs.=	'<div class="config-favoritos-item config-favoritos-trabajo">
									<i class="mdi mdi-briefcase" style="font-size: 25px;"></i> <span>Agregar Trabajo</span>
								</div>
								<div class="separador2"></div>';
			else if ($value['id'] == 3)
				$string_dirs.= '<div class="config-favoritos-item config-favoritos-otro">
									<i class="mdi mdi-star" style="font-size: 25px;"></i> <span>Agregar Otra</span>
								</div>';

		}
	}

	$response = [
		'direcciones' => $string_dirs,
        'result' => 'OK'
    ];

    echo json_encode($response);
?>