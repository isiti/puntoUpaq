<?php
  include_once("../includes/config.php");
  error_reporting(-1);

  $arrayAllViajes =  get_records_db('travel_logs','');
  $respuesta['nAllViajes'] = count($arrayAllViajes);

  $arrayAgendados =  get_records_db('travel_logs','status="agendado"');
  $respuesta['nAgendados'] = count($arrayAgendados);

  $arrayReservados =  get_records_db('travel_logs','status="reservado"');
  $respuesta['nReservados'] = count($arrayReservados);

  $arrayEnProceso =  get_records_db('travel_logs','status="en_proceso"');
  $respuesta['nEnProceso'] = count($arrayEnProceso);

  $arrayCancelados =  get_records_db('travel_logs','status="cancelado"');
  $respuesta['nCancelados'] = count($arrayCancelados);

  $arrayCompletados =  get_records_db('travel_logs','status="completado"');
  $respuesta['nCompletados'] = count($arrayCompletados);

  $arrayInmediatos =  get_records_db('travel_logs','status="inmediato"');
  $respuesta['nInmediatos'] = count($arrayInmediatos);

  echo json_encode($respuesta);
