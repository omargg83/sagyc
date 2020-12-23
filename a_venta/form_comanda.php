<?php
  require_once("db_.php");
?>

<form id="form_comanda" is='f-comanda'>

  <div class="modal-header">
    <h5 class="modal-title">Agregar comanda</h5>
  </div>

  <div class="modal-body" style='max-height:580px;overflow: auto;'>
    <div clas='row'>

      <div class='col-12'>
        <label>Comanda</label>
        <input type='text' name='comanda_txt' id='comanda_txt'  placeholder='Comanda' value='' class='form-control' required >
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i>Agregar</button>
    <button type='button' is='b-link' class='btn btn-warning btn-sm' cmodal=1><i class="fas fa-sign-out-alt"></i>Cancelar</button>
  </div>
</form>
