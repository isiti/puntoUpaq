<?php

   require("config.php");

    $registro = get_records_db("city","id_provinces=".$_GET['id'],"","asc","id");
    $cityes_select = '';
    foreach($registro as $cityes){
        $cityes_select .= '<option value="'.$cityes['id'].'"';
        if (isset($_SESSION) && isset($_SESSION['id_city']) && $_SESSION['id_city']==$cityes['id']) $cityes_select .= ' selected';
        $cityes_select .='>'.$cityes['descripcion'].'</option>';
    }
    
    //$cityes_select= $cityes_select.'</div>';
     echo json_encode($cityes_select); 
    
?>

