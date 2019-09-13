<?php

function provincias(){
    
    
    $registro = get_records_db("provinces","","","asc","id");
    //$provincias_select =' <select name="id_province" onchange="search_ciudades(this.value);">';
    $provincias_select = "";
    foreach($registro as $provincias){
        $provincias_select .= '<option value="'.$provincias['id'].'"';
        if (isset($_SESSION) && isset($_SESSION['id_province']) && $_SESSION['id_province']==$provincias['id']) $provincias_select.=' selected'; 
        $provincias_select .='>'.$provincias['descripcion'].'</option>';
    }
    //$provincias_select= $provincias_select.'</select>';
    
    return $provincias_select;
    
}


function ciudades(){
    
    if (isset($_SESSION['id_province']))
    {
        $registro = get_records_db("city","id_provinces = ".$_SESSION['id_province'],"","asc","id");
        $cityes_select ='';
        foreach($registro as $cityes){            
            $cityes_select .= '<option value="'.$cityes['id'].'"';
            if (isset($_SESSION) && isset($_SESSION['id_city']) && $_SESSION['id_city']==$cityes['id']) $cityes_select .= ' selected';
            $cityes_select .='>'.$cityes['descripcion'].'</option>';            
        }
        
        return $cityes_select;
    }
}

function deportes(){
    
    
    $registro = get_records_db("games","","","asc","id");
    //$provincias_select =' <select name="id_province" onchange="search_ciudades(this.value);">';
    $provincias_select = "";
    foreach($registro as $provincias){
        $provincias_select .= '<option value="'.$provincias['id'].'"';
        if (isset($_SESSION) && isset($_SESSION['id_games']) && $_SESSION['id_games']==$provincias['id']) $provincias_select.=' selected'; 
        $provincias_select .='>'.$provincias['descr'].'</option>';
    }
    //$provincias_select= $provincias_select.'</select>';
    
    return $provincias_select;
    
}

?>
