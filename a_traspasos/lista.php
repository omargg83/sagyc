<?php
	require_once("db_.php");

	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->traspasos_buscar($texto);
	}
	else{
		$pd = $db->traspasos_lista();
	}
?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
				LISTA DE ENVIOS
			</div>
		</div>
		<div class='header-row'>
			<div class='cell'>#</div>
			<div class='cell'>Número</div>
			<div class='cell'>Fecha</div>
			<div class='cell'>Nombre</div>
			<div class='cell'>Estado</div>
			<div class='cell'>Destino</div>
		</div>

			<?php
				foreach($pd as $key){
			?>
					<div class='row body-row' draggable='true'>
						<div class='cell'>
							<div class="btn-group">
								<button class='btn btn-warning btn-sm'  id='edit_persona' is='b-link' id='nueva_venta' des='a_traspasos/editar' dix='trabajo'  v_idtraspaso='<?php echo $key->idtraspaso; ?>' ><i class="fas fa-pencil-alt"></i></button>
							</div>
						</div>
						<div class='cell' data-titulo='Número'><?php echo $key->numero; ?></div>
						<div class='cell' data-titulo='Fecha'><?php echo fecha($key->fecha); ?></div>
						<div class='cell' data-titulo='Nombre'><?php echo $key->nombre; ?></div>

						<div class='cell' data-titulo='Estado'><?php echo $key->estado; ?></div>
						<div class='cell' data-titulo='Destino'><?php
							$sucursal=$db->sucursal($key->idsucursal);
							echo $sucursal->nombre;
						?></div>

					</div>
			<?php
				}
			?>
	</div>
	</div>
<br>

<?php
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->recepcion_buscar($texto);
	}
	else{
		$pd = $db->recepcion_lista();
	}


?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			LISTA DE RECEPCION
		</div>
	</div>
	<div class='header-row'>
		<div class='cell'>#</div>
		<div class='cell'>Número</div>
		<div class='cell'>Fecha</div>
		<div class='cell'>Nombre</div>
		<div class='cell'>Estado</div>
		<div class='cell'>Origen</div>
	</div>

		<?php
			foreach($pd as $key){
		?>
				<div class='body-row' draggable='true'>
					<div class='cell'>
						<div class="btn-group">
							<button class='btn btn-warning btn-sm'  id='edit_persona' is='b-link' id='nueva_venta' des='a_traspasos/editar' dix='trabajo'  v_idtraspaso='<?php echo $key->idtraspaso; ?>' ><i class="fas fa-pencil-alt"></i></button>
						</div>
					</div>
					<div class='cell' data-titulo='Número'><?php echo $key->numero; ?></div>
					<div class='cell' data-titulo='Fecha'><?php echo fecha($key->fecha); ?></div>
					<div class='cell' data-titulo='Nombre'><?php echo $key->nombre; ?></div>

					<div class='cell' data-titulo='Estado'><?php echo $key->estado; ?></div>
					<div class='cell' data-titulo='Origen'><?php
						$sucursal=$db->sucursal($key->iddesde);
						echo $sucursal->nombre;
					?></div>

				</div>
		<?php
			}
		?>
		</tbody>
	</table>
</div>
