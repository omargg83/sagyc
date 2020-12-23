<?php
	require_once("db_.php");
	$pd = $db->tienda_lista();
?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			DATOS DE LA EMPRESA
		</div>
	</div>
	<div class='header-row'>
		<div class='cell'>#</div>
		<div class='cell'>Razón Social</div>
		<div class='cell'>Calle</div>
		<div class='cell'>No.</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='body-row' draggable='true'>";
					echo "<div class='cell'>";
						echo "<div class='btn-group'>";
							echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_datosemp/editar' dix='trabajo' v_idtienda='$key->idtienda'><i class='fas fa-pencil-alt'></i></button>";
						echo "</div>";
					echo "</div>";
					echo "<div class='cell' data-titulo='Razón social'>".$key->razon."</div>";
					echo "<div class='cell' data-titulo='Calle'>".$key->calle."</div>";
					echo "<div class='cell' data-titulo='No.'>".$key->no."</div>";
				echo "</div>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
