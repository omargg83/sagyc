<?php
	require_once("db_.php");
	if (isset($_REQUEST['idproveedor'])){$idproveedor=$_REQUEST['idproveedor'];} else{ $idproveedor=0;}

	$nombre="";

	if($idproveedor>0){
		$pd = $db->provedor($idproveedor);
		$nombre=$pd->nombre;
	}

?>

<div class="container">
		<form is="f-submit" id="form_editar" db="a_proveedores/db_" fun="guardar_provedor" lug="a_cliente/editar" desid='idproveedor'>
		<input type="hidden" name="idproveedor" id="idproveedor" value="<?php echo $idproveedor;?>">
		<div class='card'>
			<div class='card-header'>
				Editar cliente
			</div>
			<div class='card-body'>
				<div class='row'>
					<div class="col-3">
						<label>Nombre:</label>
							<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" value="<?php echo $nombre;?>" placeholder="Nombre" required maxlength="100">
					</div>
				</div>
			</div>
			<div class='card-footer'>
				<div class="row">
					<div class="col-sm-12">

						<button class="btn btn-warning btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
						<button type='button' class='btn btn-warning btn-sm' id='lista_penarea' is='b-link'  des='a_proveedores/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>

					</div>
				</div>
			</div>
		</div>
	</form>
</div>
