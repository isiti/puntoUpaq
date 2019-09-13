<?php

require("config.php");

//$dbConn
$registro = get_records_db("matchs", "", 4, "DESC", "id");
$sql = "";
$div = "<div id='removehome'>";
$limite = 0;
foreach ($registro as $filas) {
    if ($filas['teams_ids'] != null) {
        //echo 'entre';
        $split_teams = explode(',', $filas['teams_ids']);
     
        foreach($split_teams as $key => $value) {
       
            $array_db = array();
            $sql = "select * from users u inner join  players p  on u.id=p.id_users inner join teams t on p.id_teams=t.id ";
            $sql .= " inner join games g on t.id_games=g.id where t.id='$value'";
            foreach($result = mysqli_query($dbConn, $sql) as $row){
				array_push( $array_db,$row );
			}
            /*while ( $row = mysqli_fetch_assoc($result)) {
                array_push( $array_db,$row );
            }
			*/
            //echo $sql;
            
            foreach ($array_db as $value2) {
                if($limite>4) break; //stop foreach
                $div .= ' <div class="item" > <div class="avatar"> </div> <div class="name"> ' . $value2['fullname'] . '</div>';
                $div .= ' <div class="info">Esta jugando al <a class="force-change-tab" data-goto="play"> ' . $value2['descr'] . '</a> en este momento</div>';
                $div .= '<div class="vertical-bar"></div></div>';
                
                $limite++;
            } unset($value2); //foreach2
        } unset($key,$value); //foreach1

    } else {
        $split_users = explode(',', $filas['users_ids']);
        
        foreach($split_users as $key => $value) {
            $registro_users = get_records_db("users", "id=" . $value, 1, "DESC", "id");

            foreach ($registro_users as $usuarios) {
                if($limite>4) break;
                
                $div .= '<div class="item" > <div class="avatar"> </div><div class="name">' . $usuarios['fullname'] . '</div>';
                $div .= '<div class="info"> Esta jugando en este momento </div>';
                $div .= '<div class="vertical-bar"></div></div>';

                $limite++;
            }//foreach2
        }//foreach1
        
    }//else
}
$div .= "</div>";
echo json_encode($div);
?>

