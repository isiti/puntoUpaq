<div class="show-content" data-section="home">
	<div class="top-for-burger">
		<i class="mdi mdi-menu menu-icon"></i>
		<!--<i id="phone" data-container="body" data-toggle="popover" data-html="true" data-placement="left" title="Llamanos al:" data-content="<a href='tel:+542914556590'>0291-4556590</a>" class="fas fa-phone"></i>!-->
		<a href='tel:4556590'><i id="phone" class="fas fa-phone"></i></a>
	</div>
	<?php if ($_SESSION['is_driver'] == 0) { ?>
		<div class="home-title">
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3" style="padding-top: 15px;text-align: right;padding-left: 50px;">
					<i class="mdi mdi-car car-icon"></i>
				</div>
				<div class="col-xs-7 col-sm-7 col-md-7" style="padding-left: 40px;">
					<span class="text-title">Pedí<br> tu remís</span>
				</div>
			</div> 
		</div>
		<div class="botones-accion-home">
			<div class="btn-accion action-home-btn sec-ident" data-section="ask_now">
				<span>PEDIR AHORA (CORPORATIVO)</span>
			</div>
			<div class="btn-accion action-home-btn sec-ident" data-section="reserve">
				<span>RESERVAR (CORPORATIVO)</span>
			</div>
			<!--<div class="btn-accion action-home-btn sec-ident" data-section="ask_now_flota">
				<span>PEDIR AHORA (FLOTA)</span>
			</div>
			<div class="btn-accion action-home-btn sec-ident" data-section="reserve_flota">
				<span>RESERVAR (FLOTA)</span>
			</div>
			<div class="btn-accion action-home-btn sec-ident" data-section="viajes_especiales">
				<span>VIAJES ESPECIALES</span>
			</div>!-->
		</div>

	<?php } else { ?>

		<div class="botones-accion-home" style="margin-top: 5em;">
			<div style="text-align:center; margin-bottom: 60px;">
				<img width="130" src="img/login_logo2.png" alt="logo">
			</div>
			<div class="btn-accion action-home-btn sec-ident" data-section="mis_viajes" onclick="mis_viajes()">
				<span>Mis viajes</span>
			</div>
		</div>

	<?php } ?>
	<div>
		<input type="hidden" name="viaje_id" id="viaje_id">
		<input type="hidden" name="alias_id" id="alias_id" value="0">	
	</div>
	<div class="modal fade" id="pending_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="position: fixed; width: 100%;">
				<div class="modal-header" style="padding: 9px;">
					<h5 style="float:left"  class="modal-title">Calificaciones pendientes</h5>
					<button style="float:right; font-size: 25px !important;"  id="close_pending" type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-modal-error">
					<p>Hay viajes que todavia no has calificado. Presiona el botón para ver más detalles.</p>
					<button id="btn_pending" class="sec-ident" data-section="mis_viajes" onclick="mis_viajes();">Ver viajes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="choose_name" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="position: fixed; width: 100%;">
				<!-- <div class="modal-header" style="padding: 9px;">
					<h5 style="float:left"  class="modal-title"></h5>
					<button style="float:right; font-size: 25px !important;"  id="" type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div> -->
				<div class="modal-body text-modal-error">
					<p>Seleccione el chofer</p>
					<select name="chofer_name" id="chofer-name" onchange="select_name()">
						<option disabled selected>Elegir</option>
					</select>
					<!-- <button id="" class="sec-ident" data-section="mis_viajes" onclick="mis_viajes();">Ver viajes</button> -->
				</div>
			</div>
		</div>
	</div>
	
</div>
