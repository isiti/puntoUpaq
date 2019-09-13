<div class="show-content full-height blue-back" data-section="buscar_nuevo_viaje">
	<div class="top-for-burger">
		<i class="mdi mdi-menu menu-icon"></i>
	</div>
	<div class="home-title" style="margin-top: 10%;">
		<div id="mapid" style="height: 800px;"></div>
	</div>
	<div id="datos-viaje" hidden>
		<input type="hidden" name="travel_id" id="travel_id">
		<input type="hidden" name="id_dac" id="id_dac">
		<input type="hidden" name="direccion_origen" id="direccion_origen">
		<input type="hidden" name="direccion_destino" id="direccion_destino">
		<input type="hidden" name="observacion" id="observacion">
		<input type="hidden" name="mensaje" id="mensaje">	
		<input type="hidden" name="latitud_viaje" id="latitud_viaje">
		<input type="hidden" name="longitud_viaje" id="longitud_viaje">	
	</div>
	<div class="new-travel-btn" style="display: none;position: fixed;bottom: -4px; z-index: 100000;" id="div-nuevo-viaje">
		<div class="btn-accion action-home-btn nuevo-marcador" style="background-color: green !important; color: #FFF !important;" data-nombre="" data-toaddress="" data-id="" data-lat="" data-long="" data-address="" id="boton-nuevo-viaje">
			<span>NUEVO VIAJE! </span><span id="direccion-span"></span>
		</div>
	</div>
	<div class="arr-travel-btn" style="display: none;position: fixed;bottom: -4px; z-index: 100000;" id="div-llegue-viaje">
		<div class="btn-accion action-home-btn nuevo-marcador" style="background-color: lightblue !important; color: #FFF !important;" data-nombre="" data-toaddress="" data-id="" data-lat="" data-long="" data-address="" id="boton-llegue-viaje">
			<span>YA LLEGUE! </span><span id="direccion-span"></span>
		</div>
	</div>
	<div class="end-travel-btn" style="display: none;position: fixed;bottom: -4px; z-index: 100000;" id="div-finalizar-viaje">
		<div class="btn-accion action-home-btn nuevo-marcador" style="background-color: #1A57A2 !important; color: #FFF !important; width: 100%;" data-nombre="" data-toaddress="" data-id="" data-lat="" data-long="" data-address="" id="boton-finalizar-viaje">
			<span>FINALIZAR VIAJE </span><span id="direccion-span"></span>
		</div>
	</div>
</div>
