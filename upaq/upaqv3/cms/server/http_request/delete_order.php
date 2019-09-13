<?php
require '../config/config.php';   

$_POST['submit_edit'] = "submit_edit";
$_POST['id'] = $_GET['id'];
$_POST['active'] = 'n';

$datos = [
    ["value" => "id", "type" => "number"],
    ["value" => "active"],
];

$error = get_form_cp($datos, "dow", ""); 

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