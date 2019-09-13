<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		//datos de equipos
		$data_players = array();
		$data_teams = "";

		$game = $_POST['game'];
		$games = get_records_db("games","descr = '$game'");
	    $games = $games[0];
	    $game_id = $games['id'];
	    $team = $_POST['team'];

		//busco equipos
		if (!isset($_POST['jugador']))
		{
			$players=get_records_db('users',' id_city='.$_SESSION['id_city'].' AND !FIND_IN_SET("'.$team.'", id_team)'/*." AND id_games = ".$game_id*/);
		}
		else 
		{
			$players=get_records_db('users',' id_city='.$_SESSION['id_city'].' AND fullname LIKE "%'.$_POST['jugador'].'%" AND !FIND_IN_SET("'.$team.'", id_team)'/*." AND id_games = ".$game_id*/);
		}
		

		//busco los nombres de los jugadores
		foreach ($players as $p) {
			array_push($data_players, $p['fullname']);
			//$data_teams .= "<li data-playid='".$p['id']."'>".$p['fullname']."</li>";
			$data_teams .='<div class="play-player-search">
                    <div class="play-img-player-search">
                        <img src="../img/gray-small.png">
                    </div>
                    <div class="play-info-player-search">
                        <div class="play-player-name">
                            '.$p['fullname'].'
                        </div>
                        <div class="play-player-position">
                            Posición
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
                        <i class="fa ';
            if (isset($_SESSION['jugadores-invitados-team']) && isset($_SESSION['jugadores-invitados-team'][$p['id']]) && $_SESSION['jugadores-invitados-team'][$p['id']]==1)
            	$data_teams.=' fa-check check-invitar ';
            else $data_teams.= ' fa-times cruz-no-invitar';

            $data_teams.=' buscar-jugadores-partido-nuevo " aria-hidden="true" data-playid="'.$p['id'].'"></i>
                    </div>
                </div>';
		}

		$resultado['status'] = 'OK';
		$resultado['players'] = $data_players;
		$resultado['teams'] = $data_teams;		
		echo json_encode($resultado);
	}
?>
