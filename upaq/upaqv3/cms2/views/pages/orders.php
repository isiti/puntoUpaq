<section id="sec-orders">
    <div id="title">
        <h2>PEDIDOS</h2> <i class="fas fa-plus" data-toggle="modal" data-target="#modalNewOrder"></i>
    </div>
    <table class="table" id="table_orders">
        <thead>
            <tr>
                <th>Origen</th>
                <th>Dpto. Origen</th>
                <th>Destino</th>
                <th>Depto. Destino</th>
                <th>Tipo</th>
                <th>Destinatario</th>                
                <th>User</th>
                <th>Cadete</th>
                <th>Estado</th>                
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalNewOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="" class="row" id="form_newOrder">
                        <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6 col-form">
                            <div class="form-group">
                                <label for="direc_origen">Dirección de Origen*</label>
                                <input type="text" class="form-control" id="direc_origen" name="direc_origen"
                                    aria-describedby="origen_help" placeholder="calle + número" required>
                                <small id="origen_help" class="form-text text-muted">ingrese la dirección donde se
                                    buscará el
                                    paquete</small>
                            </div>

                            <div class="form-group">
                                <label for="depto_origen">Departamento</label>
                                <input type="text" class="form-control" id="depto_origen" name="depto_origen"
                                    aria-describedby="depto_origen_help" placeholder="piso + depto" required>
                                <small id="depto_origen_help" class="form-text text-muted">ingrese piso y numero de
                                    departamento
                                    de origen</small>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6 col-form">
                            <div class="form-group">
                                <label for="direc_destino">Dirección de Destino*</label>
                                <input type="text" class="form-control" id="direc_destino" name="direc_destino"
                                    aria-describedby="destino_help" placeholder="calle + número" required>
                                <small id="destino_help" class="form-text text-muted">ingrese la dirección donde se
                                    entrega el
                                    paquete</small>
                            </div>

                            <div class="form-group">
                                <label for="depto_destino">Departamento</label>
                                <input type="text" class="form-control" id="depto_destino" name="depto_destino"
                                    aria-describedby="depto_destino_help" placeholder="piso + depto" required>
                                <small id="depto_destino_help" class="form-text text-muted">ingrese piso y numero de
                                    departamento de destino</small>
                            </div>
                        </div>

                        <div class="form-group col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6 col-form">
                            <label for="tipo">Tipo de viaje*</label>
                            <select type="text" class="form-control" id="tipo" name="tipo" aria-describedby="tipo_help"
                                placeholder="">
                                <option value="Sobre">Sobre</option>
                                <option value="Tramite">Tramite</option>
                                <option value="Pequeño/mediano Paquete">Pequeño/mediano Paquete</option>
                                <option value="Paquete grande">Paquete grande</option>
                                <option value="Pequeño/mediano bulto">Pequeño/mediano bulto</option>
                                <option value="Bulto grande">Bulto grande</option>
                                <option value="Mudanza">Mudanza</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                            <small id="tipo_help" class="form-text text-muted">seleccione el tipo de cadetería que
                                busca</small>
                        </div>

                        <div class="form-group col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6 col-form">
                            <label for="descripcion">Descripción</label>
                            <textarea type="text" class="form-control" id="descripcion" name="descripcion"
                                aria-describedby="descripcion_help" required></textarea>
                            <small id="descripcion_help" class="form-text text-muted">ingrese una breve descripción
                                sobre el
                                envío del paquete</small>
                        </div>

                        <div class="form-group col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6 col-form">
                            <label for="
                            destinatario">Destinatario*</label>
                            <input type="text" class="form-control" id="destinatario" name="destinatario"
                                aria-describedby="destinatario_help" placeholder="" required>
                            <small id="destinatario_help" class="form-text text-muted">ingrese el nombre de la persona o
                                empresa que recibe el paquete</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn-submit" name="btn-submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</section>