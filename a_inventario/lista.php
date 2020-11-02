<?php
	require_once("db_.php");

	if(isset($_REQUEST['idsucursal'])){
		$idsucursal=$_REQUEST['idsucursal'];
	}
	else{
		$idsucursal=$_SESSION['idsucursal'];
	}

	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->producto_buscar($texto);
	}
	else{
		$pd = $db->productos_lista();
	}
	$sucursal=$db->sucursal();
	echo "<hr>";

	echo "<div class='card'>";
		echo "<form is='f-submit' id='form_editar' des='a_inventario/lista' dix='trabajo'>";
		echo "<div class='row'>";
			echo "<div class='col-2'>";
				echo "<label><b>Sucursal</b></label>";
			echo "</div>";
			echo "<div class='col-2'>";
				echo "<select class='form-control form-control-sm' id='idsucursal' name='idsucursal'>";
				foreach($sucursal as $row){
					echo "<option value='$row->idsucursal'" ; if($idsucursal==$row->idsucursal){ echo " selected"; }echo ">$row->nombre</option>";
				}
				echo "</select>";
			echo "</div>";
			echo "<div class='col-2'>";
			echo "<button type='submit' class='btn btn-warning btn-sm'><i class='far fa-save'></i>Guardar</button>";
			echo "</div>";
		echo "</div>";
		echo "</form>";
	echo "</div>";
	echo "<hr>";

	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>

<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-12'>
			INVENTARIO DE PRODUCTOS
		</div>
	</div>
	<div class='row header-row'>
		<div class='col-2'>#</div>
		<div class='col-1'>Tipo</div>
		<div class='col-3'>Nombre</div>
		<div class='col-1'>Global</div>
		<div class='col-1'>Precio</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
					echo "<div class='col-2'>";
						echo "<div class='btn-group'>";

						echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_inventario/editar' dix='trabajo' v_idproducto='$key->idproducto'><i class='fas fa-pencil-alt'></i></button>";

						echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-print' title='Editar' des='a_inventario/imprimir' dix='trabajo' v_idproducto='$key->idproducto' v_variable='demo' v_tipo='1'><i class='fas fa-barcode'></i></button>";

						echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_inventario/db_' des='a_inventario/lista' fun='borrar_producto' dix='trabajo' v_idproducto='$key->idproducto' id='eliminar' tp='¿Desea eliminar el Producto seleccionado?'><i class='far fa-trash-alt'></i></button>";
							////
							$sql="select sum(cantidad) as total from bodega where idsucursal='$idsucursal' and idproducto='$key->idproducto'";
							$sth = $db->dbh->prepare($sql);
							$sth->execute();
							$cantidad=$sth->fetch(PDO::FETCH_OBJ);
						if($cantidad->total>0 or $key->tipo==0){
				      echo "<button type='button'  id='0' des='' dix='0' v_idproducto='0' class='btn btn-warning btn-sm' title='Producto en existencia o se trata de un servicio' omodal='1'><i class='far fa-thumbs-up'></i></button>";
						}
						else {
							echo "<button type='button'  id='0' des='' dix='0' v_idproducto='0' class='btn btn-danger btn-sm' title='Producto sin stock' omodal='1'><i class='far fa-thumbs-down'></i></button>";
						}
						//////
						echo "</div>";
					echo "</div>";

					echo "<div class='col-1'>";
						if($key->tipo==0) echo "Servicio";
						if($key->tipo==3) echo "Volúmen";
					echo "</div>";

					echo "<div class='col-3'>".$key->nombre."</div>";

					echo "<div class='col-1 text-center'>";
						echo $cantidad->total;
					echo "</div>";

					echo "<div class='col-1 text-right' >".moneda($key->precio)."</div>";
				echo '</div>';
			}
		?>

	</div>