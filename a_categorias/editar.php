<?php
	require_once("db_.php");
	if (isset($_REQUEST['idcategoria'])){$idcategoria=clean_var($_REQUEST['idcategoria']);} else{ $idcategoria=0;}

	$nombre="";
	$archivo="";
	if($idcategoria>0){
		$pd = $db->categoria($idcategoria);
		$nombre=$pd->nombre;
		$archivo=$pd->archivo;
	}
?>

<div class="container">
		<form is="f-submit" id="form_editar" db="a_categorias/db_" fun="guardar_categoria" lug="a_categorias/editar" desid='idcategoria'>
		<input type="hidden" name="idcategoria" id="idcategoria" value="<?php echo $idcategoria;?>">
		<div class='card'>
			<div class='card-header'>
				Administrar categorías
			</div>
			<div class='card-body'>
				<div class='row'>
					<?php
						echo "<div class='col-2'>";

							if(strlen($archivo)>0 and file_exists("../".$db->f_categoria."/".$archivo)){
								echo "<img src='".$db->f_categoria."/".$archivo."' width='100px' class='img-thumbnail'/>";
							}
							else{
								echo "<img src='img/unnamed.png' width='100px' class='img-thumbnail'/>";
							}

						echo "</div>";
					?>

					<div class="col-10">
						<label>Nombre categoría:</label>
							<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" value="<?php echo $nombre;?>" placeholder="Nombre" required maxlength="55">
					</div>

				</div>
			</div>
			<div class='card-footer'>
				<div class="row">
					<div class="col-12">
						<div class="btn-group">

							<button class="btn btn-warning btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<?php
								echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_categorias/form_foto' v_idcategoria='$idcategoria' omodal='1'><i class='fas fa-camera'></i>Foto</button>";
						 	?>
							<button type='button' class='btn btn-warning btn-sm' id='lista_penarea' is='b-link'  des='a_categorias/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
