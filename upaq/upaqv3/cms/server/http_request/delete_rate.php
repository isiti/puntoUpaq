<?php
require '../config/config.php';   

// $_POST['submit_edit'] = "submit_edit";

// $datos = [
//     ["value" => "id"],
//     ["value" => "active"]
// ];

// var_dump($datos);

// $error = get_form_cp($datos, "tarifas", "");  


// $to_return=null;

// if ($error['status'] == "updated") {
//     $to_return = [
//         "success" => true
//     ];
// }else {
//     $to_return = [
//         "success" => false,
//         "error" => $error,
//     ];
// }    

$to_return = $_POST['id'];
echo json_encode($to_return);
?>