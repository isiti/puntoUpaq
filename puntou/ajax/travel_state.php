<?php 
session_start();
include "../includes/config.php";

$id_viaje = $_POST['id_viaje'];

if (!empty($id_viaje))
{
    //$hay_algo = TRUE;
    // $datos = get_records_db('travel_state_history',"travel_id LIKE '%$id_viaje%'");

    $sql = "SELECT * FROM travel_state_history WHERE travel_id LIKE '%$id_viaje%' ORDER BY fModificacion";
    $datos = mysqli_query($dbConn, $sql);

    if (!empty($datos))
    {
        foreach ($datos as $key2 => $value) {
            if ($value["status"] == "en_progreso") {
                $value["status"] = "en progreso";
            }
            if ($value["status"] == "inmediato") {
                $value["status"] = "agendado";
            }

            $new_date = date("d-m-Y", strtotime($value["fModificacion"]));

            $content .=  '   <tr>
                                <td style="text-align: left; text-transform: uppercase;">'.$value["status"].'</td>
                                <td style="text-align: right;">'.$new_date.' - '.$value["change_date"].'</td>
                            </tr>
                        ';
        }
        $respuesta['content'] = $content;
        $respuesta['status'] = "ok";
    } else {
        $respuesta['status'] = "no ok";
    }  
} else {
    $respuesta['status'] = "no hay viaje";
}

echo json_encode($respuesta);

?>