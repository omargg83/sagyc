<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];
  $idventa=$_REQUEST['idventa'];

  $sql="SELECT * from productos where idtienda=".$_SESSION['idtienda']." and activo=1 and (nombre like '%$texto%' or  codigo like '%$texto%' or rapido like '%$texto%') order by nombre limit 20";
  $sth = $db->dbh->prepare($sql);
  $sth->execute();
  $res=$sth->fetchAll(PDO::FETCH_OBJ);

	echo "<div class='container'>";
	echo "<div class='tabla_css' id='tabla_css'>";
		echo "<div class='row header-row'>";
			echo "<div class='col-2'>-</div>";
			echo "<div class='col-10'>DESCRIPCION</div>";
		echo "</div>";

	  if(count($res)>0){
	    foreach ($res as $key) {
				/*
				$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$key->idproducto'";
				$sth = $db->dbh->prepare($sql);
				$sth->execute();
				$cantidad=$sth->fetch(PDO::FETCH_OBJ);*/

	      echo "<div class='row body-row' is='b-card' draggable='true'>";
		      echo  "<div class='col-2'>";
						//if($cantidad->total>0 or $key->tipo==0){
				      echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' class='btn btn-warning btn-sm' title='Seleccionar cliente' omodal='1'><i class='fas fa-plus'></i></button>";
						//}
		      echo  "</div>";

					echo  "<div class='col-10'>";
		      	echo  $key->nombre;
						//echo " (".$cantidad->total.") ";
		      	echo "<br>";
		        echo 	"<b>".moneda($key->precio)."</b>";
		      echo  "</div>";

	      echo  "</div>";
	    }
	  }
		echo "</div>";
	echo "</div>";
?>
