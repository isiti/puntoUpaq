<?php
	session_start();
	require('config.php');

	if (isset($_SESSION))
	{
		$team_id = $_POST['team'];
		//traigo los equipos encontrados
		$teams = get_records_db("teams","id = ".$team_id);		

		if(count($teams)>0)
		{
			$resultado['status'] = 'OK';	
		}

		foreach ($teams as $key => $value) {
			$data_teams .='<div class="team-label">Nombre de equipo</div>
		                    <input type="text" class="team-input" placeholder="...." value="'.$value['name'].'" readonly>   

		                    <div class="team-more-info">
		                        <div class="team-img team-ph">
		                            <img class="img-circle" src="'.$value['id_images'].'">
		                        </div>
		                        <div class="team-tag">Avatar</div>
		                    </div>    

		                    <div class="team-label-found-green team-search-ask-invite">UNIRSE AL EQUIPO</div>';
		}
		
		$resultado['teams'] =$data_teams;	
		echo json_encode($resultado);
	}
?>
