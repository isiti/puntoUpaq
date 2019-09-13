<?php
    session_start();
    include "../includes/config.php";

    $id_user = (int)$_SESSION['id'];

    $name_user = get_db_row($id_user, "fullname", "users");

    $div_name .= ' <span class="sidebar-top-nombre">'.$name_user.'<br></span> ';
    
    $resultado['datos'] = $div_name ;

    echo json_encode($resultado);
?>