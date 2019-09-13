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

<!-- Modal table-->
<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" width="50%" alt="logo-login">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require('modal-content/table-content.php'); ?>
      </div>             
    </div>
  </div>
</div>