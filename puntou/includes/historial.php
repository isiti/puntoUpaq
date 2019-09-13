<?php
    require("config.php");

    //Voy a suponer que un jugador solo puede pertenecer a un equipo.
    $resultado;

    if (isset($_SESSION))
    {
        $jugador = $_SESSION['id'];
        $equipo_id = $_SESSION['id_team'];
        if ($equipo_id != NULL)
        {
            $id_game = get_db_row($equipo_id, 'id_games', 'teams');
            $nombre_juego = get_db_row($id_game, 'descr', 'games');
            $registro = get_records_db("matchs", "(FIND_IN_SET('$equipo_id', teams_ids) <> 0 OR FIND_IN_SET('$jugador', users_ids)<> 0)", 4, "DESC", "fModificacion");
        }
        else 
            $registro = get_records_db("matchs", "FIND_IN_SET('$jugador', users_ids)<> 0", 4, "DESC", "fModificacion");

        // Lista los partidos en los que participo el jugador o el equipo del jugador
        
        $historial = "";

        foreach ($registro as $key => $value) 
        {
            if ($equipo_id != NULL)
            {
                $historial.= '<div class="item"><div class="avatar_historial"></div><div class="info">Jugó al <a class="force-change-tab" data-goto="play">'.$nombre_juego.'</a> hace un momento.</div><div class="vertical-bar-historial"></div></div>';   
            }
            else
            {
                $historial.= '<div class="item"><div class="avatar_historial"></div><div class="info">Jugó hace un momento.</div><div class="vertical-bar-historial"></div></div>';
            }        
        }

        $resultado['estado']='OK';
        $resultado['resultado']=$historial;
    }
    else
    {
        $resultado['estado']='Error';
        $resultado['resultado']="";   
    }

    echo json_encode($resultado);
?>

