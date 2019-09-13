<?php 
session_start();
include "../includes/config.php";

$id_user = (int)$_SESSION['id'];
$is_driver = get_db_row($id_user, "is_driver", "users");
$response;

if ($is_driver == 0) {
    $sql = " SELECT * FROM travel_logs WHERE id_users LIKE '%$id_user%' ";
    $db_reviews = mysqli_query($dbConn, $sql);

    if( ($db_reviews->num_rows)>0 ) {
        $response['status'] = 'ok';
        foreach($db_reviews as $key => $value){
            if ($value['id_review_pasajero'] == 0) {
                $response['pendiente'] = 'si';
            }
        }
    } else {
        $response['status'] = 'no ok';
    }

    echo json_encode($response);

}

?>