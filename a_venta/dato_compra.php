
  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
    <small>Numero interno</small>
    <input type="text" class="form-control form-control-sm" id="numero" name='numero' value='<?php echo $numero_compra; ?>' placeholder="Numero" readonly>
  </div>

  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
    <small>Comanda</small>
    <div class="input-group">
      <div class="input-group-prepend">
        <?php
          if($estado_compra=="Activa"){
            if($_SESSION['a_sistema']==1){
              echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_venta/form_comanda' dix='trabajo' omodal='1'><i class='fas fa-clipboard-list'></i></button>";
            }
          }
        ?>
      </div>
      <input type="text" class="form-control form-control-sm" id="comanda" name='comanda' value='<?php echo $comanda; ?>' placeholder="Comanda" readonly>
    </div>

  </div>

  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
    <small>Fecha</small>
    <input type="date" class="form-control form-control-sm" id="fecha" name='fecha' value='<?php echo $fecha_compra; ?>' placeholder="Fecha" readonly>
  </div>
