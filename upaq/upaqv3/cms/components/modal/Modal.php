<!-- Modal NewOrder-->
<div class="modal fade" id="newOrderModal" tabindex="-1" role="dialog" aria-labelledby="newOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newOrderModalLabel">Nuevo Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="form_new_order" method="post">
        <div class="modal-body">
            <?php require('modal-content/newOrder-modal-content.php'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="btn_new_order" class="btn btn-success">Guardar pedido</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal editRate-->
<div class="modal fade" id="editRateModal" tabindex="-1" role="dialog" aria-labelledby="editrateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editrateModalLabel">Editar Tarifas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="form_edit_rate" method="post">
        <div class="modal-body">            
            <?php require('modal-content/editRate-modal-content.php'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="btn_edit_rate" class="btn btn-success">Guardar Tarifa</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal newRate-->
<div class="modal fade" id="newRateModal" tabindex="-1" role="dialog" aria-labelledby="editrateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editrateModalLabel">Nueva Tarifas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="form_new_rate" method="post">
        <div class="modal-body">
            <?php require('modal-content/editRate-modal-content.php'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="btn_edit_rate" class="btn btn-success">Guardar Tarifa</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal DOWN - nuevo pedido -->
<div class="modal fade" id="newOrderDow" tabindex="-1" role="dialog" aria-labelledby="newOrderDowLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newOrderDowLabel">Nuevo Pedido [DOW] </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="form_new_order_dow" method="post">
        <div class="modal-body">            
            <?php require('modal-content/new-order-down-modal-content.php'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="new_order" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal DOWN - open pedido -->
<div class="modal fade" id="openOrderDow" tabindex="-1" role="dialog" aria-labelledby="openOrderDowLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openOrderDowLabel">Solicitud: <span id="show-nsolicitante-dow"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="form_new_order_dow" method="post">
        <div class="modal-body">            
            <?php require('modal-content/open-order-dow-modal-content.php'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_eliminar_dow" data-dismiss="modal" class="btn btn-danger">Eliminar</button>
            <button type="button" id="btn_aprobar_dow" data-dismiss="modal" class="btn btn-success">Aprobar</button>
            <button type="button" id="btn_desaprobar_dow" data-dismiss="modal" class="btn btn-warning">Desaprobar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal orders - open pedido -->
<div class="modal fade" id="openOrder" tabindex="-1" role="dialog" aria-labelledby="openOrderLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openOrderLabel">Info Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="form_new_order_dow" method="post">
        <div class="modal-body">            
            <?php require('modal-content/open-order-modal-content.php'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="btn_edit_rate" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>