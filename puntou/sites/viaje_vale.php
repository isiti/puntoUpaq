<div class="show-content full-height blue-back" data-section="viaje_vale">

	<div class="top-for-burger">
		<i class="mdi mdi-menu menu-icon"></i>
	</div>

	<div class="row">
		<div class="col-xs-3 col-sm-3 col-md-3" style="margin-top: 10px; text-align: right;padding-left: 20px;">
			<i class="mdi mdi-car car-icon"></i>
		</div>
		<div class="col-xs-5 col-sm-7 col-md-7" style="padding-left: 25px;">
			<span class="text-title" style="font-size: 30px;">Viaje<br> finalizado</span>
		</div>
	</div>

	<div id="panel_firma" style="text-align: center;">
		<div style="font-size: 18px; ">
			<span>Monto: $ </span>
			<input type="number" step="0.01" value="" id="f_amount">
			<span style="margin-left: 13px;">Tarifa: </span>
			<select id="rate_type">
				<option value="Seleccionar" hidden>Elegir</option>
				<option value="1">x0</option>
				<option value="0.9">x1</option>
				<option value="0.8">x2</option>
				<option value="0.7">x3</option>
			</select> <br>
			<span>Monto final: $ </span>
			<input type="number" value="" step="0.01" id="tf_amount">
			<button type="button" class="buttonFirma ok" id="boton-sacar-foto">Fotografiar Vale</button>
			<div hidden="hidden">
				<input type="file" name="foto-vale" id="foto-vale" accept="image/*" capture hidden>
			</div>
		</div>

		<div class="panel">
		    <div id="signature-pad" class="signature-pad row">
		      	<div class="col-lg-12 signature-pad--body" style="padding-left: 0px;">
					<div class="description" id="firma_description"><span>Vale</span></div>
		        	<canvas id="canvasVale"></canvas>
		      	</div>
		      	<div class="col-lg-12 signature-pad--footer" style="padding-left: 0px;">
		       		<div class="signature-pad--actions">
		          		<div class="">
		            		<button type="button" id="btn_send_vale" class="buttonFirma ok" data-action="ok" disabled="disabled">Confirmar</button>
		         		</div>
		        	</div>
		      	</div>
		    </div>
	  	</div>
	</div>
</div>
