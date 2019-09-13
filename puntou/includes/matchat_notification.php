<?php
include  "config.php";
session_start();
$usuario;
$registro = get_records_db("users","id=".$_SESSION['id'],1,"asc","id");
foreach($registro as $filas){
    
    $usuario = $filas['fullname'];
}

$registro = get_records_db("notification","id_user=".$_SESSION['id'],4,"DESC","id");

$div = "";
 $div = $div."<div id='remove'>";
foreach($registro as $filas){   
 
   $div = $div.'<div class="item"><i class="fa fa-bell fa-2x notification" aria-hidden="true"></i>';   
   $div = $div.'<div class="name">'.$usuario.'</div>';
   $div = $div.'<div class="info">'.$filas['message'].'</div>';
   $div = $div.'<div class="vertical-bar"></div></div>';   
  
}
  $div = $div."</div>";
 echo json_encode($div);
?>


