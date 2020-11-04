<?php
	require_once("db_.php");
	if (isset($_REQUEST['idtienda'])){$idtienda=$_REQUEST['idtienda'];} else{ $idtienda=0;}

	$razon="";
	$calle="";
	$no="";
	$col="";
	$ciudad="";
	$estado="";
	$nombre_sis="";
	$activo="";

	if($idtienda>0){
		$pd = $db->tienda($idtienda);
		$razon=$pd->razon;
		$calle=$pd->calle;
		$no=$pd->no;
		$col=$pd->col;
		$ciudad=$pd->ciudad;
		$estado=$pd->estado;
		$nombre_sis=$pd->nombre_sis;
		$activo=$pd->activo;
	}

?>

<div class="container">
	<form is="f-submit" id="form_cliente" db="a_empresas/db_" fun="guardar_tienda" des="a_empresas/editar" desid='idtienda'>
		<input type="hidden" name="idtienda" id="idtienda" value="<?php echo $idtienda;?>">
		<div class='card'>
			<div class='card-header'>
				Editar datos empresa
			</div>
			<div class='card-body'>
				<div class='row'>
					<div class="col-3">
						<label>Razón social:</label>
						<input type="text" class="form-control form-control-sm" name="razon" id="razon" value="<?php echo $razon;?>" placeholder="Razón">
					</div>
					<div class="col-3">
						<label>Nombre del sistema:</label>
						<input type="text" class="form-control form-control-sm" name="nombre_sis" id="nombre_sis" value="<?php echo $nombre_sis;?>" placeholder="Nombre del sistema" required>
					</div>
					<div class="col-3">
						<label>Calle:</label>
							<input type="text" class="form-control form-control-sm" name="calle" id="calle" value="<?php echo $calle;?>" placeholder="Calle" required>
					</div>
					<div class="col-3">
						<label>No.:</label>
							<input type="text" class="form-control form-control-sm" name="no" id="no" value="<?php echo $no;?>" placeholder="Número" required>
					</div>
				</div>
				<div class='row'>
					<div class="col-3">
						<label>Colonia:</label>
							<input type="text" class="form-control form-control-sm" name="col" id="col" value="<?php echo $col;?>" placeholder="Colonia" required>
					</div>
					<div class="col-3">
						<label>Ciudad:</label>
							<input type="text" class="form-control form-control-sm" name="ciudad" id="ciudad" value="<?php echo $ciudad;?>" placeholder="Ciudad" required>
					</div>
					<div class="col-3">
						<label>Estado:</label>
							<input type="text" class="form-control form-control-sm" name="estado" id="estado" value="<?php echo $estado;?>" placeholder="Estado" required>
					</div>

					<div class="col-3">
						<label>Activo:</label>
						<select class="form-control form-control-sm" name="activo" id="activo">
							<option value="1"<?php if($activo=="1") echo "selected"; ?> >Activo</option>
							<option value="2"<?php if($activo=="0") echo "selected"; ?> >Inactivo</option>
						</select>
					</div>
				</div>
			</div>
			<div class='card-footer'>
				<div class="row">
					<div class="col-sm-12">
						<button class="btn btn-warning btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
						<button type='button' class='btn btn-warning btn-sm' id='lista_penarea' is='b-link' des='a_empresas/lista' dix='trabajo' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<br>

<?php
	$pd = $db->usuario_lista($idtienda);

	echo "<div class='container' id='lista_clientes'>";
?>
<div class='card'>
	<div class='card-header'>
		Editar datos empresa
	</div>
	<div class='card-body'>
		<div class='tabla_css' id='tabla_css'>
		<div class='row titulo-row'>
			<div class='col-12'>
				LISTA DE USUARIOS
			</div>
		</div>
		<div class='row header-row'>
			<div class='col-2'>#</div>
			<div class='col-4'>NOMBRE</div>
			<div class='col-2'>NIVEL</div>
			<div class='col-2'>ACTIVO</div>
		</div>

			<?php
				foreach($pd as $key){
					echo "<div class='row body-row' draggable='true'>";
							echo "<div class='col-2'>";

								echo "<button class='btn btn-warning btn-sm' is='b-link' des='a_usuarios/editar' dix='lista_clientes' v_id='$key->idusuario' id='edit_persona'><i class='fas fa-pencil-alt'></i></button>";

								echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_usuarios/db_' des='a_usuarios/lista' fun='borrar_usuario' dix='trabajo' v_id='$key->idusuario' id='eliminar' tp='¿Desea eliminar el usuario seleccionado?'><i class='far fa-trash-alt'></i></button>";

							echo "</div>";
						echo "<div class='col-4'>".$key->nombre."</div>";
						echo "<div class='col-2'>".$key->nivel."</div>";
						echo "<div class='col-2'>";
						if ($key->activo==0) { echo "Inactivo"; }
						if ($key->activo==1) { echo "Activo"; }
						echo "</div>";
					echo "</div>";
				}
			?>
		</tbody>
		</table>
	</div>
	</div>
</div>
