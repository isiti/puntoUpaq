<?php
	require("config.php");
	session_start();

	//Tengo que recuperar el equipo elegido

	$equipo = $_POST['team'];

	if (isset($equipo))
	{
		$equipos = get_records_db("teams","categories != 'borrado' AND id = ".$equipo);

		if (!empty($equipos))
		{
			$equipo = $equipos[0];
			$equipos_res = "";
			$equipos_res = '<div class="created_team_data team_opac">
			                    <div class="row">
			                        <div class="team_label">
			                            Nombre del equipo
			                        </div>
			                        <div class="team_name_input team-nm">
			                            <input type="text" id="team-name-in-mod" value="'.$equipo['name'].'">
			                        </div>
			                    </div>			                    
			                </div>    
			                <div class="team-more-info">
			                    <div class="team-img team-ph">
			                        <img class="img-circle" id="create-team-avatar-mod" src="'.$equipo['id_images'].'" data-name="'.$equipo['id_images'].'">>
			                    </div>
			                    <div hidden>
		                            <input type="file" name="filename_team_mod" id="filename_team_mod" accept="image/jpeg, image/png">
		                        </div>
			                    <div class="team-img upload-ph" id="team-upload-image-mod">
			                        <img class="img-circle" src="img/upload-ph.jpg">
			                    </div>
			                    <div class="team-tag">Avatar</div>
			                    <div class="panel-inferior-team-created">
			                        <div class="img" id="team-upload-image-mod-add">
			                            <img src="../img/add.png">
			                        </div>
			                        <div class="jug-played">
			                            <div id="team-players" class="team_label mode-bottom-left" data-teamid="'.$equipo['id'].'">
			                                    Jugadores
			                            </div>
			                            <div class="team_label mode-bottom-right" data-teamid="'.$equipo['id'].'">
			                                    Partidos Jugados
			                            </div>
			                        </div>
			                        <hr id="hr-team">                        
			                    </div>    
			                    <div class="modif-team">
			                        MODIFICAR EQUIPO
			                    </div>                


			                    <div class="search-and-invite-edit">
			                    	<div id="div-jugadores-team-actuales-mod">
                    				</div>
			                        <div class="team-invite-player">
			                            <div class="team_label tl_bai">
			                                Invitar jugador
			                            </div>
			                            <div class="img">
			                                <img src="../img/gray.png">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="can-acc">
			                       <div class="team-edit te-cancel">CANCELAR</div>
			                       <div class="team-edit te-ok">ACEPTAR</div> 
			                    </div>
			                </div>';
			$response = ['equipos' => $equipos_res];
		}
		else
		{
			$response = ['equipos' => 'none'];
		}
	}
	else
	{
		$response = ['equipos' => 'none'];
	}

    echo json_encode($response);
?>