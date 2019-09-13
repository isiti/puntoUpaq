<?php
    require("config.php");

    $lista_jugadores = "";

    $res;

    if (isset($_POST['numeroresultados']))
    {
        $res = $_POST['numeroresultados']*2;
    }

    else $res=0;

    // Lista Jugadores

    $lista_jugadores.='<input type="hidden" value="$res" id="players-max-results"></input>';

    $lista_jugadores.= '<div>';

    $lista_jugadores.= '<div class="play-sec-title">
                <div play-sub>Lista jugadores</div>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>';

    $lista_jugadores.= '<div class="play-players">';

    // 1.a. Traigo todos los jugadores

    if ($res!=0)
        $jugadores_activos = get_records_db("users", "", $res);
    else
        $jugadores_activos = get_records_db("users", "");

    foreach ($jugadores_activos as $key => $value) {
        $usuario = $value;

        $lista_jugadores.='<div class="play-in-current">';

        //Placeholder de la foto del jugador
        $lista_jugadores.='<div class="play-img-player">';

        $imagen_usuario;
        if ($usuario['id_images'] != NULL)
        {
            $imagen_usuario = get_db_row($usuario['id_images'],'descripcion','images');
        } 
        else $imagen_usuario = '../matchat/img/gray-small.png';

        $lista_jugadores.= '<img src="'.$imagen_usuario.'">';
        $lista_jugadores.='</div>';

        $lista_jugadores.='<div class="play-info-player">';

        //Datos
        //Nombre

        $lista_jugadores.='<div class="play-player-name">
                    '.$usuario['fullname'].'
                </div>';

        //Posicion
        $position;
        if ($usuario['position'] != NULL)
        {
            $position = $usuario['position'];
        }
        else $position = 'Sin posicion';

        $lista_jugadores.='<div class="play-player-position">
                    '.$position.'
                </div>';

        //Rating (Temporal)

        $lista_jugadores.='<div class="play-player-rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </div>';

        $lista_jugadores.='</div>';

        //Botones de accion

        $lista_jugadores.='<div class="player-write">';

        $lista_jugadores.='    <i class="fa fa-mail-reply" aria-hidden="true"></i>
                </div>';

        $lista_jugadores.='</div>';
    }



    $lista_jugadores.= '</div>';

    $lista_jugadores.= '</div>';

    $resultado['status']='OK';
    $resultado['resultado']=$lista_jugadores;

    echo json_encode($resultado);
?>

