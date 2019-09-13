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

  $user_id = $_SESSION['id'];

  //$actualizar_datos = FALSE;

  $resultado;

  //print_r($jugadores_verificados);
 
  $esta_verificado = array_search($user_id, $jugadores_verificados);

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
  else
  {
      array_push($jugadores_verificados, $user_id);
      //$actualizar_datos = TRUE;
  }

  //Creo el string para actualizar, y actualizo.

  $lista = "";

  foreach ($jugadores_verificados as $key => $value) {
    if ($lista == '') $lista.=$value;
    else $lista.=','.$value;
  }

  $_POST['id'] = $match_id;
  $_POST['jugadores_verificados'] = $lista;
  $_POST['submit_edit'] = 'submit_edit';

  $datos= [['value'=>'jugadores_verificados', 'required'=>0, 'custom'=>'']];
  $error = get_form_cp($datos,'matchs',"");

  //print_r($error);

  $resultado['return_path'] = 'confirm';
  $resultado['id'] = $match_id;

  echo json_encode($resultado); 

?>

