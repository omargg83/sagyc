<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];
  $idventa=$_REQUEST['idventa'];

	if($idventa>0){
		$sql="select * from venta where idventa='$idventa'";
		$sth = $db->dbh->prepare($sql);
		$sth->execute();
		$venta=$sth->fetch(PDO::FETCH_OBJ);
		$estado_compra=$venta->estado;
	}
	else{
		$estado_compra="Activa";
	}


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
				/*
				if($key->tipo==3){
					$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$key->idproducto'";
					$sth = $db->dbh->prepare($sql);
					$sth->execute();
					$cantidad=$sth->fetch(PDO::FETCH_OBJ);
					$exist=$cantidad->total;
				}
				else{
					$exist=$key->cantidad;
				}
				*/


	      echo "<div class='row body-row' is='b-card' draggable='true'>";
					echo "<div class='col-12'>";
						if($estado_compra=="Activa"){
							echo "<div class='btn-group mr-3'>";
						      echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' class='btn btn-warning btn-sm' title='Seleccionar cliente' omodal='1'><i class='fas fa-plus'></i></button>";
							echo  "</div>";
						}

						//echo " ($exist) ";
						//echo 	"<b>".moneda($key->precio)."</b>";
		      	echo  $key->nombre;
		      echo  "</div>";

	      echo  "</div>";
	    }
	  }
		echo "</div>";
	echo "</div>";
?>
