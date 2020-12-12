<?php
	require_once("db_.php");
	$idproducto=$_REQUEST['idproducto'];
	$cate=$db->categoria();
	$rapido=0;
	if(isset($_REQUEST['rapido'])){
		$rapido=$_REQUEST['rapido'];
	}
	if($idproducto>0){
		if(!isset($_REQUEST['idbodega'])){
			$db->recalcular($idproducto);
		}

		$per = $db->producto_editar($idproducto);
		$exist=$per->cantidad;
		$precio=$per->precio;
		$stockmin=$per->stockmin;
		$codigo=$per->codigo;
		$archivo=$per->archivo;

		$preciocompra=$per->preciocompra;
		$idcatalogo=$per->idcatalogo;
		$nombre=$per->nombre;
		$descripcion=$per->descripcion;
		$tipo=$per->tipo;
		$activo_producto=$per->activo_producto;


		$esquema=$per->esquema;
		$precio_mayoreo=$per->precio_mayoreo;
		$precio_distri=$per->precio_distri;
		//// variables esquema NALA
		$cantidad_mayoreo=$per->cantidad_mayoreo;
		$monto_mayor=$per->monto_mayor;
		$monto_distribuidor=$per->monto_distribuidor;
		///// varibables esquema 2
		$mayoreo_cantidad=$per->mayoreo_cantidad;
		$distri_cantidad=$per->distri_cantidad;

		$sql="select etiqueta from sucursal where idsucursal='".$_SESSION['idsucursal']."'";
		$sth = $db->dbh->prepare($sql);
		$sth->execute();
		$sucu=$sth->fetch(PDO::FETCH_OBJ);
		$tamanoetiqueta=$sucu->etiqueta;
		///

	}
	else{
		$precio=0;
		$stockmin=1;

		$cantidad=0;
		$preciocompra="";

		$nombre="";
		$descripcion="";
		$tipo="";
		$activo_producto=0;

		$esquema=0;
		//// variables esquema NALA
		$cantidad_mayoreo=0;
		$precio_mayoreo=0;
		$monto_mayor=1000;
		$monto_distribuidor=3000;
		///// variables esquema 2
		$mayoreo_cantidad=0;
		$distri_cantidad=0;
		$precio_distri=0;


		$codigo=0;
	}

?>

<div class='container'>
	<div class='card'>
		<form is="f-submit" id="form_editar" db="a_inventario/db_" fun="guardar_producto" des="a_inventario/editar" desid='idproducto'>
			<input type="hidden" name="idproducto" id="idproducto" value="<?php echo $idproducto;?>">
			<div class='card-header'>
				<div class='row'>
					<div class='col-12'>
						<?php echo "<b>".$nombre."</b>";

						 echo "<br><small>";
						 if($tipo==0){
							 echo "Servicio (solo registra ventas, no es necesario registrar entrada)";
						 }
						 if($tipo==3){
							 echo "Producto (Se controla el inventario por volúmen)";
						 }
						 echo "</small>";
						?>
					</div>
				</div>
			</div>
			<div class='card-body'>
				<div class='row'>
					<div class="col-4">
						<?php
							if(strlen($archivo)>0 and file_exists("../".$db->f_productos."/".$archivo)){
								echo "<img src='".$db->f_productos."/".$archivo."' width='200px' class='img-thumbnail'/>";
							}
							else{
								echo "<img src='img/unnamed.png' width='200px' class='img-thumbnail'/>";
							}
					 	?>
					</div>
					<div class="col-8">
						<div class='row'>
								<div class="col-12 col-xl col-auto">
								 <label><b>Codigo</b></label>
								 <p><?php echo $codigo; ?></p>

								</div>
								<div class="col-12 col-xl col-auto">
								 <label><b>Producto</b></label>
								 <p><?php echo $nombre; ?></p>
								</div>
							</div>
							<div class='row'>
							<div class="col-12 col-xl col-auto">
							 <label><b>Activo</b></label>
							 <p><?php
							 		if($activo_producto=="1"){ echo "Activo"; }
							 		if($activo_producto=="0"){ echo "Inactivo"; }
							  ?></p>
							</div>

							<div class="col-12 col-xl col-auto" style='max-height:100px;'>
							 <label><b>Descripción</b></label>
							 <p><?php echo $descripcion; ?></p>
							</div>
						</div>
					</div>
				</div>
				<hr>
			<?php
				if($tipo==3){
					$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$idproducto'";
					$sth = $db->dbh->prepare($sql);
					$sth->execute();
					$cantidad=$sth->fetch(PDO::FETCH_OBJ);
					$exist=$cantidad->total;
				}
			?>
				<div class='row mb-3'>
						<div class="col-12 col-xl col-auto">
						 <label><b>Existencias</b></label>
						 <input type="text" class="form-control form-control-sm" id="tmp_ex" name='tmp_ex' placeholder="Existencias" value="<?php echo $exist; ?>" readonly>
						</div>
						<!--
						<div class="col-12 col-xl col-auto">
						 <label>Precio compra</label>
						 <input type="text" class="form-control form-control-sm" id="preciocompra" name='preciocompra' placeholder="Precio" value="<?php echo $preciocompra; ?>">
						</div>

						<div class="col-12 col-xl col-auto">
						 <label>Stock Minimo</label>
						 <input type="text" class="form-control form-control-sm" id="stockmin" name='stockmin' placeholder="Stock Minimo" value="<?php echo $stockmin; ?>">
					 </div> -->

						<div class="col-12 col-xl col-auto">
						 <label>$ Venta</label>
						 <input type="text" class="form-control form-control-sm" id="precio" name='precio' placeholder="Precio" value="<?php echo $precio; ?>" required>
						</div>

						<!--<div class="col-12 col-xl col-auto">
						 <label>$ Mayoreo</label>
						 <input type="text" class="form-control form-control-sm" id="precio_mayoreo" name='precio_mayoreo' placeholder="Precio Mayoreo" value="<?php echo $precio_mayoreo; ?>">
						</div>

						<div class="col-12 col-xl col-auto">
						 <label>$ Distribuidor</label>
						 <input type="text" class="form-control form-control-sm" id="precio_distri" name='precio_distri' placeholder="Precio Distribuidor" value="<?php echo $precio_distri; ?>">
						</div>	-->

					</div>
			</div>
			<div class='card-footer'>
				<div class='row'>
					<div class='col-12 col-xl col-auto'>
						<div class='btn-group flex-wrap' data-toggle='buttons'>
							<?php
								if($_SESSION['a_sistema']==1){
									if($db->nivel_captura==1){
										if($_SESSION['matriz']==1){
											echo "<button type='submit' class='btn btn-warning btn-sm'><i class='far fa-save'></i>Guardar</button>";
										}
									}
								}

								if($idproducto>0){
									if($_SESSION['matriz']==1){
										echo "<button type='button' class='btn btn-warning btn-sm' id='genera_Barras' is='b-link' title='Editar' tp='¿Desea generar el codigo de barras?' db='a_inventario/db_' fun='barras' des='a_inventario/editar' dix='trabajo' v_idproducto='$idproducto' v_idcatalogo='$idcatalogo'><i class='fas fa-barcode'></i>Barras</button>";
									}
									if ($tamanoetiqueta==0) {
									echo "<button type='button' class='btn btn-warning btn-sm' id='Imprime_barras' is='b-print' title='Editar' des='a_inventario/imprimir' v_idcatalogo='$idcatalogo'><i class='fas fa-print'></i>Barras</button>";
										}
									else if ($tamanoetiqueta==1) {
									echo "<button type='button' class='btn btn-warning btn-sm' id='Imprime_barras' is='b-print' title='Editar' des='a_inventario/imprimir58' v_idcatalogo='$idcatalogo'><i class='fas fa-print'></i>Barras</button>";
										}
									else if ($tamanoetiqueta==2) {
									echo "<button type='button' class='btn btn-warning btn-sm' id='Imprime_barras' is='b-print' title='Editar' des='a_inventario/imprimir88' v_idcatalogo='$idcatalogo'><i class='fas fa-print'></i>Barras</button>";
										}
								}


								if($_SESSION['nivel']==66){
									echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='control_db' des='a_inventario/editar' fun='recalcular' dix='trabajo' v_idproducto='$idproducto'  v_ctrl='control' id='recal' tp='¿Desea recalcular lo pendiente?'><i class='fas fa-exclamation-triangle'></i></button>";

									echo "<button type='button' class='btn btn-danger btn-sm' is='b-link' db='control_db' des='a_inventario/editar' fun='recalcular' dix='trabajo' v_idproducto='$idproducto' v_idbodega='INICIO' v_ctrl='control' id='TIEMPOS' tp='¿Desea recalcular desde inicio de los tiempos?'><i class='fas fa-exclamation-triangle'></i></button>";
								}

								if($rapido==0){
									echo "<button type='button' class='btn btn-warning btn-sm' id='lista_cat' is='b-link'  des='a_inventario/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>";
								}
								else{
									echo "<button type='button' class='btn btn-warning btn-sm' id='lista_cat' is='b-link' cmodal='1' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>";
								}
							?>

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<br>

<div class='container' id='registro_bodega'>
	<?php
		include "lista_bodega.php";
 	?>
</div>
