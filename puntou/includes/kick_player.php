<?php
  require("config.php");

  $match_id = $_POST['match'];
  $player_id = $_POST['player'];

  $match = get_records_db("matchs","id = $match_id",1);

  $partido = $match[0];

  //Tengo el partido, traido por ID

  //Traigo a los jugadores y a los jugadores verificados
  if ($partido['users_ids']==NULL || $partido['users_ids']=='') $jugadores_no_verificados = array();
    else $jugadores_no_verificados = explode(',', $partido['users_ids']);
  if ($partido['jugadores_verificados']==NULL || $partido['jugadores_verificados']=='') $jugadores_verificados = array();
    else $jugadores_verificados = explode(',', $partido['jugadores_verificados']);
  
  $resultado;

  $esta_verificado = array_search($player_id, $jugadores_verificados);

  if ($esta_verificado !== FALSE)
  {
      //El jugador esta verificado
      unset($jugadores_verificados[$esta_verificado]);
  }
  
  $no_esta_verificado = array_search($player_id, $jugadores_no_verificados);

  if ($no_esta_verificado !== FALSE)
  {
      //El jugador no esta verificado
      unset($jugadores_no_verificados[$no_esta_verificado]);
  }

  //Creo el string para actualizar, y actualizo.

  $lista_v = "";

  foreach ($jugadores_verificados as $key => $value) {
    if ($lista_v == '') $lista_v.=$value;
    else $lista_v.=','.$value;
  }

  $lista_nv = "";

  foreach ($jugadores_no_verificados as $key => $value) {
    if ($lista_nv == '') $lista_nv.=$value;
    else $lista_nv.=','.$value;
  }

  $_POST['id'] = $match_id;
  $_POST['jugadores_verificados'] = $lista_v;
  $_POST['users_ids'] = $lista_nv;
  $_POST['submit_edit'] = 'submit_edit';

  $datos= [['value'=>'jugadores_verificados', 'required'=>0, 'custom'=>''],['value'=>'users_ids', 'required'=>0, 'custom'=>'']];
  $error = get_form_cp($datos,'matchs',"");

  //print_r($error);

  $resultado['return_path'] = 'kick';
  $resultado['id'] = $match_id;

  echo json_encode($resultado); 

?>

