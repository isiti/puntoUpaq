<!-- INFO: SECCION DONDE SE DECLARAN LOS MODAL. -->

<!-- Modal register-->
<div class="modal fade" id="registro-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" width="50%" alt="logo-login">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require('modal-content/register-content.php'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-salir-registro btn-secondary" data-dismiss="modal">Salir</button>
        <button type="button" id="btn_registrar" class="btn btn-continuar-registro btn-primary">Continuar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit-->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" width="50%" alt="logo-login">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require('modal-content/edit-content.php'); ?>
      </div>             
    </div>
  </div>
</div>

<!-- Modal info pedido-->
<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" width="50%" alt="logo-login">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require('modal-content/info-content.php'); ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal action pedido-->
<div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" width="50%" alt="logo-login">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require('modal-content/action-content.php'); ?>
      </div>
    </div>
  </div>
</div>
