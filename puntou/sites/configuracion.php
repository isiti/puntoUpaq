<div class="show-content full-height" data-section="configuracion">
	<div class="cf-top">
		<span class="closebtn-mv sec-ident" data-section="home">&times;</span>
		<span class="cf-title">Configuracion</span>
	</div>
	<div class="mv-bottom">
		<div class="config-datos">
			<div class="config-datos-nombre">
				<span>Nombre y Apellido</span>
			</div>
			<div class="config-datos-empresa">
				<span>EMPRESA</span>
			</div>
		</div>
		<div class="separador1"></div>
		<div class="config-favoritos">
			<div class="config-favoritos-titulo">
				<span>Favoritos</span>
			</div>
			<div class="config-favoritos-items">
				<div class="config-favoritos-item config-favoritos-casa">
					<i class='fa fa-home' style="font-size: 25px;"></i> <span>Agregar Casa</span>
				</div>
				<div class="separador2"></div>
				<div class="config-favoritos-item config-favoritos-trabajo">
					<i class='mdi mdi-briefcase' style="font-size: 25px;"></i> <span>Agregar Trabajo</span>
				</div>
				<div class="separador2"></div>
				<div class="config-favoritos-item config-favoritos-otro">
					<i class='mdi mdi-star' style="font-size: 25px;"></i> <span>Agregar Otra</span>
				</div>
			</div>
		</div>
	</div>
	<div id="popup_casa" class="popup">
        <!-- Contenido del Popup -->
        <div class="popup-content">
        	<span class="aceptar_casa">X</span>
        	<div class="popup-new-address-title">
        		<span>Agregar Nueva Dirección</span>
        	</div>
            <div class="popup-new-address-data">
            	<i class='fa fa-home' style="font-size: 25px;"></i><input type="text" name="nueva-direccion-casa" id="nueva-direccion-casa">	
            </div>
            <div class="popup-new-address-button">
            	<button id="boton-nueva-casa" data-type="casa" class="btn-acept-address">Aceptar</button>
            </div>
        </div>
    </div>
    <div id="popup_trabajo" class="popup">
        <!-- Contenido del Popup -->
        <div class="popup-content">
        	<span class="aceptar_trabajo">X</span>
        	<div class="popup-new-address-title">
        		<span>Agregar Nueva Dirección</span>
        	</div>
            <div class="popup-new-address-data">
            	<i class='mdi mdi-briefcase' style="font-size: 25px;"></i><input type="text" name="nueva-direccion-trabajo" id="nueva-direccion-trabajo">	
            </div>
            <div class="popup-new-address-button">
            	<button id="boton-nueva-trabajo" data-type="trabajo" class="btn-acept-address">Aceptar</button>
            </div>
        </div>
    </div>
    <div id="popup_otro" class="popup">
        <!-- Contenido del Popup -->
        <div class="popup-content">
        	<span class="aceptar_otro">X</span>
        	<div class="popup-new-address-title">
        		<span>Agregar Nueva Dirección</span>
        	</div>
            <div class="popup-new-address-data">
            	<i class='mdi mdi-star' style="font-size: 25px;"></i><input type="text" name="nueva-direccion-otro" id="nueva-direccion-otro">	
            </div>
            <div class="popup-new-address-button">
            	<button id="boton-nueva-otro" data-type="otro" class="btn-acept-address">Aceptar</button>
            </div>
        </div>
    </div>
</div>
