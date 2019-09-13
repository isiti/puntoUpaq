<!-- INFO: muetro en un modal el resto de la info del pedido. -->

<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <form method="post" id="edit_user" name="save_user">
                <input type="text" id="id_order_value" hidden/>

                <div class="form-group">
                    <label for="name">Dirección de origen</label>
                    <input type="text" class="form-control" id="edit_origen" name="edit_origen"/>                       
                </div>

                <div class="form-group">
                    <label for="name">Departamento origen</label>
                    <input type="text" class="form-control" id="edit_depto_origen" name="edit_depto_origen"/>                       
                </div>

                <div class="form-group">
                    <label for="name">Dirección de destino</label>
                    <input type="text" class="form-control" id="edit_destino" name="edit_destino"/>                       
                </div>

                <div class="form-group">
                    <label for="name">Departamento destino</label>
                    <input type="text" class="form-control" id="edit_depto_destino" name="edit_depto_destino"/>                       
                </div>

                <div class="form-group">
                    <label for="name">Destinatario</label>
                    <input type="text" class="form-control" id="edit_destinatario" name="edit_destinatario"/>                       
                </div>

                <div class="form-group">
                    <label for="name">Descripción</label>
                    <textarea type="text" class="form-control" id="edit_descripcion" name="edit_descripcion"></textarea>
                </div>

                <hr>

                <div class="info_cadete_modal">
                    <h5 id="title">Info del cadete</h5>
                    <p id="username_cadete"></p>
                    <p id="email_cadete"></p>
                    <p id="phone_cadete"></p>
                </div>

                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-salir-registro btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit"  id="btn_editar_order" class="btn btn-continuar-registro btn-primary">Editar</button>
                </div>      
            </form>
        </div>
    </div>
</section>


