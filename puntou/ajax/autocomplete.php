<?php
require("../includes/config.php");
session_start();
//Variable de búsqueda
$consultaBusqueda = mysqli_real_escape_string($dbConn,strip_tags($_POST['valorBusqueda']));

$ubicacionactual = FALSE;

if (isset($_POST['ubi_ac']) && $_POST['ubi_ac']=='si') $ubicacionactual = TRUE;

$otroArray = array();

$hay_algo = FALSE;

$return = "";

$direcciones_ya_ingresadas = "(";

//echo $consultaBusqueda;

//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda))
{
	if ($ubicacionactual && $consultaBusqueda=='')
	{
		$return.= '<li data-index="ua"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">Ubicación Actual</span></li>';
	}
	else
	{
		//Primero reviso si esta ingresando una categoria antes de una calle, esto es opcional
		$tipos = get_records_db('address_type',"description LIKE '%$consultaBusqueda%'",1,'ASC','id');
		//var_dump($tipos);
		if (!empty($tipos))
		{
			//$hay_algo = TRUE;
			$direcciones = get_records_db('addresses_saved',"type = ".$tipos[0]['id']." AND id_users = ".$_SESSION['id']);
			if (!empty($direcciones))
			{
				$hay_algo = TRUE;
				foreach ($direcciones as $key2 => $value2) {
					if ($tipos[0]['id']==1)
					{
						$return .= '<li data-index="'.$value2['id'].'"><i class="fa fa-home opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$value2['address'].'</span></li>';
					}
					else if ($tipos[0]['id']==2)
					{
						$return .= '<li data-index="'.$value2['id'].'"><i class="mdi mdi-briefcase opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$value2['address'].'</span></li>';
					} 
					else if ($tipos[0]['id']==3)
					{
						$return .= '<li data-index="'.$value2['id'].'"><i class="fa mdi mdi-star opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$value2['address'].'</span></li>';
					}
					if ($direcciones_ya_ingresadas == "(")
					{
						$direcciones_ya_ingresadas.=$value2['id'];
					}
					else
					{
						$direcciones_ya_ingresadas.=','.$value2['id'];
					}
				}			
			}
		}

		$direcciones_ya_ingresadas.=")";

	    $query = "SELECT * FROM addresses_saved WHERE address LIKE '%$consultaBusqueda%' ";
	    if ($direcciones_ya_ingresadas != "()")
	    {
	    	$query .= " AND id NOT IN $direcciones_ya_ingresadas";
	    }

	    $records = mysqli_query($dbConn, $query);    
		
		if( ($records->num_rows)>0 ) {
			$hay_algo = TRUE;
			foreach($records as $key => $rows){
				if ($rows['type']==1)
				{
					$return .= '<li data-index="'.$rows['id'].'"><i class="fa fa-home opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$rows['address'].'</span></li>';
				}
				else if ($rows['type']==2)
				{
					$return .= '<li data-index="'.$rows['id'].'"><i class="mdi mdi-briefcase opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$rows['address'].'</span></li>';
				} 
				else if ($rows['type']==3)
				{
					$return .= '<li data-index="'.$rows['id'].'"><i class="fa mdi mdi-star opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">'.$rows['address'].'</span></li>';
				}
			}
		}

		if ($ubicacionactual)
		{
			$return.='<li data-index="ua"><i class="fa mdi mdi-map-marker opcion-reserva" style="font-size: 25px;padding: 10px;"></i> <span class="opcion-reserva">Ubicacion Actual</span></li>';
		}
		
		if (!$hay_algo && !$ubicacionactual)
		{
			$return .= "<li id='auto-suggest' data-index='none' data-text='$consultaBusqueda'>";
			$return .= "Ingresar <strong>$consultaBusqueda</strong></li>";
		}
	}
} else return "error";

echo $return;
return;
?>