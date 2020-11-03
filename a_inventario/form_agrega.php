<?php
	require_once("db_.php");
	$id=$_REQUEST['id'];
	$idproducto=$_REQUEST['idproducto'];

	$cantidad="";
	$fecha=date("Y-m-d");
	$nota="";
	$precio="";
?>

<form is="f-submit" id="form_inventario" db="a_inventario/db_" fun="existencia_agrega" des="a_inventario/editar" desid='idproducto'>
<div class='modal-header'>
	<h5 class='modal-title'>Agregar existencia</h5>
</div>
  <div class='modal-body' >
	<?php
		echo "<input type='hidden' id='id' NAME='id' value='$id'>";
		echo "<input type='hidden' id='idproducto' NAME='idproducto' value='$idproducto'>";
	?>
		<div class='row'>
			<div class="col-3">
			 <label>Cantidad</label>
			 <input type="text" class="form-control form-control-sm" id="cantidad" name='cantidad' placeholder="Cantidad" value="<?php echo $cantidad; ?>">
			</div>
			<div class="col-3">
			 <label>Precio de compra</label>
			 <input type="text" class="form-control form-control-sm" id="precio" name='precio' placeholder="Precio" value="<?php echo $precio; ?>">
			</div>
			<div class="col-3">
			 <label>Fecha</label>
			 <input type="date" class="form-control form-control-sm fechaclass" id="fecha" name='fecha' placeholder="Fecha" value="<?php echo $fecha; ?>">
			</div>
			<div class="col-3">


			 <label>Nota de compra</label>
			 <?php
			 	echo "<select type='text' class='form-control form-control-sm' id='idcompra' name='idcompra'>";
					echo "<option value='0'></option>";
					foreach ($db->compras_lista() as $v2){
						echo "<option value='$v2->idcompra'>$v2->nombre</option>";
					}
				echo "</select>";
			?>


			</div>
		</div>
	</div>
	<div class='modal-footer' >

		<div class='modal-footer' >

			<button class='btn btn-warning btn-sm' type='submit' is="f-submit" id='acceso' title='Guardar'><i class='far fa-save'></i>Guardar</button>
			<button class="btn btn-warning btn-sm" type="button" is="b-link" cmodal='1' ><i class="fas fa-sign-out-alt"></i>Cancelar</button>
		</div>

  </div>
</form>
