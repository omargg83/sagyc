<?php
	require_once("db_.php");
	$idproducto=$_REQUEST['idproducto'];
	$idventa=$_REQUEST['idventa'];

	$sql="SELECT * from productos
	left outer join productos_catalogo on productos_catalogo.idcatalogo=productos.idcatalogo
	where idproducto=:id";
	$sth = $db->dbh->prepare($sql);
	$sth->bindValue(":id",$idproducto);
	$sth->execute();
	$producto=$sth->fetch(PDO::FETCH_OBJ);

	if($producto->tipo==3){
		$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$producto->idproducto'";
		$sth = $db->dbh->prepare($sql);
		$sth->execute();
		$cantidad=$sth->fetch(PDO::FETCH_OBJ);
		$exist=$cantidad->total;
	}
	else{
		$exist=$producto->cantidad;
	}

	echo "<div class='modal-header'>";
  	echo "<h5 class='modal-title'>Agregar cliente</h5>";
  echo "</div>";

	echo "<div class='modal-body' style='max-height:580px;overflow: auto;'>";

	echo "<form id='form_prod' is='is-selecciona' v_idproducto='$idproducto'>";

	echo "<div class='row'>";

		echo "<div class='col-12'>";
			echo "<label>Nombre:</label>";
			echo "<input type='text' class='form-control' name='nombre' id='nombre' value='".$producto->nombre."' readonly>";
		echo "</div>";

		echo "<div class='col-4'>";
			echo "<label>Existencia:</label>";
			echo "<input type='text' class='form-control' name='existencia' id='existencia' value='$exist' readonly>";
		echo "</div>";

		echo "<div class='col-4'>";
			echo "<label>Cantidad</label>";
			echo "<input type='text' class='form-control' name='cantidad' id='cantidad' value='1' required>";
		echo "</div>";

		echo "<div class='col-4'>";
			echo "<label>Precio</label>";
			echo "<input type='text' class='form-control' name='precio' id='precio' value='".$producto->precio."' required>";
		echo "</div>";

	echo "</div>";
	echo "<hr>";
	echo "<div class='row'>";
		echo "<div class='col-12'>";
			echo "<div class='btn-group'>";
				echo "<button type='submit' class='btn btn-warning btn-sm'><i class='fas fa-cart-plus'></i>Agregar</button>";
				echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' cmodal='1' ><i class='fas fa-sign-out-alt'></i>Cancelar</button>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	echo "</form>";
?>
