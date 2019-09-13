<?php
	require("config.php");
   session_start();

	function check_for_rooms($game_id)
	{
		$query = "game_id = $game_id AND completado = 0 AND terminado = 'planificando' AND id NOT IN (".$_SESSION['ignored_games'].")";
   		$registro = get_records_db("matchs",$query,1);
   		$resultado=NULL;
   		if (!empty($registro))
   		{
   			$resultado = $registro[0];
   		}
   		return $resultado;
	}
?>