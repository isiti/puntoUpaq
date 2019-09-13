<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		$game = $_POST['game'];
		$games = get_records_db("games","descr = '$game'");
	    $games = $games[0];
	    $game_id = $games['id'];
		//datos de equipos
		$data_players = array();
		$data_teams = "";

		//busco equipos
		if (!isset($_POST['rival']))
		{
			$players=get_records_db('teams',' id_city='.$_SESSION['id_city']." AND id_games = ".$game_id);
		}
		else
		{
			$players=get_records_db('teams',' id_city='.$_SESSION['id_city'].' AND name LIKE "%'.$_POST['rival'].'%"'." AND id_games = ".$game_id);
		}
		

		//busco los nombres de los jugadores
		foreach ($players as $p) {
			array_push($data_players, $p['name']);
			//$data_teams .= "<li data-teamid='".$p['id']."'>".$p['name']."</li>";
			$data_teams .='<div class="play-rival-search">
                    <div class="play-img-player-search">
                        <img src="../img/gray-small.png">
                    </div>
                    <div class="play-info-player-search">
                        <div class="play-player-name">
                            '.$p['name'].'
                        </div>
                        <div class="play-player-rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="team-write">
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
