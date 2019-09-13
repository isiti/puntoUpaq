<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		$data_players = array();
		$data_teams = "";

		//busco equipos
		$players=get_records_db('games', 'categories = "activo"');
		
		//busco los nombres de los jugadores
		foreach ($players as $p) {
			array_push($data_players, $p['name']);
			//$data_teams .= "<li data-teamid='".$p['id']."'>".$p['name']."</li>";
			$data_teams .='<div class="play-sport-search row">
                    <div class="play-img-sport-search col-xs-5 col-md-5 col-lg-5">
                        <img src="'.$p['id_images'].'">
                    </div>
                    <div class="play-info-player-search col-xs-3 col-md-3 col-lg-3" style="margin: 20px 0px 0 7px;">
                        <div class="play-player-name">
                            '.$p['descr'].'
                        </div>
                        <div class="play-player-rating">
                            
                        </div>
                    </div>
                    <div class="sport-write col-xs-3 col-md-3 col-lg-3" style="margin: 5px 0px 0px -15px;">
                        <i class="fa fa-times cruz-no-invitar';
            
            $data_teams.=' buscar-jugadores-partido-nuevo " aria-hidden="true" data-teamid="'.$p['id'].'"></i>
                    </div>
                </div>';
		}

		$resultado['status'] = 'OK';
		$resultado['players'] = $data_players;
		$resultado['teams'] = $data_teams;		
		echo json_encode($resultado);
	}
?>
