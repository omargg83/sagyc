<?php
	require_once("db_.php");
	$idcategoria=$_REQUEST['idcategoria'];
?>
<form is="f-submit" id="form_foto" db="a_categorias/db_" fun="foto_cat" cmodal="1" des="a_categorias/editar" desid='idcategoria' cmodal='1' dix='trabajo'>
<div class='modal-header'>
	<h5 class='modal-title'>Actualizar foto</h5>
</div>
  <div class='modal-body' >
		<?php
			echo "<input  type='hidden' id='idcategoria' NAME='idcategoria' value='$idcategoria'>";
		?>
		<input type="file" name="foto" id="foto" value=""	>
	</div>
	<div class="modal-footer">
		<div class="btn-group">
			<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>
			<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" title='Cancelar'><i class='fas fa-undo-alt'></i>Cancelar</button>
		</div>
  </div>
</form>
