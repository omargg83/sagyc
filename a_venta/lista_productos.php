<?php
	require_once("db_.php");
  $idcategoria=$_REQUEST['idcategoria'];
  $idventa=$_REQUEST['idventa'];
  $productos=$db->productos_lista($idcategoria);

	echo "<div class='sagyc_productos'>";

    foreach ($productos as $key) {

      echo "<button class='sagyc_item' type='button' is='b-link' id='sel_producto_$key->idproducto' 
      des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' 
      class='btn btn-warning btn-sm' title='Seleccionar producto' omodal='1'";
        if(strlen($key->archivo)>0 and file_exists("../".$db->f_productos."/".$key->archivo)){
          echo "style='background-image: url(\"".$db->f_productos."/".$key->archivo."\")'";
        }
        else{
          echo "style='background-image: url(\"img/unnamed.png'\") ";
        }
        echo ">";
        echo "<span>";
        echo  trim($key->nombre);          
        echo "</span>";
      echo "</button>";
    }

  echo "</div>";

	echo "<hr>";
	echo "<button type='button' is='b-link' des='a_venta/lista_categoria' dix='resultadosx'  class='btn btn-warning btn-sm'><i class='fas fa-undo'></i>Regresar</button>";
	echo "</div>";
?>
