<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];
  $idventa=$_REQUEST['idventa'];

  $sql="SELECT * from productos where idtienda=:tienda and
  	(nombre like :texto or
    descripcion like :texto or
    codigo like :texto  or
    rapido like :texto
  ) order by nombre limit 20";

  $sth = $db->dbh->prepare($sql);
  $sth->bindValue(":texto","%$texto%");
  $sth->bindValue(":tienda",$_SESSION['idtienda']);
  $sth->execute();
  $res=$sth->fetchAll(PDO::FETCH_OBJ);
	echo "<div class='container'>";


	echo "<div class='tabla_css' id='tabla_css'>";
		echo "<div class='row header-row'>";
			echo "<div class='col-1'>-</div>";
			echo "<div class='col-2'>#</div>";
			echo "<div class='col-7'>Nombre</div>";
			echo "<div class='col-2'>$</div>";
		echo "</div>";

	  if(count($res)>0){
	    foreach ($res as $key) {
				$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$key->idproducto'";
				$sth = $db->dbh->prepare($sql);
				$sth->execute();
				$cantidad=$sth->fetch(PDO::FETCH_OBJ);

	      echo "<div class='row body-row' draggable='true'>";
	      echo  "<div class='col-1'>";
		      echo  "<div class='btn-group'>";
					if($cantidad->total>0 or $key->tipo==0){
			      echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' class='btn btn-warning btn-sm' title='Seleccionar cliente' omodal='1'><i class='fas fa-plus'></i></button>";
					}

		      echo  "</div>";
	      echo  "</div>";

				echo  "<div class='col-2 text-center'>";
					echo $cantidad->total;
	      echo  "</div>";

	      echo  "<div class='col-7'>";
				echo  $key->codigo;
				echo "<br>";
	      echo  $key->nombre;
	      echo  "</div>";

	      echo  "<div class='col-2' align='right'>";
	        echo 	moneda($key->precio);
	      echo  "</div>";

	      echo  "</div>";
	    }
	  }
		echo "</div>";
	echo "</div>";
?>
