<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];


  $sql="SELECT * from productos	left outer join productos_catalogo on productos_catalogo.idcatalogo=productos.idcatalogo
	where idsucursal=".$_SESSION['idsucursal']." and (nombre like '%$texto%' or  codigo like '%$texto%') order by nombre limit 20";
  $sth = $db->dbh->prepare($sql);
  $sth->execute();
  $res=$sth->fetchAll(PDO::FETCH_OBJ);

	echo "<div class='container'>";
	echo "<div class='tabla_css' id='tabla_css'>";
		echo "<div class='row header-row'>";
			echo "<div class='col-12'>DESCRIPCION</div>";
		echo "</div>";

	  if(count($res)>0){
	    foreach ($res as $key) {
	      echo "<div class='row body-row' is='b-card' draggable='true'>";
					echo "<div class='col-12'>";

							echo "<div class='btn-group mr-1'>";
						      echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_citas/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto'  class='btn btn-warning btn-sm' title='Seleccionar producto' omodal='1'><i class='fas fa-plus'></i></button>";
							echo  "</div>";

		      	echo  $key->nombre;
		      echo  "</div>";
	      echo  "</div>";
	    }
	  }
		echo "</div>";
	echo "</div>";
?>
