<?php
	require_once("db_.php");
	$idproducto=$_REQUEST['idproducto'];
	$cate=$db->categoria();
	if($idproducto>0){
		$per = $db->producto_editar($idproducto);

		$exist=$per->cantidad;
		$precio=$per->precio;
		$preciom=$per->preciom;
		$preciod=$per->preciod;
		$stockmin=$per->stockmin;

		$descxmonto=$per->descxmonto;
		$xmontomay=$per->xmontomay;
		$xmontodis=$per->xmontodis;
		$descxcant=$per->descxcant;
		$xcantmay=$per->xcantmay;
		$xcantdis=$per->xcantdis;

		$preciocompra=$per->preciocompra;
		$nombre=$per->nombre;
		$descripcion=$per->descripcion;
		$tipo=$per->tipo;
		$activo_producto=$per->activo_producto;
	}
	else{
		$precio=0;

		$preciom=0;
		$preciod=0;
		$stockmin=1;

		$descxmonto=0;
		$xmontomay=0;
		$xmontodis=0;
		$descxcant=0;
		$xcantmay=0;
		$xcantdis=0;

		$cantidad=0;
		$preciocompra="";

		$nombre="";
		$descripcion="";
		$tipo="";
		$activo_producto=0;
	}

?>

<div class='container'>
	<form is="f-submit" id="form_editar" db="a_inventario/db_" fun="guardar_producto" des="a_inventario/editar" desid='idproducto'>
		<input type="hidden" name="idproducto" id="idproducto" value="<?php echo $idproducto;?>">
		<div class='card'>
			<div class='card-header'>
				<?php echo $nombre;?>
			</div>
			<div class='card-body'>
				<div class='tab-content' id='myTabContent'>
					<div class='tab-pane fade show active' id='ssh' role='tabpanel' aria-labelledby='ssh-tab'>
						<form id='form_producto' action='' data-lugar='/db_' data-destino='/editar' data-funcion='guardar_producto'>
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
								<div class="col-8">
								 <label>Nombre</label>
								 <input type="text" class="form-control form-control-sm" id="nombre" name='nombre' placeholder="Descripción" value="<?php echo $nombre; ?>" readonly>
								</div>

								<div class="col-4">
								 <label>Activo</label>
									<select class="form-control form-control-sm" name="activo_producto" id="activo"  >
										<option value="0"<?php if($activo_producto=="0") echo "selected"; ?> > Inactivo</option>
										<option value="1"<?php if($activo_producto=="1") echo "selected"; ?> > Activo</option>
									</select>
								</div>


								<div class="col-12">
								 <label>Descripción</label>
								 <textarea class="form-control form-control-sm" id="descripcion" name='descripcion' readonly rows='5'><?php echo $descripcion; ?></textarea>
								</div>
							</div>
							<div class='row'>
								<div class="col-2">
									<?php
									if($tipo==3){
										$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$idproducto'";
										$sth = $db->dbh->prepare($sql);
										$sth->execute();
										$cantidad=$sth->fetch(PDO::FETCH_OBJ);
										$exist=$cantidad->total;
									}
									?>
								 <label>Existencias</label>
								 <input type="text" class="form-control form-control-sm" id="tmp_ex" name='tmp_ex' placeholder="Existencias" value="<?php echo $exist; ?>" readonly>
								</div>

								<div class="col-2">
								 <label>$ compra x Unidad</label>
								 <input type="text" class="form-control form-control-sm" id="preciocompra" name='preciocompra' placeholder="Precio" value="<?php echo $preciocompra; ?>">
								</div>
								<div class="col-2">
								 <label>$ Venta</label>
								 <input type="text" class="form-control form-control-sm" id="precio" name='precio' placeholder="Precio" value="<?php echo $precio; ?>" required>
								</div>
								<div class="col-2">
								 <label>$ Mayoreo</label>
								 <input type="text" class="form-control form-control-sm" id="preciom" name='preciom' placeholder="Precio Mayoreo" value="<?php echo $preciom; ?>" >
								</div>
								<div class="col-2">
								 <label>$ Distribuidor</label>
								 <input type="text" class="form-control form-control-sm" id="preciod" name='preciod' placeholder="Precio Distribuidor" value="<?php echo $preciod; ?>" >
								</div>

								<div class="col-2">
								 <label>Stock Minimo</label>
								 <input type="text" class="form-control form-control-sm" id="stockmin" name='stockmin' placeholder="Stock Minimo" value="<?php echo $stockmin; ?>">
								</div>

							</div>

							<p></p>
							<p></p>
								<div class='row'>
									<div class="container">
  									<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo" onclick="<?php if ($descxmonto==0) { $descxmonto=3;}?>">Desc. x Monto($)</button>
										<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo2">Desc. x Cantidad</button>
										<?php if ($descxmonto==1){
  									echo "<div id='demo' class='collapse show'>";
										}
										else{
											echo "<div id='demo' class='collapse'>";
										}

										?>


											<div class='row'>

												<div class="col-2">
												 <label>$ Mayoreo</label>
												 <input type="text" class="form-control form-control-sm" id="xmontomay" name='xmontomay' placeholder="$ Mayoreo >" value="<?php echo $xmontomay; ?>" >
												</div>

												<div class="col-2">
												 <label>$ Distribuidor</label>
												 <input type="text" class="form-control form-control-sm" id="xmontodis" name='xmontodis' placeholder="$ Distribuidor >" value="<?php echo $xmontodis; ?>" >
												</div>

											 </div>

  								  	</div>
									</div>
								</div>

								<div class='row'>
									<div class="container">

										<?php if ($descxcant==1){
  									echo "<div id='demo2' class='collapse show'>";
										}
										else{
											echo "<div id='demo2' class='collapse'>";
										}

										?>


											<div class='row'>

												<div class="col-2">
												 <label>Mayoreo</label>
												 <input type="text" class="form-control form-control-sm" id="xcantmay" name='xcantmay' placeholder="# Cant. Mayoreo" value="<?php echo $xcantmay; ?>" >
												</div>

												<div class="col-2">
												 <label>Distribuidor</label>
												 <input type="text" class="form-control form-control-sm" id="xcantdis" name='xcantdis' placeholder="# Cant. Distribuidor" value="<?php echo $xcantdis; ?>" >
												</div>


											</div>

  									</div>
									</div>
								</div>


							<hr>

							<div class='row'>
								<div class="col-12">
										<?php

												echo "<button type='submit' class='btn btn-warning btn-sm'><i class='far fa-save'></i>Guardar</button>";


											if($idproducto>0){
												if($tipo==3){
													echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_inventario/form_agrega' omodal='1' v_id='0' v_idproducto='$idproducto' ><i class='fas fa-key'></i>+ existencias</button>";
												}
											}
										?>
										<button type='button' class='btn btn-warning btn-sm' id='lista_cat' is='b-link'  des='a_inventario/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
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
							<th>Cantidad</th>
							<th>Precio</th>
							</tr>";
							$total=0;
							foreach($row as $key){
								echo "<tr id='".$key->idbodega."' class='edit-t'>";
									echo "<td>";
										echo "<div class='btn-group'>";
										if(!$key->idventa){

										echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_inventario/editar' desid='idbodega' dix='trabajo' db='a_inventario/db_'  fun='borrar_ingreso' v_idbodega='$key->idbodega' v_idproducto='$idproducto' tp='¿Desea eliminar la entrada?' title='Borrar'><i class='far fa-trash-alt'></i></button>";
										}
										echo "</div>";
									echo "</td>";
									echo "<td>";
										echo fecha($key->fecha);
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
