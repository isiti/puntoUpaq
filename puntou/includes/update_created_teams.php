<?php
	require("config.php");
	session_start();

	//Tengo que recuperar todos los equipos creados por el usuario.

	$equipos = get_records_db("teams","categories != 'borrado' AND id_creador = ".$_SESSION['id']);
	//var_dump($equipos);
	if (!empty($equipos))
	{
		$equipos_res = "";
		foreach ($equipos as $key => $value) {
			$equipos_res.= '<div class="play-in-current team-1-test" data-id-team="'.$value['id'].'">
	                        <div class="play-img-player">
	                            <img src="'.$value['id_images'].'" style="max-width: 100%;">
	                        </div>
	                        <div class="play-info-player">
	                            <div class="play-player-name">
	                                '.$value['name'].'
	                            </div>
	                            <div class="play-player-rating">
	                                <i class="fa fa-star" aria-hidden="true"></i>
	                                <i class="fa fa-star-o" aria-hidden="true"></i>
	                                <i class="fa fa-star-o" aria-hidden="true"></i>
	                                <i class="fa fa-star-o" aria-hidden="true"></i>
	                                <i class="fa fa-star-o" aria-hidden="true"></i>
	                            </div>
	                        </div>
	                        <div class="player-write">
	                            <i class="fa fa-mail-reply" aria-hidden="true"></i>
	                        </div>
	                    </div>';
		}
		$response = ['equipos' => $equipos_res];
	}
	else
	{
		$response = ['equipos' => 'none'];
	}

    echo json_encode($response);
?>