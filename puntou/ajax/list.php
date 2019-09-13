<?php
  include_once("../includes/config.php");
  error_reporting(-1);

  $flag = $_POST['flag'];
  $array_viajes = [];
  $lista_resultados = [];
  $resultado = [];

  if ($flag == '' || $flag == null || $flag == 'todos') {
    $array_viajes =  get_records_db('travel_logs','');
  }
  else {
    $array_viajes =  get_records_db('travel_logs',"status='".$flag."'");
  }

  function mostrarStatus($viaje){
    if ($viaje == 'en_progreso') {
      return "EN PROGRESO";
    } else {
      return strtoupper($viaje);
    }
  }



  foreach ($array_viajes as $viaje) {

    // si viaje -> app viajes
    if ($viaje['by_app'] == 1 || $viaje['by_app'] == '1') {
      $byapp = "<span class='by_app'><i class='fas fa-mobile-alt'></i></span>";
    } else {
      $byapp = "<span class='by_cms'><i class='fas fa-desktop'></i></span>";
    }

    // si viaje -> cte. cte.
    if ($viaje['is_cc'] == 1 || $viaje['is_cc'] == '1') {
      $cc = "<span class='is_cc'><i class='fas fa-taxi'></i></span>";
    } else {
      $cc = "<span class='is_corp'><i class='fas fa-car'></i></span>";
    }

    // $resultado['id'] = $viaje['id'];
    $resultado[] = "
            <tr class=\"columnas columna$viaje[id]\" data-id_color_columna=\"$viaje[id]\" data-is_new_travel=\"1\">
            <td>".$viaje['id']."</td>
            <td>".$byapp." ".$cc."</td>
              <td>"./*$viaje['fCreacion']*/date("d-m-Y H:i:s", strtotime($viaje['fCreacion']))."</td>
              <td>"./*$viaje['travel_date']*/date("d-m-Y", strtotime($viaje['travel_date']))." - ".$viaje['travel_time']."</td>
              <td>".$viaje['from_address']."</td>
              <td>".$viaje['to_address']."</td>
              <td>".$viaje['amount']."</td>
              <td>".$viaje['observations_general']."</td>
              <td class='btn_estado myBtn color_".$viaje['status']."'><span class='btn_estado_text'>".mostrarStatus($viaje['status'])."</span></td>
            </tr>";
   };

   echo json_encode($resultado,JSON_UNESCAPED_SLASHES);
   ?>
