<?php
    require '../config/config.php';

    $action = $_GET['tableName'];

    $arr = array();

    if($action == "users")
    {
        $res = get_records_db("users", "type='user'");
    }
    else if($action == "orders")
    {
        $res = get_records_db("orders");
    }
    else if($action == "cadets")
    {
        $res = get_records_db("users", "type='cadete'");
    }
    
    echo json_encode($res);
?>