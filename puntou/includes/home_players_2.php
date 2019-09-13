<?php

    require("config.php");
    session_start();

    //Primero, busco los partidos en los que soy un jugador confirmado (por ahora). Estas notificaciones van siempre primero.

    $registro = get_records_db("matchs", "terminado = 'planificando' AND FIND_IN_SET('".$_SESSION['id']."', jugadores_verificados)");

    $div = "<div id='removehome'>";

    foreach ($registro as $filas) {
        $dia = $filas['fecha_partido'];
        $fecha = explode(' ', $dia);

        $div .= '<div class="item"> <div class="avatar"> </div><div class="name">'.$_SESSION['fullname'].'</div>';
        $div .= '<div class="info"> Acordate que tenes un partido el '.$fecha[0].' a las '.$fecha[1].' en '.$filas['cancha'].' </div>';
        $div .= '<div class="vertical-bar"></div></div>';
    }

    $registro = get_records_db("notification", "id_user = ".$_SESSION['id']);

    foreach ($registro as $filas) {
        $div .= '<div class="item"> <div class="avatar"> </div><div class="name">'.$_SESSION['fullname'].'</div>';
        $div .= '<div class="info"> '.$filas['message'].' </div>';
        $div .= '<div class="vertical-bar"></div></div>';
    }  

    $div .= "</div>";
    echo json_encode($div);
?>

