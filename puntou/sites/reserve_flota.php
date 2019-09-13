<div class="show-content" data-section="reserve_flota">
	<div class="top-for-burger">
		<i class="mdi mdi-menu menu-icon"></i>
	</div>
	<div class="reserve-title">
		<div class="row" style="margin-top: 11%; margin-left: 13%;">
			<div class="col-xs-3 col-sm-3 col-md-3" style="padding-top: 15px;padding-left: 30px;">
				<i class="mdi mdi-calendar car-icon"></i>
			</div>
			<div class="col-xs-7 col-sm-7 col-md-7" style="padding-left: 45px;">
				<span class="text-title-2">Hacé<br> tu reserva</span>
			</div>
		</div> 
	</div>
	<span type="text" name="error-msg-r-f" id="error-msg-r-f" style="display: none; margin-left: 35px;">Por favor, complete los datos.</span>
	<div class="botones-accion-reserva" style="margin-top: 6%;">
		<div>
			<input type="search" placeholder="UBICACION ACTUAL" required="required" name="ubicacion-actual-r-flota" id="ubicacion-actual-r-flota" class="btn-accion action-reserva-btn search-input">
			<div class="completar-ubicacion-actual" style="top:120px !important;"></div>
		</div>
		<div>
			<input type="search" placeholder="¿ADONDE VAS?" autocomplete="off" required="required" name="search_query-3-r" id="autocomplete_ask-r-flota" class="btn-accion action-reserva-btn search-input">
			<div class="autocomplete-suggestions-3" style="position: absolute; width: 85%; top: 180px; left: 25px; max-height: 300px; z-index: 9999;display:none;"></div>
		</div>
		<div class="row">
			<div class="col-xs-5 col-sm-5 col-md-5" style="margin-left: 7%;">
				<!--<span>DD/MM/AA</span>!-->
				<input type="text" name="reservar-viaje-fecha-flota" id="reservar-viaje-fecha-flota" required="required" class="datepicker btn-accion action-reserva-btn-2 date-input">
			</div>
			<div class="col-xs-5 col-sm-5 col-md-5">
				<!--<span>00:00</span>!-->
				<input type="text" name="reservar-viaje-hora-flota" id="reservar-viaje-hora-flota" required="required" class="timepicker btn-accion action-reserva-btn-2 date-input">
			</div>
		</div>
		<div>
			<textarea id="comment-r-flota" name="comment-r-flota" class="btn-accion action-reserva-btn search-input" placeholder="Comentarios?" maxlength="51"></textarea>
		</div>		
		<div class="btn-accion action-reserva-btn-res boton-reservar-ahora-flota" data-section="middle_page_reservar">
			<span>RESERVAR</span>
		</div>		
	</div>
</div>
