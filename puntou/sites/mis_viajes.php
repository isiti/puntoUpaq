<div class="show-content full-height" data-section="mis_viajes">
	<div class="mv-top">
		<span href="" class="closebtn-mv sec-ident" data-section="home">&times;</span>
		<span class="mv-title">Mis Viajes</span>
	</div>
	<div class="mv-tabs">
		<div class="row">
			<div class="col-xs-6 col-md-6 col-sm-6" id="seleccionar-viajes-anteriores">
				<span style="padding-left: 15px;">Viajes Realizados</span>
				<div class="row select-anteriores"></div>
			</div>
			<div class="col-xs-6 col-md-6 col-sm-6" id="seleccionar-viajes-proximos">
				<span style="padding-right: 15px;">Próximos</span>
				<div class="row select-proximos"></div>
			</div>
		</div>
	</div>
	<div class="mv-bottom tab-anteriores">
		<div id="tab_viajes" class="viaje-detalle">
			<!-- <div class="viaje-detalle-lugares">
				<span>Origen - Destino</span>
			</div>
			<div class="viaje-detalle-datos">
				<span>DD/MM/AA 00:00 $00.00</span>
			</div> -->
		</div>
	<?php if ($_SESSION['is_driver'])
		{
	?>
		<!--<div style="display: flex; justify-content: center;">
			<div class="btn-accion sec-ident buscar-nuevo-viaje" data-section="buscar_nuevo_viaje" style="background-color: #1A57A2 !important; color: #FFF !important; margin-bottom: 1em;">
				<span>BUSCAR NUEVO VIAJE</span>
			</div>
		</div>!-->
	<?php	
		}
	?>		
	</div>
	<div class="mv-bottom tab-proximos" hidden="hidden">
		<div id="tab_next" class="viaje-detalle">
			<!-- <div class="viaje-detalle-lugares">
				<span>Origen - Destino</span>
			</div>
			<div class="viaje-detalle-datos">
				<span>DD/MM/AA 00:00 $00.00</span>
			</div> -->
		</div>
	</div>
	<div class="modal fade" id="info_travel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content text-modal" style="position: fixed; background: #ffc526">
			<div id="signup_car" style="width: 90%;">  
				<button style="position:absolute; right: 10px; top: 10px; font-size: 26px !important;"  id="close_info_travel" type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>
				<h2 style="margin-bottom: 25px;">Detalle del viaje</h2>
				<div class="divide_bar" style="margin: auto;"></div>
				<div id="state_travel">
				<table class="table table-borderless">
					<thead>
						<tr>
						<th scope="col">Estado</th>
						<th scope="col" style="text-align: right">Fecha y Hora</th>
						</tr>
					</thead>
					<tbody id="body_state_table">
						
					</tbody>
				</table>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
