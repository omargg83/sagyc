<?php
	require_once("db_.php");
	$idproducto=$_REQUEST['idproducto'];
	$cate=$db->categoria();
	if($idproducto>0){
		$per = $db->producto_editar($idproducto);

		$cantidad=$per->cantidad;
		$precio=$per->precio;
		$preciom=$per->preciom;
		$stockmin=$per->stockmin;
		$stockmax=$per->stockmax;
		$preciocompra=$per->preciocompra;
	}
	else{
		$precio=0;

		$preciom=0;
		$stockmin=0;
		$stockmax=0;
		$cantidad=0;
		$preciocompra="";
	}

?>

<div class='container'>
	<form is="f-submit" id="form_editar" db="a_productosinv/db_" fun="guardar_producto" des="a_productosinv/editar" desid='idproducto'>
		<input type="hidden" name="idproducto" id="idproducto" value="<?php echo $idproducto;?>">
		<div class='card'>
			<div class='card-header'>
				<?php echo $nombre;?>
			</div>
			<div class='card-body'>
				<div class='tab-content' id='myTabContent'>
					<div class='tab-pane fade show active' id='ssh' role='tabpanel' aria-labelledby='ssh-tab'>
						<form id='form_producto' action='' data-lugar='a_productosinv/db_' data-destino='a_productosinv/editar' data-funcion='guardar_producto'>
							<input type="hidden" class="form-control form-control-sm" id="id" name='id' value="<?php echo $idproducto; ?>">
							<div class='row'>
								<div class="col-12">
								 <label>Tipo de producto</label>
									<select class="form-control form-control-sm" name="tipo" id="tipo" <?php if ($idproducto>0){ echo "readonly";}  ?> required>
										<option value='' disabled selected>Seleccione una opción</option>
										<option value="3"<?php if($tipo=="3") echo "selected"; ?> > Producto (Se controla el inventario por volúmen)</option>
										<option value="0"<?php if($tipo=="0") echo "selected"; ?> > Servicio (solo registra ventas, no es necesario registrar entrada)</option>
									</select>
								</div>
							</div>
							<hr>
							<div class='row'>
								<div class="col-2">
								 <label>Busqueda rapida</label>
								 <input type="text" class="form-control form-control-sm" id="rapido" name='rapido' placeholder="rapido" value="<?php echo $rapido; ?>" maxlength=8>
								</div>
								<div class="col-5">
								 <label>Nombre</label>
								 <input type="text" class="form-control form-control-sm" id="nombre" name='nombre' placeholder="Descripción" value="<?php echo $nombre; ?>" required>
								</div>

								<div class="col-12">
								 <label>Descripción</label>
								 <input type="text" class="form-control form-control-sm" id="descripcion" name='descripcion' placeholder="Descripción" value="<?php echo $descripcion; ?>">
								</div>
							</div>
							<div class='row'>

								<div class="col-3">
								 <label>Precio compra</label>
								 <input type="text" class="form-control form-control-sm" id="preciocompra" name='preciocompra' placeholder="Precio" value="<?php echo $preciocompra; ?>">
								</div>
								<div class="col-3">
								 <label>Precio Venta</label>
								 <input type="text" class="form-control form-control-sm" id="precio" name='precio' placeholder="Precio" value="<?php echo $precio; ?>" required>
								</div>
								<div class="col-3">
								 <label>Precio mayoreo</label>
								 <input type="text" class="form-control form-control-sm" id="preciom" name='preciom' placeholder="Precio Mayoreo" value="<?php echo $preciom; ?>" >
								</div>

								<div class="col-3">
									<?php
									$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$idproducto'";
									$sth = $db->dbh->prepare($sql);
									$sth->execute();
									$cantidad=$sth->fetch(PDO::FETCH_OBJ);
									?>
								 <label>Existencias</label>
								 <input type="text" class="form-control form-control-sm" id="tmp_ex" name='tmp_ex' placeholder="Existencias" value="<?php echo $cantidad->total; ?>" readonly>
								</div>

							</div>

							<div class='row'>
								<div class="col-2">
								 <label>Stock Minimo</label>
								 <input type="text" class="form-control form-control-sm" id="stockmin" name='stockmin' placeholder="Stock Minimo" value="<?php echo $stockmin; ?>">
								</div>
								<div class="col-2">
								 <label>Stock Maximo</label>
								 <input type="text" class="form-control form-control-sm" id="stockmax" name='stockmax' placeholder="Stock Maximo" value="<?php echo $stockmax; ?>" >
								</div>

								<div class="col-3">
								 <label>Activo</label>
									<select class="form-control form-control-sm" name="activo" id="activo"  >
										<option value="0"<?php if($activo=="0") echo "selected"; ?> > Inactivo</option>
										<option value="1"<?php if($activo=="1") echo "selected"; ?> > Activo</option>
									</select>
								</div>

							</div>
							<hr>

							<div class='row'>
								<div class="col-12">
										<?php
											if(strlen($idproductoventa)==0){
												echo "<button type='submit' class='btn btn-warning btn-sm'><i class='far fa-save'></i>Guardar</button>";
											}

											if($idproducto>0){
												if($tipo==3){
													echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_productosinv/form_agrega' omodal='1' v_id='0' v_idproducto='$idproducto' ><i class='fas fa-key'></i>+ existencias</button>";
												}
											}
										?>
										<button type='button' class='btn btn-warning btn-sm' id='lista_cat' is='b-link'  des='a_productosinv/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
								</div>
							</div>
						</form>
					</div>


						<?php
							$row=$db->productos_inventario($idproducto);
							echo "<table class='table table-sm' style='font-size:12px'>";
							echo "<tr>
							<th>-</th>
							<th>Fecha</th>
							<th>Nota de compra</th>
							<th># Venta</th>
							<th>Cantidad</th>
							<th>Precio</th>
							</tr>";
							$total=0;
							foreach($row as $key){
								echo "<tr id='".$key->idbodega."' class='edit-t'>";
									echo "<td>";
										echo "<div class='btn-group'>";
										if(!$key->idventa){

										echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_productosinv/editar' desid='idbodega' dix='trabajo' db='a_productosinv/db_'  fun='borrar_ingreso' v_id='$key->idbodega' v_idproducto='$idproducto' tp='¿Desea eliminar la entrada?' title='Borrar'><i class='far fa-trash-alt'></i></button>";
										}
										echo "</div>";
									echo "</td>";
									echo "<td>";
										echo fecha($key->fecha);
									echo "</td>";
									echo "<td>";
										echo $key->idcompra;
									echo "</td>";
									echo "<td>";
										echo $key->idventa;
									echo "</td>";
									echo "<td>";
										echo $key->cantidad;
									echo "</td>";
									echo "<td>";
										echo moneda($key->c_precio);
									echo "</td>";

								echo "</tr>";
							}
							echo "</table>";
						?>
				</div>
			</div>
		</div>
		</form>
</div>
