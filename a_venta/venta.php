<?php
  require_once("db_.php");
  $idventa=0;
?>
<input type="text" name="idventa" id="idventa" value="<?php echo $idventa; ?>" readonly>

<div class="container-fluid">
	<div class='card'>
    <div class='card-header'>Venta #<?php echo $idventa; ?></div>
    <div class='card-body'>
      <div class='row'>
        <div class='col-6'>
          <div id='lista'>

          </div>
        </div>
        <div class='col-6'>
          <?php
            include 'producto_buscar.php';
          ?>
          <hr>
          <?php
            include 'dato_compra.php';
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
