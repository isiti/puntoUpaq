<?php
  require("config.php");

  $match_id = $_POST['match'];

  $match = get_records_db("matchs","id = $match_id",1);

  $partido = $match[0];

  //Tengo el partido, traido por ID

  //Traigo a los jugadores y a los jugadores verificados
 if ($partido['jugadores_verificados']==NULL || $partido['jugadores_verificados']=='') $jugadores_verificados = array();
  else $jugadores_verificados = explode(',', $partido['jugadores_verificados']);
  
  //Tengo los arreglos, ahora tengo que ver donde esta el usuario

  if ($partido['users_ids']==NULL || $partido['users_ids']=='') $jugadores = array();
  else $jugadores = explode(',', $partido['users_ids']);

  $user_id = $_SESSION['id'];

  //$actualizar_datos = FALSE;

  $resultado;

  //print_r($jugadores_verificados);
 
  $esta_verificado = array_search($user_id, $jugadores_verificados);

  $esta = array_search($user_id, $jugadores);

  //print_r($esta_verificado);
  if ($esta_verificado !== FALSE)
  {
      //El jugador esta verificado
      //Por lo tanto se esta desverificando, lo saco de verificados
      //echo 'entre';
      unset($jugadores_verificados[$esta_verificado]);
      //$actualizar_datos = TRUE;
      //print_r($jugadores_verificados);
  }

  if ($esta !== FALSE)
  {
      unset($jugadores[$esta_verificado]);
  }



  //Creo el string para actualizar, y actualizo.

  $lista = "";
  $lista_2 = "";

  foreach ($jugadores_verificados as $key => $value) {
    if ($lista == '') $lista.=$value;
    else $lista.=','.$value;
  }

  foreach ($jugadores as $key => $value) {
    if ($lista_2 == '') $lista_2.=$value;
    else $lista_2.=','.$value;
  }

  if (!isset($_SESSION['ignored_games']) || $_SESSION['ignored_games']=="") $ig = $match_id;
  else $ig.=",".$match_id;

  $sql = "UPDATE users SET ignored_games = '".$ig."' WHERE id = ".$_SESSION['id'];
  mysqli_query($dbConn, $sql);

  $_POST['id'] = $match_id;
  $_POST['jugadores_verificados'] = $lista;
  $_POST['users_ids'] = $lista_2;
  $_POST['submit_edit'] = 'submit_edit';

  $datos= [['value'=>'jugadores_verificados', 'required'=>0, 'custom'=>''],['value'=>'users_ids', 'required'=>0, 'custom'=>'']];
  $error = get_form_cp($datos,'matchs',"");

  //print_r($error);

  $resultado['return_path'] = 'confirm';
  $resultado['id'] = $match_id;

  echo json_encode($resultado); 

?>

