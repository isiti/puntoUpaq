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
	<div class="col-lg-12 col-md-12 col-xs-12 sidebar section-pages">

		<!-- navegación-lateral -->
		<?php include("views/navigation/side-bar.php"); ?>

	
		<div class="pages">

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
			?>
		</div>
	</div>
</div>
<?php

} // end login
// footer.
include("views/includes/footer-web.php");
ob_end_flush(); // deshabilitar el almacenamiento en el búfer de salida. 
?>
