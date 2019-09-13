<section id="myform" class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<h1 class="title">UPAQ</h1>
		<div class="logo">
			<img src="<?="//$url_web/"?>assets/images/logos/boxColor.png" alt="logo-upaq">
		</div>

		<form method="post">
			<div class="form-group">
				<label for="direc_origen">Dirección de Origen*</label>
				<input v-model="origen" type="text" class="form-control" id="direc_origen" name="direc_origen" aria-describedby="origen_help" placeholder="calle + número" required>
				<small id="origen_help" class="form-text text-muted">ingrese la dirección donde se buscará el paquete</small>
			</div>

			<div class="form-group">
				<label for="depto_origen">Departamento</label>
				<input v-model="depto_origen" type="text" class="form-control" id="depto_origen" name="depto_origen" aria-describedby="depto_origen_help" placeholder="piso + depto" required>
				<small id="depto_origen_help" class="form-text text-muted">ingrese piso y numero de departamento de origen</small>
			</div>

			<hr>
				<a href="#direc_destino"><i class="arrow fas fa-angle-double-down"></i></a>
			<hr>

			<div class="form-group">
				<label for="direc_destino">Dirección de Destino*</label>
				<input v-model="destino" type="text" class="form-control" id="direc_destino" name="direc_destino" aria-describedby="destino_help" placeholder="calle + número" required>
				<small id="destino_help" class="form-text text-muted">ingrese la dirección donde se entrega el paquete</small>
			</div>

			<div class="form-group">
				<label for="depto_destino">Departamento</label>
				<input v-model="depto_destino" type="text" class="form-control" id="depto_destino" name="depto_destino" aria-describedby="depto_destino_help" placeholder="piso + depto" required>
				<small id="depto_destino_help" class="form-text text-muted">ingrese piso y numero de departamento de destino</small>
			</div>

			<hr>
				<a href="#tipo"><i class="arrow fas fa-angle-double-down"></i></a>
			<hr>

			<div class="form-group">
				<label for="tipo">Tipo de viaje*</label>
				<select v-model="selected" type="text" class="form-control" id="tipo" name="tipo" aria-describedby="tipo_help" placeholder="">																				
				</select>
				<small id="tipo_help" class="form-text text-muted">seleccione el tipo de cadetería que busca</small>
			</div>

			<div class="form-group">
				<h5 id="monto"></h5>
			</div>

			<div class="form-group">
				<label for="destinatario">Destinatario*</label>
				<input v-model="destinatario" type="text" class="form-control" id="destinatario" name="destinatario"  aria-describedby="destinatario_help" placeholder="" required>
				<small id="destinatario_help" class="form-text text-muted">ingrese el nombre de la persona o empresa que recibe el paquete</small>
			</div>

			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<textarea v-model="descripcion" type="text" class="form-control" id="descripcion" name="descripcion" aria-describedby="descripcion_help" required></textarea>
				<small id="descripcion_help" class="form-text text-muted">ingrese una breve descripción sobre el envío del paquete</small>
			</div>

			<hr>
				<a href="#resumen"><i class="arrow fas fa-angle-double-down"></i></a>
			<hr>

			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 title-pedido">
					<h2>Resumen</h2>
				</div>	
				<div id="resumen" class="col-lg-12 col-md-12 col-xs-12 pedido"> 
					<h5>Dirección de origen</h5>
					<p>{{origen}} - {{depto_origen}}</p>

					<h5>Dirección de destino</h5>
					<p>{{destino}} - {{depto_destino}}</p>

					<h5>Tipo de viaje</h5>
					<p>{{selected}}</p>

					<h5>Destinatario</h5>
					<p>{{destinatario}}</p>

					<h5>Descripción</h5>
					<p>{{descripcion}}</p>							
				</div>
			</div>
					
			<hr>
				<a href="#confirm"><i class="arrow fas fa-angle-double-down"></i></a>
			<hr>				
			<div>					
				<button type="submit" id="confirmar" class="btn btn-primary">Confirmar</button>					
			</div>
		</form>


	</div>
</section>