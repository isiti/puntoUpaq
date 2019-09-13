<?php
	session_start();
	ob_start();
	// Debug: change to false to show login and signup pages
    require 'includes/config.php';
    //error_reporting(E_ALL); ini_set('display_startup_errors',1);ini_set('display_errors',1);
	//$logged = true;
	if(isset($_SESSION['email'])) {$logged = true;}
	else if (isset($_GET['code'])) { $recovery=true; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>Punto U</title>
	<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'/>
	<link href="https://fonts.googleapis.com/css?family=Dosis:400,600,700" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- notifications -->
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	
	<?php if ($logged): ?>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
	<link href="css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/styleFirmas.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="includes/awesome-markers/leaflet.awesome-markers.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   		integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  	 	crossorigin=""/>
  	<link rel="stylesheet" href="includes/routing-machine/leaflet-routing-machine.css" />
		<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
		<link rel="stylesheet" href="jquery-ui/jquery-ui.structure.min.css">
		<link rel="stylesheet" href="jquery-ui/jquery-ui.theme.min.css">
		<link rel="stylesheet" href="css/wickedpicker.min.css">
		<link rel="stylesheet" href="css/bootstrap-timepicker.css">
		<link rel="stylesheet" href="css/timepicker.less">
	<?php else: ?>
	<link rel="stylesheet" href="css/style-land.css">
	<?php endif; ?>
    
</head>
<body>

<?php if ($recovery): ?>
	<div class="container">
		<div class="error"></div>
		<div class="panel">
			<?php // Main logout sites ?>
			<?php include('sites/new-pass.php'); ?>
		</div>
	</div>
<?php else: if (!$logged): ?>
	<div class="container">
		<div class="panel">
			<?php // Main logout sites ?>
			<?php include('sites/splash.php'); ?>
			<?php include('sites/login.php'); ?>
			<?php include('sites/signup.php'); ?>
			<?php include('sites/forgot.php'); ?>
			<div hidden="hidden">
				<a target="_BLANK" href="https://www.nexosmart.com.ar/?gtm=campaign_footer&site=">
					<img src="img/logo-footer-197x32.png" alt="NexoSmart - ECommerce and Tech Development - Software Integral" width="192px" height="32px">
				</a>
			</div>
		</div>		
	</div>
<?php else: ?>
	<div class="container">
		<div class="content full-height">
			<div id="mySidenav" class="sidenav">
				<div class="sidebar-top">
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<span class="sidebar-top-nombre"></span>
					<span class="sidebar-top-empresa"><?php if ($_SESSION['empresa']!=NULL) echo $_SESSION['empresa']; ?></span>
				</div>
				<div class="sidebar-bottom">
					<div class="sidebar-bottom-links">
						<div>
							<span id="back_inicio" class="sec-ident">Inicio</span>	
						</div>
						<div style="margin-top: 20%;">
							<span class="sec-ident" data-section="mis_viajes" onclick="closeNav(); mis_viajes()">Tus Viajes</span>	
						</div>
						<!--<div style="margin-top: 20%;">
							<<span class="sec-ident" data-section="configuracion" onclick="closeNav()">Configuración</span>	
						</div>!-->
						<?php
							if ($_SESSION['is_driver'] == 1)
							{
						?>
						<div style="margin-top: 20%;">
							<span id="viaje_prueba" name="viaje_prueba">Viaje de Prueba</span>	
						</div>
						<?php
							}
						?>
						<div style="margin-top: 20%;">
							<a href="?logout=true" id="close_session"><span class="sec-ident">Cerrar Sesión</span></a>
						</div>
					</div>
					<div class="sidebar-bottom-logo">
						<img src="img/punto_u.gif">
					</div>	
				</div>				
			</div>
			<?php // Main sites ?>
			<?php include('sites/home.php'); ?>
			<?php include('sites/reserve.php'); ?>
			<?php include('sites/ask_now.php'); ?>
			<?php include('sites/reserve_flota.php'); ?>
			<?php include('sites/ask_now_flota.php'); ?>
			<?php include('sites/viajes_especiales.php'); ?>
			<?php include('sites/middle_page_reservar.php'); ?>
			<?php include('sites/middle_page_ask_now.php'); ?>
			<?php include('sites/driver_outside.php'); ?>
			<?php include('sites/travel_canceled.php'); ?>
			<?php include('sites/progress.php'); ?>
			<?php include('sites/reserved_ok.php'); ?>
			<?php include('sites/viaje_calificar.php'); ?>
			<?php include('sites/viaje_firma.php'); ?>
			<?php include('sites/viaje_vale.php'); ?>
			<?php include('sites/mis_viajes.php'); ?>
			<?php include('sites/buscar_nuevo_viaje.php'); ?>
			<?php include('sites/finalizar_viaje.php'); ?>
			<?php include('sites/configuracion.php'); ?>
            <?php // Home child ?>
			<?php include('sites/others/notifications.php'); ?>

		</div>
	</div>
	<div class="container curtain">
	    
	</div>
	<div class="container curtain" id="loader-reserva">
	    <div class="lds-css ng-scope" style="margin: 20%;">
			<div class="lds-blocks" style="100%;height:100%"><div style="left:38px;top:38px;animation-delay:0s"></div><div style="left:80px;top:38px;animation-delay:0.125s"></div><div style="left:122px;top:38px;animation-delay:0.25s"></div><div style="left:38px;top:80px;animation-delay:0.875s"></div><div style="left:122px;top:80px;animation-delay:0.375s"></div><div style="left:38px;top:122px;animation-delay:0.75s"></div><div style="left:80px;top:122px;animation-delay:0.625s"></div><div style="left:122px;top:122px;animation-delay:0.5s"></div></div>
			<style type="text/css">@keyframes lds-blocks {
			  0% {
			    background: #fdfdfe;
			  }
			  12.5% {
			    background: #fdfdfe;
			  }
			  12.625% {
			    background: #109ad7;
			  }
			  100% {
			    background: #109ad7;
			  }
			}
			@-webkit-keyframes lds-blocks {
			  0% {
			    background: #fdfdfe;
			  }
			  12.5% {
			    background: #fdfdfe;
			  }
			  12.625% {
			    background: #109ad7;
			  }
			  100% {
			    background: #109ad7;
			  }
			}
			.lds-blocks {
			  position: relative;
			}
			.lds-blocks div {
			  position: absolute;
			  width: 40px;
			  height: 40px;
			  background: #109ad7;
			  -webkit-animation: lds-blocks 1s linear infinite;
			  animation: lds-blocks 1s linear infinite;
			}
			.lds-blocks {
			  width: 200px !important;
			  height: 200px !important;
			  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			}
			</style></div>
	</div>
	<div class="container curtain" id="loader-pedir">
	    <div class="lds-css ng-scope" style="margin: 20%;">
			<div class="lds-blocks" style="100%;height:100%"><div style="left:38px;top:38px;animation-delay:0s"></div><div style="left:80px;top:38px;animation-delay:0.125s"></div><div style="left:122px;top:38px;animation-delay:0.25s"></div><div style="left:38px;top:80px;animation-delay:0.875s"></div><div style="left:122px;top:80px;animation-delay:0.375s"></div><div style="left:38px;top:122px;animation-delay:0.75s"></div><div style="left:80px;top:122px;animation-delay:0.625s"></div><div style="left:122px;top:122px;animation-delay:0.5s"></div></div>
			<style type="text/css">@keyframes lds-blocks {
			  0% {
			    background: #fdfdfe;
			  }
			  12.5% {
			    background: #fdfdfe;
			  }
			  12.625% {
			    background: #109ad7;
			  }
			  100% {
			    background: #109ad7;
			  }
			}
			@-webkit-keyframes lds-blocks {
			  0% {
			    background: #fdfdfe;
			  }
			  12.5% {
			    background: #fdfdfe;
			  }
			  12.625% {
			    background: #109ad7;
			  }
			  100% {
			    background: #109ad7;
			  }
			}
			.lds-blocks {
			  position: relative;
			}
			.lds-blocks div {
			  position: absolute;
			  width: 40px;
			  height: 40px;
			  background: #109ad7;
			  -webkit-animation: lds-blocks 1s linear infinite;
			  animation: lds-blocks 1s linear infinite;
			}
			.lds-blocks {
			  width: 200px !important;
			  height: 200px !important;
			  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			}
			</style></div>
	</div>
<?php endif; endif;?>

	<script src="js/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="js/functions-c277c26f3f.js"></script>

<?php if (!$logged): ?>
	<script>
		console.log("llegue");
		$(document).ready(function(){
			setTimeout(function () {
		      	change_section("home");
		       	console.log("entre");
		    }, 2500);
		});
	</script>
<?php endif;?>
<?php if ($logged && $_SESSION['is_driver']): ?>
	<script type="text/javascript">
		console.log("buscando...");
		buscar_viajes_nuevos();
	</script>
<?php endif;?>	

	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.js"></script>
	<script src="js/autocomplete.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="js/geocode.js"></script>
	<script src="js/signature_pad.umd.js"></script>
	<script src="js/wickedpicker.min.js"></script>
	<script src="jquery-ui/jquery-ui.min.js"></script>
	<script src="js/bootstrap-timepicker.min.js"></script>
<?php
	if ($logged):
?>
	<script src="js/app.js"></script>
<?php
	endif;
?>
<script>
		$(document).ready(function(){
		   // $('[data-toggle="tooltip"]').tooltip();
		   $("body").tooltip({ selector: '[data-toggle=tooltip]' });
		   $(function() {
			  $('.selectpicker').selectpicker();
			});
		   $(".menu-icon").click(function(){
		   		openNav();
		   });

		   console.log("Entre aca?");

		   var OneSignal = window.OneSignal || [];
			OneSignal.push(function() {
		    	OneSignal.init({
		      		appId: "3397c8d9-1d4c-44c6-9b66-c999b268f84f",
		      		autoRegister: false,
		      		notifyButton: {
		        		enable: true,
		      		},
	    		});
	  		});	   	
<?php
	if ($logged):
?>
	  		OneSignal.isPushNotificationsEnabled().then(function(isPushEnabled) {
		      	// user has subscribed
		      	OneSignal.getUserId( function(userId) {
		        	console.log('player_id of the subscribed user is : ' + userId);
		          	//alert('player_id of the subscribed user is : ' + userId);
		          	$.ajax({
						url: 'includes/update_onesignal_id.php',
						type: 'POST',
						data: {id:userId},
						success:function(data)
						{
							console.log(data);
							//alert(data);
							//$("#log").html(data);
						},
						error: function(jqXHR, textStatus, error){
							console.log(jqXHR);
							//alert(error);
							//$("#log").html(error);
						}
					});
		      	});
			});
<?php
	endif;
?>
		});
	</script>
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
	   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
	   crossorigin=""></script>
	<script type="text/javascript" src="includes/routing-machine/leaflet-routing-machine.js"></script>   
   	<script src="includes/awesome-markers/leaflet.awesome-markers.js"></script>
   	<script type="text/javascript" src="includes/bouncing-markers/leaflet.smoothmarkerbouncing.js" />

	



</body>
</html>
