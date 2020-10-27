<?php
	require_once("db_.php");
	if (isset($_REQUEST['idsucursal'])){$idsucursal=$_REQUEST['idsucursal'];} else{ $idsucursal=0;}

	$nombre="";
	$ubicacion="";
	if($idsucursal>0){
		$pd = $db->sucursal($idsucursal);
		$nombre=$pd->nombre;
		$ubicacion=$pd->ubicacion;
	}
?>

<div class="container">
	<form is="f-submit" id="form_cliente" db="a_sucursal/db_" fun="guardar_sucursal" des="a_sucursal/editar" desid='idsucursal'>
		<input type="hidden" name="idsucursal" id="idsucursal" value="<?php echo $idsucursal;?>">
		<div class='card'>
			<div class='card-header'>
				Editar sucursal
			</div>
			<div class='card-body'>
				<div class='row'>
					<div class="col-6">
						<label>Nombre:</label>
							<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" value="<?php echo $nombre;?>" placeholder="Nombre" required>
					</div>
					<div class="col-6">
						<label>Ubicación:</label>
							<input type="text" class="form-control form-control-sm" name="ubicacion" id="ubicacion" value="<?php echo $ubicacion;?>" placeholder="Ubicación" required>
					</div>
				</div>
			</div>
			<div class='card-footer'>
				<div class="row">
					<div class="col-sm-12">
						<button class="btn btn-warning btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
						<button type='button' class='btn btn-warning btn-sm' id='lista_penarea' is='b-link' des='a_sucursal/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
