<?php
ob_start(); // Activa el almacenamiento en búfer de la salida.
session_start(); // Iniciar una nueva sesión o reanudar la existente.
error_reporting(0); // Muestra errores PHP, 0 -> no muestra y -1 lo muestra. 
include("server/config/config.php");


// header.
include("views/includes/header-web.php");

// Login 
if ( !isset($_SESSION['id']) ) { 
	include("views/pages/web-login.php"); 
} else { 
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">

		<!-- navegación-top -->
		<?php include("views/navigation/nav-top.php"); ?>

	</div>
	<div class="col-lg-2 col-md-2 col-xs-12 sidebar">

		<!-- navegación-lateral -->
		<?php include("views/navigation/side-bar.php"); ?>

	</div>
	<div class="col-lg-10 col-md-10 col-xs-12 pages">

		<!-- paáginas -->
		<?php 
			switch ($_GET["go"]) {
				// Cada archivo agregado en index.php tiene que ser agregado en el archivo .htaccess también..				
				case "home":
					include("views/pages/web-home.php");
					break;
												
				default:
				   include("views/pages/web-home.php");
			}			

			// cargo los modals.
			require('components/modal/Modal.php');
		?>

	</div>
</div>
<?php

} // end login
// footer.
include("views/includes/footer-web.php");
ob_end_flush(); // deshabilitar el almacenamiento en el búfer de salida. 
?>
