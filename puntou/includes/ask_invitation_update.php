<?php
    require("config.php");
    session_start();
    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

    //Empiezo tomando el team que traje por POST

    $team = $_POST['team'];
    $jugador = $_POST['jugador'];

    $resultado = array();

    $jugador_que_pide = get_records_db("users","id = ".$jugador);
    $jugador_que_pide = $jugador_que_pide[0];

    //Traigo los equipos a los que ya pertenezco
    $equipos_actuales = $jugador_que_pide['id_team'];

    if ($equipos_actuales == NULL || $equipos_actuales == '') $equipos=array();
        else $equipos = explode(',', $equipos_actuales);

    if ($equipos_actuales == "" || $equipos_actuales == NULL || !in_array($team, $equipos))
    {

        $team_actual=get_records_db('teams', 'categories = "activo" AND id ='.$team);

        if (!empty($team_actual))
        {
            $team_actual=$team_actual[0];

            $invitacion = "";

            $invitacion.='<div>
                            <div class="team_label">
                                  Fuiste invitado por el equipo '.$team_actual['name'].'. Quieres pertenecer a este equipo?
                            </div>
                            <div class="team-img">
                                <img class="img-circle" src="'.$team_actual['id_images'].'">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 35%;">
                            <div class="accept_invitation col-xs-5 col-md-5 col-lg-5" style="margin-left: 30px;" id="aceptar-invitacion-equipo" data-teamid="'.$team_actual['id'].'">
                                <div class="img">
                                    <img src="../img/gray.png">
                                </div>
                                <div class="team_label">
                                    Si
                                </div>
                            </div>
                            <div class="reject_invitation col-xs-5 col-md-5 col-lg-5" id="rechazar-invitacion-equipo" data-teamid="'.$team_actual['id'].'">
                                <div class="img">
                                    <img src="../img/gray.png">
                                </div>
                                <div class="team_label">
                                    No
                                </div>
                            </div>
                        </div>' ;

            $resultado['status']='OK';
            $resultado['resultado']=$invitacion;
        }
        else
        {
            $resultado['status']='error';
            $resultado['resultado']='<div>
                                        <div class="team_label">
                                              El equipo que lo invito no se encuentra disponible.
                                        </div>
                                    </div>';
        }

    }
    else
    {
        if (in_array($team, $equipos))
        {
            $resultado['status']='error';
            $resultado['resultado']='<div>
                                        <div class="team_label">
                                              El jugador ya pertenece a este equipo.
                                        </div>
                                    </div>';
        }
    }

    echo json_encode($resultado);
?>
