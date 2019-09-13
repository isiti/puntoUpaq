<?php
    require("config.php");
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Empiezo tomando el team que traje por POST

    $inv = $_POST['inv'];

    $resultado = array();

    $invitacion = get_records_db('emergency_invitation', 'categories = "activo" AND id ='.$inv);
    $invitacion = $invitacion[0];


    if ($invitacion['accept_user_id']==NULL)
    {

        $invitacion_e = "";

        $invitacion_e.='<div>                
                            <div class="team_label">
                                Se necesita un jugador urgente para participar en este partido!
                                <br><br>
                                Hora : '.$invitacion['hora'].'<br>
                                Cancha : '.$invitacion['cancha'].'<br>
                            </div>                                         
                        </div>
                        <div class="row" style="margin-top: 35%;">
                            <div class="accept_invitation col-xs-5 col-md-5 col-lg-5" style="margin-left: 30px;" id="aceptar-invitacion-emergencia">                        
                                <div class="img">
                                    <img src="../img/gray.png">
                                </div>
                                <div class="team_label">
                                    Si
                                </div>                                    
                            </div>
                            <div class="reject_invitation col-xs-5 col-md-5 col-lg-5" id="rechazar-invitacion-emergencia">                
                                <div class="img">
                                    <img src="../img/gray.png">
                                </div>
                                <div class="team_label">
                                    No
                                </div>                        
                            </div>
                        </div>' ;

        $resultado['status']='OK';
        $resultado['resultado']=$invitacion_e;        
    }
    else
    {
        $resultado['status']='error';
        $resultado['resultado']='<div>                
                                    <div class="team_label">
                                        Lo siento, el lugar ya fue ocupado.
                                    </div>                                                                                  
                                </div>';
    }  

    echo json_encode($resultado);
?>

