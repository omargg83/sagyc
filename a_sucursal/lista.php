<?php
	require_once("db_.php");
	$pd = $db->sucursal_lista();
?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			SUCURSAL
			</div>
		</div>
		<div class='header-row'>
			<div class='cell'>#</div>
			<div class='cell'>Nombre</div>
			<div class='cell'>Ubicación</div>
			<div class='cell'>Ciudad</div>
			<div class='cell'>Teléfono 1</div>
			<div class='cell'>Teléfono 2</div>
		</div>

		<?php
			foreach($pd as $key){
				echo "<div class='body-row' draggable='true'>";
					echo "<div class='cell text-center'>";
						echo "<div class='btn-group'>";

						echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_sucursal/editar' dix='trabajo' v_idsucursal='$key->idsucursal'><i class='fas fa-pencil-alt'></i></button>";

						echo "</div>";
					echo "</div>";
					echo "<div class='cell' data-titulo='Nombre'>".$key->nombre."</div>";
					echo "<div class='cell' data-titulo='Ubicación'>".$key->ubicacion."</div>";
					echo "<div class='cell' data-titulo='ciudad'>".$key->ciudad."</div>";
					echo "<div class='cell' data-titulo='Teléfono 1'>".$key->tel1."</div>";
					echo "<div class='cell' data-titulo='Teléfono 2'>".$key->tel2."</div>";
				echo "</div>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
