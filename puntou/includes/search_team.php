<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		$team_name = $_POST['team'];
		//traigo los equipos encontrados
		$teams = get_records_db("teams","name LIKE '%$team_name%' ");		

		if(count($teams)>0)
		{
			$resultado['status'] = 'OK';	
		}

		foreach ($teams as $key => $value) {
			$data_teams .='<div class="play-sport-search row">
                    <div class="play-img-sport-search col-xs-5 col-md-5 col-lg-5">
                        <img src="'.$value['id_images'].'" style="max-width: 80%;">
                    </div>
                    <div class="play-info-player-search col-xs-3 col-md-3 col-lg-3" style="margin: 20px 0px 0 7px;">
                        <div class="play-player-name">
                            '.$value['name'].'
                        </div>
                        <div class="play-player-rating">
                            
                        </div>
                    </div>
                    <div class="sport-write col-xs-3 col-md-3 col-lg-3" style="margin: 5px 0px 0px -15px;">
                        <i class="fa fa-times cruz-no-invitar';
            
            $data_teams.=' buscar-jugadores-partido-nuevo " aria-hidden="true" data-teamid="'.$value['id'].'"></i>
                    </div>
                </div>';
		}
		
		$resultado['teams'] =$data_teams;	
		echo json_encode($resultado);
	}
?>
