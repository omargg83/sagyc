<?php
	require_once("db_.php");
	if (isset($_REQUEST['idcatalogo'])){$idcatalogo=$_REQUEST['idcatalogo'];} else{ $idcatalogo=0;}

	$codigo="";
	$nombre="";
	$unidad="";

	$marca="";
	$modelo="";
	$descripcion="";
	$tipo="";
	$activo_catalogo="1";

	$color="";

	$cate=$db->categoria();
	if($idcatalogo>0){
		$per = $db->producto_editar($idcatalogo);
		$codigo=$per->codigo;
		$nombre=$per->nombre;
		$unidad=$per->unidad;
		$marca=$per->marca;
		$modelo=$per->modelo;
		$descripcion=$per->descripcion;
		$tipo=$per->tipo;
		$activo_catalogo=$per->activo_catalogo;

		$color=$per->color;
	}

?>

<div class='container'>
	<form is="f-submit" id="form_editar" db="a_productos/db_" fun="guardar_producto" des="a_productos/editar" desid='idcatalogo'>
		<input type="hidden" name="idcatalogo" id="idcatalogo" value="<?php echo $idcatalogo;?>">
		<div class='card'>
			<div class='card-header'>
				<?php echo $nombre;?>
			</div>
			<div class='card-body'>
				<div class='tab-content' id='myTabContent'>
					<div class='tab-pane fade show active' id='ssh' role='tabpanel' aria-labelledby='ssh-tab'>
						<form id='form_producto' action='' data-lugar='a_productos/db_' data-destino='a_productos/editar' data-funcion='guardar_producto'>
							<input type="hidden" class="form-control form-control-sm" id="id" name='id' value="<?php echo $idcatalogo; ?>">
							<div class='row'>
								<div class="col-12">
								 <label>Tipo de producto</label>
									<select class="form-control form-control-sm" name="tipo" id="tipo" <?php if ($idcatalogo>0){ echo "readonly";}  ?> required>
										<option value='' disabled selected>Seleccione una opción</option>
										<option value="3"<?php if($tipo=="3") echo "selected"; ?> > Producto (Se controla el inventario por volúmen)</option>
										<option value="0"<?php if($tipo=="0") echo "selected"; ?> > Servicio (solo registra ventas, no es necesario registrar entrada)</option>
									</select>
								</div>
							</div>
							<hr>
							<div class='row'>
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

							</div>

							<div class='row'>

								<div class="col-3">
								 <label>Activo</label>
									<select class="form-control form-control-sm" name="activo_catalogo" id="activo_catalogo"  >
										<option value="0"<?php if($activo_catalogo=="0") echo "selected"; ?> > Inactivo</option>
										<option value="1"<?php if($activo_catalogo=="1") echo "selected"; ?> > Activo</option>
									</select>
								</div>

							</div>
							<hr>

							<div class='row'>
								<div class="col-12">
										<?php
									//		if(strlen($idproductoventa)==0){
												echo "<button type='submit' class='btn btn-warning btn-sm'><i class='far fa-save'></i>Guardar</button>";
									//		}

											if($idcatalogo>0){
												if($tipo==3){
													echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_productos/form_agrega' omodal='1' v_id='0' v_idproducto='$idcatalogo' ><i class='fas fa-key'></i>+ existencias</button>";
												}
											}
										?>
										<button type='button' class='btn btn-warning btn-sm' id='lista_cat' is='b-link'  des='a_productos/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		</form>
</div>
