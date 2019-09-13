<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		//datos de jugadores
		$data_players = array();

		//cambiar el parametro 1 por el post['id_team']
		if (!isset($_POST['team']))
		{
			$teams = get_records_db('teams',' id = 1');
		}
		else
		{
			$teams = get_records_db('teams',' id = '.$_POST['team']);
		}
		
		//traigo el equipo encontrado
		$team=$teams[0];

		//busco sus jugadores
		$players=get_records_db('users',' FIND_IN_SET("'.$team['id'].'", id_team)');

		$texto_jugadores = "";

		//busco los nombres de los jugadores
		foreach ($players as $p) {
			//$user=get_records_db('users',' id='.$p['id'])[0];
			//$data_players[]=$p['fullname'];
			//array_push($data_players, $p['fullname']);
			$texto_jugadores.="<div><span>".$p['fullname']."</span>";
			if ($p['id'] != $team['id_creador'])
			{
				$texto_jugadores.="<i class='fa fa-times jugadores-uninvite' aria-hidden='true' data-playname='".$p['fullname']."' data-playid='".$p['id']."' data-teamid='".$team['id']."' style='color:red !important; margin-left:10px;'></i>";
			}
			$texto_jugadores.="</div>";
		}

		$resultado['status'] = 'OK';
		$resultado['players'] = $texto_jugadores;		
		echo json_encode($resultado);
	}
?>
