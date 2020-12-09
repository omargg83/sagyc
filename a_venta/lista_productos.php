<?php
	require_once("db_.php");
  $idcategoria=$_REQUEST['idcategoria'];
  $idventa=$_REQUEST['idventa'];
  $productos=$db->productos_lista($idcategoria);

  echo "<div class='tabla_css' id='tabla_css'>";

    foreach ($productos as $key) {
      echo "<div class='row body-row' is='b-card' draggable='true'>";
        echo "<div class='col-12'>";

          echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' class='btn btn-warning btn-sm' title='Seleccionar producto' omodal='1'><i class='fas fa-plus'></i></button>";

          echo  $key->nombre;
        echo  "</div>";
      echo  "</div>";
    }

  echo "</div>";

	echo "<hr>";
	echo "<button type='button' is='b-link' des='a_venta/lista_categoria' dix='resultadosx'  class='btn btn-warning btn-sm'><i class='fas fa-undo'></i>Regresar</button>";
?>
