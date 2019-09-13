<?php
require '../config/config.php';   

$_POST['submit_edit'] = "submit_edit";

$datos = [
    ["value" => "id"],
    ["value" => "tipo"],
    ["value" => "monto"],
    ["value" => "monto2"]
];

$error = get_form_cp($datos, "tarifas", ""); 

$to_return=null;

if ($error['status'] == "updated") {
    $to_return = [
        "success" => true
    ];
}else {
    $to_return = [
        "success" => false,
        "error" => $error,
    ];
}    
echo json_encode($to_return);

?>