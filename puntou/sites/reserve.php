<div class="show-content" data-section="reserve">
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
	<span type="text" name="error-msg-r" id="error-msg-r" style="display: none; margin-left: 35px;">Por favor, complete los datos.</span>
	<div class="botones-accion-reserva" style="margin-top: 6%;">
		<!--<div class="btn-accion action-reserva-btn">
			<select class="selectpicker" data-style="reserva-select" data-title="ORIGEN">
				<option data-content="<i class='fa fa-home opcion-reserva'></i> <span class='opcion-reserva'>Agregar Casa</span>">Agregar Casa</option>
				<option data-divider="true"></option>
				<option data-content="<i class='mdi mdi-briefcase opcion-reserva'></i> <span class='opcion-reserva'>Agregar Trabajo</span>">Agregar Trabajo</option>
				<option data-divider="true"></option>
				<option data-content="<i class='mdi mdi-star opcion-reserva'></i> <span class='opcion-reserva'>Agregar Otra</span>">Agregar Otra</option>
				<option data-divider="true"></option>
				<option data-content="<i class='mdi mdi-map-marker opcion-reserva'></i> <span class='opcion-reserva'>Ubicacion Actual</span>">Ubicacion Actual</option>
			</select>
		</div>!
		<div>
			<input type="search" placeholder="ORIGEN" autocomplete="off" required="required" name="search_query" id="autocomplete_origen" class="btn-accion action-reserva-btn search-input">
			<div class="autocomplete-suggestions" style="position: absolute; width: 85%; top: 278px; left: 25px; max-height: 300px; z-index: 9999;display:none;"></div>
		</div>
		<div class="btn-accion action-reserva-btn">
			<select class="selectpicker" data-style="reserva-select" data-title="DESTINO">
				<option data-content="<i class='fa fa-home opcion-reserva'></i> <span class='opcion-reserva'>Agregar Casa</span>">Agregar Casa</option>
				<option data-divider="true"></option>
				<option data-content="<i class='mdi mdi-briefcase opcion-reserva'></i> <span class='opcion-reserva'>Agregar Trabajo</span>">Agregar Trabajo</option>
				<option data-divider="true"></option>
				<option data-content="<i class='mdi mdi-star opcion-reserva'></i> <span class='opcion-reserva'>Agregar Otra</span>">Agregar Otra</option>
				<option data-divider="true"></option>
				<option data-content="<i class='mdi mdi-map-marker opcion-reserva'></i> <span class='opcion-reserva'>Ubicacion Actual</span>">Ubicacion Actual</option>
			</select>
		</div>
		<div>
			<input type="search" placeholder="DESTINO" autocomplete="off" required="required" name="search_query-2" id="autocomplete_destino" class="btn-accion action-reserva-btn search-input">
			<div class="autocomplete-suggestions-2" style="position: absolute; width: 85%; top: 334px; left: 25px; max-height: 300px; z-index: 9999;display:none;"></div>
		</div>!-->
		<div>
			<input type="search" placeholder="UBICACION ACTUAL" required="required" name="ubicacion-actual-r" id="ubicacion-actual-r" class="btn-accion action-reserva-btn search-input">
			<div class="completar-ubicacion-actual" style="top:120px !important;"></div>
		</div>
		<div>
			<input type="search" placeholder="¿ADONDE VAS?" autocomplete="off" required="required" name="search_query-3-r" id="autocomplete_ask-r" class="btn-accion action-reserva-btn search-input">
			<div class="autocomplete-suggestions-3" style="position: absolute; width: 85%; top: 180px; left: 25px; max-height: 300px; z-index: 9999;display:none;"></div>
		</div>
		<div class="row">
			<div class="col-xs-5 col-sm-5 col-md-5" style="margin-left: 7%;">
				<!--<span>DD/MM/AA</span>!-->
				<input type="text" name="reservar-viaje-fecha" id="reservar-viaje-fecha" required="required" class="datepicker btn-accion action-reserva-btn-2 date-input">
			</div>
			<div class="col-xs-5 col-sm-5 col-md-5">
				<!--<span>00:00</span>!-->
				<input type="text" name="reservar-viaje-hora" id="reservar-viaje-hora" required="required" class="timepicker btn-accion action-reserva-btn-2 date-input">
			</div>
		</div>
		<div>
			<textarea id="comment" name="comment" class="btn-accion action-reserva-btn search-input" placeholder="Comentarios?" maxlength="51"></textarea>
		</div>		
		<div class="btn-accion action-reserva-btn-res boton-reservar-ahora" data-section="middle_page_reservar">
			<span>RESERVAR</span>
		</div>		
	</div>
</div>
