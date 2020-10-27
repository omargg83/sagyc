<?php
require_once("db_.php");
$idcompra=$_REQUEST['idcompra'];
$proveedores = $db->proveedores_lista();
if($idcompra>0){
	$pd = $db->compra($idcompra);
	$numero=$pd->numero;
	$idproveedor=$pd->idproveedor;
	$estado=$pd->estado;
}
else{
	$idproveedor=1;
	$numero="";
	$estado="Activa";
}
?>
<div class="container">
	<div class='card'>
		<div class='card-header'>Entrada de productos # <?php echo $idcompra; ?></div>
		<form is="f-submit" id="form_editar" db="a_compras/db_" fun="guardar_entrada" des="a_compras/editar" desid='idcompra'>
			<div class='card-body'>
				<div class='row'>
					<div class='col-2'>
						<label>Entrada:</label>
						<input type="text" name="idcompra" id="idcompra" value="<?php echo $idcompra; ?>" class="form-control" readonly>
					</div>
					<div class="col-5">
						<label >Folio de compra:</label>
						<input type="text" class="form-control" name="numero" id="numero" value="<?php echo $numero ;?>" placeholder="Número de compra">
					</div>
					<div class="col-3">
						<label >Proveedor:</label>
						<?php
						echo "<select class='form-control' name='idproveedor' id='idproveedor'>";
						echo '<option disabled>Seleccione el proveedor</option>';
						foreach($proveedores as $v1){
							echo '<option value="'.$v1->idproveedor.'"';
							if($v1->idproveedor==$idproveedor){
								echo " selected";
							}
							echo '>'.$v1->nombre.'</option>';
						}
						echo "</select>";
						?>
					</div>

					<div class="col-2">
						<label >Estado:</label>
						<input type="text" class="form-control" name="estado" id="estado" value="<?php echo $estado ;?>" readonly>
					</div>

				</div>
			</div>
			<div class='card-footer'>
				<div class="row">
					<div class="col-sm-12">
						<?php
							if($estado=="Activa"){
								echo "<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
							}
							if($idcompra>0 and $estado=="Activa"){
								echo "<button type='button' class='btn btn-warning btn-sm' id='producto_add' is='b-link' v_idcompra='$idcompra' des='a_compras/form_producto' omodal='1' title='Agregar Producto'><i class='fab fa-product-hunt'></i>+ Producto</button>";
								echo "<button class='btn btn-outline-secondary btn-sm' type='button' onclick='entradaend($idcompra)'><i class='fas fa-lock'></i>Finalizar</button>";
							}
						?>
						<button type='button' class='btn btn-warning btn-sm' id='lista_cat' is='b-link'  des='a_compras/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>
				</div>
			</div>
		</form>
		<?php

		if($idcompra>0){
			echo "<div class='card-body' id='pedidos'>";
			include 'form_pedido.php';
			echo "</div>";
		}

		?>
	</div>
</div>
