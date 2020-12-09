<?php
  require_once("db_.php");
?>

<form id="form_comanda" is='f-comanda'>

  <div class="modal-header">
    <h5 class="modal-title">Agregar comanda</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div class="modal-body" style='max-height:580px;overflow: auto;'>
    <div clas='row'>

      <div class='col-12'>
        <label>Comanda</label>
        <input type='text' name='comanda' id='comanda'  placeholder='Comanda' value='' class='form-control' required >
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i>Agregar</button>
    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cancelar</button>
  </div>
</form>
