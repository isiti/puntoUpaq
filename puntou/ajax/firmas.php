<?php
session_start();
include "../includes/config.php";
error_reporting(-1);

// var_dump($_SESSION);

// valor de los ids para formar el nombre de la imagen.
$id_user = (int)$_SESSION['id'];
// $id_pedido = $_POST['id_viaje'];

// valor del string(enBase64) del canvas.
$imgData = $_POST['dataURI'];

$id_viaje = $_POST['travel_id'];




// respuesta del ajax.
$respuesta[0] = $id_user;

// preparo el string y decodifico.
$imgData = str_replace(' ','+',$imgData);
$imgData =  substr($imgData,strpos($imgData,",")+1);
//$respuesta[0] = $imgData;

$imgData = base64_decode($imgData);

if ($imgData == true) {
  $respuesta[1] = "FUNCIONA EL DECODIFICADO";
} else {
  $respuesta[1] = "ERROR CON EL DECODIFICADO";
}

// subo el archivo.
//nombre imagen.

// Solucion momentanea:
//obtengo info del cadete:

$nombre_img = $id_user."-".$id_viaje."-signature.png";
// $nombre_img = "signature.png";

// Ruta donde se guardará la imagen.
$url_web = "../signatures/";
$filePath = $url_web.$nombre_img;

$respuesta[2] = $url_web;
$respuesta[3] = $nombre_img;

// guardo en la base de datos:
$sql_orders = mysqli_query(
  $dbConn,"INSERT INTO logs_signatures (`id_users`, `id_travel_logs`, `url_signature`)
  VALUES ($id_user, $id_viaje, '$filePath')"
);

// Escribe $imgData en el archivo de imagen
$file = fopen($filePath, 'w');
fwrite($file, $imgData);
fclose($file);


echo json_encode($respuesta);

 ?>
