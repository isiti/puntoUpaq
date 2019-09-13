<?php
   require("functions_rooms.php");

   //Traigo el juego, y por consiguiente, la cantidad de jugadores

   $game = $_POST['game'];
   $games = get_records_db("games","descr = '$game'");
   $games = $games[0];
   $game_id = $games['id'];
   //$game_player = $games['amount_players'];

   //Prueba (Horrible) Numero de jugadores en una sala
   //$sql_dif = "(LENGTH(users_ids) - LENGTH(REPLACE(users_ids, ',', ''))+1)";

   //Un match valido para unirse es una cuyo deporte sea el elegido y cuyo estado es 'planificando' y los jugadores en la sala son menores al total necesario.

   //$query = "game_id = $game_id AND completado = 0 AND terminado = 'planificando'";

   //$registro = get_records_db("match",$query,1);

   $registro = check_for_rooms($game_id);   

   //Pregunto si hay matches validas   

   if ($registro != NULL)
   {
        //echo '1';
        //En registro esta un match valido. Agrego al jugador.
        /*$registro = $registro[0];
        $_POST['id'] = $registro['id'];
        $_POST['users_ids'] = $registro['users_ids'].",".$_SESSION['id'];
        //$_POST['submit-edit'] = 'submit-edit';
        $_POST['submit_edit'] = 'submit_edit';
        $datos = [['value'=>'users_ids','required'=>1,'custom'=>""]];
        $error = get_form_cp($datos,"match");
        //$sql = "UPDATE `match` SET users_ids = '".$registro['users_ids'].",".$_SESSION['id']."' WHERE id = ".$registro['id'];
        //$retval = mysqli_query($sql, $dbConn);
        $resultado['status']='Join';
        $resultado['resultado']=$registro['id'];
        echo json_encode($resultado);*/

        $response = [
            'id' => $registro['id'],
            'return_path' => 'join'
        ];

        echo json_encode($response);
   }
   else
   {
        //No hay salas validas. Espero un tiempo, si siguen sin haber salas, creo una.
        usleep(mt_rand(1000,1500));
        $registro = check_for_rooms($game);

        if ($registro!=NULL)
        {
            $response = [
                'id' => $registro['id'],
                'return_path' => 'join'
            ];

            echo json_encode($response);
        }
        else
        {
            //Creo una nueva sala
            $datos = [
                ['value'=>'room_admin', 'required'=>1, 'custom'=>''],
                ['value'=>'game_id', 'required'=>1, 'custom'=>''],
                ['value'=>'fecha_partido', 'required'=>1, 'custom'=>''],
                ['value'=>'cancha', 'required'=>1, 'custom'=>''],
                ['value'=>'terminado', 'required'=>1, 'custom'=>'']
            ];

            $_POST['room_admin'] = $_SESSION['id'];
            $_POST['game_id'] = $game_id;
            $_POST['terminado'] = 'planificando';
            $_POST['submit'] = 'submit';
            $_POST['fecha_partido'] = date('d/m/Y H:i', time()+3600*3);
            $_POST['cancha'] = "Cancha a definir";

            $error = get_form_cp($datos,'matchs',"");

            //Recupero el ID del match que acabo de crear

            //$match = get_records_db("match","room_admin = ".$_SESSION['id']." AND terminado = 'planificando'",1, 'DESC', 'fCreacion');

            //print_r($match);

            $response = [
                'id' => 0,
                'return_path' => 'first'
            ];

            echo json_encode($response);
        }
   }
?>

