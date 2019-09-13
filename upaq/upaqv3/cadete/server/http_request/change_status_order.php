<?php

require '../config/config.php';   

$_POST['submit_edit'] = "submit_edit";

($_POST['status'] != 'sin_iniciar') ? $_POST['cadete'] = $_SESSION['id'] : $_POST['cadete'] = 0;

$datos = [
    ["value" => "id"],
    ["value" => "cadete"],
    ["value" => "status"]
];

if($_POST['mode'] == 'upaq'){ $error = get_form_cp($datos, "orders", ""); }
if($_POST['mode'] == 'dow'){ $error = get_form_cp($datos, "dow", ""); }

// var_dump($error);

$to_return = null;

if ($error['status'] == "updated") {
    $to_return = [ "success" => true ];
}else {
    $to_return = [ "success" => false, "error" => $error ];
}    

echo json_encode($to_return);
?>