<?php
    require("config.php");
    session_start();
    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

    //Empiezo tomando el match que traje por POST

    $status = $_POST['status'];
    $jugadores_activos;
    $jugadores_verificados;
    $match;
    $match_id;

    if ($status == 'first')
    {
        //Es el primer jugador, recupero la sala.
        $match = get_records_db("matchs","room_admin = ".$_SESSION['id']." AND terminado = 'planificando'",1, 'DESC', 'fCreacion');
        $match_id = $match[0]['id'];
        $match = $match[0];
        $jugadores_verificados = array();
    }
    else if ($status == 'join')
    {
        $match_id = $_POST['match'];
        $registro = get_records_db("matchs", "id = $match_id");
        $match = $registro[0];
        if ($match['jugadores_verificados'] == NULL || $match['jugadores_verificados'] == '') $jugadores_verificados=array();
        else $jugadores_verificados = explode(',', $match['jugadores_verificados']);
        $jugadores_maximos = get_db_row($match['game_id'],'amount_players','games');
        if (count($jugadores_verificados) >= $jugadores_maximos) redireccionar('/home');
    }
    else if ($status == 'confirm' || $status == 'kick')
    {
        $match_id = $_POST['match'];
        $registro = get_records_db("matchs", "id = $match_id");
        $match = $registro[0];
        if ($match['jugadores_verificados'] == NULL || $match['jugadores_verificados'] == '') $jugadores_verificados=array();
        else $jugadores_verificados = explode(',', $match['jugadores_verificados']);
    }

    $sala = "";

    // 1. Lista Jugadores

    $sala.= '<div>';

    $sala.= '<div class="play-sec-title" id="lista-jugadores">
                <div play-sub>Lista jugadores</div>
                <i class="fa fa-angle-up flecha-match" aria-hidden="true" id="icono-flecha-jugadores-match"></i>
            </div>';

    $sala.= '<div class="play-players" id="div_jugadores_match">';

    // 1.a. Traigo todos los jugadores

    if ($match['users_ids']==NULL || $match['users_ids']=="") $jugadores_activos = array();
    else $jugadores_activos = explode(',', $match['users_ids']);
    $already_in_match = TRUE;
    if (!in_array($_SESSION['id'], $jugadores_activos))
    {
        $already_in_match = FALSE;
        array_push($jugadores_activos, $_SESSION['id']);
    }

    //print_r($match);
    //print_r($jugadores_activos);

    foreach ($jugadores_activos as $key => $value) {
        $usuario = get_records_db("users", "id = $value");
        $usuario = $usuario[0];

        $sala.='<div class="play-in-current">';

        //Placeholder de la foto del jugador
        $sala.='<div class="play-img-player">';

        $imagen_usuario;
        if ($usuario['id_images'] != NULL)
        {
            $imagen_usuario = get_db_row($usuario['id_images'],'descripcion','images');
        } 
        else $imagen_usuario = '../img/gray-small.png';

        $sala.= '<img src="'.$imagen_usuario.'">';
        $sala.='</div>';

        $sala.='<div class="play-info-player">';

        //Datos
        //Nombre

        $sala.='<div class="play-player-name">
                    '.$usuario['fullname'].'
                </div>';

        //Posicion
        $position;
        if ($usuario['position'] != NULL)
        {
            $position = $usuario['position'];
        }
        else $position = 'Sin posicion';

        $sala.='<div class="play-player-position">
                    '.$position.'
                </div>';

        //Rating (Temporal)

        $sala.='<div class="play-player-rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </div>';

        $sala.='</div>';

        //Botones de accion

        $sala.='<div class="kick-out">';

        if ($_SESSION['id']==$match['room_admin'] && $_SESSION['id']!=$usuario['id'])
            $sala.='<i class="fa fa-minus kick-player" aria-hidden="true" data-player="'.$usuario['id'].'"></i>';
        if (in_array($usuario['id'], $jugadores_verificados))
        $sala.='    <i class="fa fa-check" aria-hidden="true"></i>';

        $sala.='</div>';

        $sala.='</div>';
    }



    $sala.= '</div>';

    $sala.= '</div>';

    //Chat (Placeholder)

    /*$sala.='<div>
            <div class="play-sec-title" id="div-chat">
                <div play-sub>Chat</div>
                <i class="fa fa-angle-up flecha-match" aria-hidden="true" id="icono-flecha-chat-match"></i>
            </div>
            <div class="play-chat" id="div_chat_match">
                <div class="latest1">
                    <div class="latest-name">
                        <span>Nombre 1:</span> No se bancan los trapos! Quién se anima?
                    </div>
                    <div class="latest-message">
                        
                    </div>
                </div>
                <div class="latest2">
                    <div class="latest-name">
                        <span>Nombre 2:</span> Vení que te voy a meter terrible gol en el ángulo Pepe! Nos vemos mañana en la cancha
                    </div>
                    <div class="latest-message">
                        
                    </div>
                </div>
                <div class="talk">
                    Conversar...
                </div>
            </div>
        </div>';*/

    //Informacion de la locacion (Placeholder)

    $sala.='<div>
            <div class="play-sec-title" id="div-info">
               <div play-sub>Información del partido</div>
                <i class="fa fa-angle-up flecha-match" aria-hidden="true" id="icono-flecha-info-match"></i>
            </div>
            <div class="play-game-info" id="div_info_match">
                <div>
                    <img src="../img/gray-small.png">
                </div>
                <div class="play-court-info">
                     <div class="play-court-name fecha-partido-sala-asd">
                        Fecha del partido : '.$match['fecha_partido'].'
                    </div>
                    <div class="play-court-name">
                        Cancha de Pepe
                    </div>
                    <div class="play-court-address">
                        '.$match['cancha'].'
                    </div>
                    <div class="play-court-rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                    <div class="play-court-type">
                        Cancha F'.$match['cant_cancha'].'
                    </div>
                    <div class="play-court-value">
                        Valor cada uno: $'.$match["valor_entrada"].'
                    </div>
                </div>
                <div class="play-location">';
    if ($_SESSION['id']==$match['room_admin']) $sala.='<button id="boton-editar-datos-sala" style="margin-left: 20px;" data-actual="editar" data-match="'.$match['id'].'">Editar</button><br>';

    $sala.='        <i class="fa fa-car" aria-hidden="true"></i>
                </div>
            </div>
        </div>';

    //Boton Compartir

    $sala.='<div>
                <div class="play-sec-confirm" style="background-color:blue">
                    <div id="share-button" data-match="'.$match_id.'">';
    $sala.='Invitar a mis amigos';

    $sala.=        '</div>
                </div>
            </div>';

    //Boton Confirmar

    $sala.='<div>
                <div class="play-sec-confirm">
                    <div id="play-sub" data-match="'.$match_id.'">';
    if (in_array($_SESSION['id'], $jugadores_verificados))
        $sala.='Cancelar Asistencia';
    else $sala.='Confirmar asistencia';

    $sala.=        '</div>
                </div>
            </div>';

    //Boton No voy a ir

    $sala.='<div>
                <div class="play-sec-negate">
                    <div id="play-sub-negate" data-match="'.$match_id.'">';
                    $sala.='No voy a ir';

    $sala.=        '</div>
                </div>
            </div>';

    $resultado['status']='OK';
    $resultado['resultado']=$sala;
    $dt = DateTime::createFromFormat("d/m/Y H:i", $match['fecha_partido']);
    //var_dump($dt);
    //var_dump($match);
    //$resultado['match_date']=strtotime($match['fecha_partido']);
    $resultado['match_date']=$dt->getTimestamp();

    //Agrego al jugador al match.
    if (!$already_in_match)
    {
        $datos= [['value'=>'users_ids', 'required'=>1, 'custom'=>'']];
        if ($match['users_ids']==NULL || $match['users_ids'] == '') $_POST['users_ids']=''.$_SESSION['id'];
        else $_POST['users_ids'] = $match['users_ids'].','.$_SESSION['id'];
        $_POST['id'] = $match_id;
        $_POST['submit_edit'] = 'submit_edit';
        $error = get_form_cp($datos,'matchs',"");
        //var_dump($error);
    }    

    echo json_encode($resultado);
?>

