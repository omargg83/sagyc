<?php
	require_once("db_.php");
	$pd = $db->sucursal_lista();
	echo "<div class='container' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-12'>
			SUCURSAL
		</div>
	</div>
	<div class='row header-row'>
		<div class='col-2'>#</div>
		<div class='col-2'>Nombre</div>
		<div class='col-2'>Ubicacion</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
					echo "<div class='col-2'>";
					echo "<div class='btn-group'>";

					echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_sucursal/editar' dix='trabajo' v_idsucursal='$key->idsucursal'><i class='fas fa-pencil-alt'></i></button>";

					echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_sucursal/db_' des='a_sucursal/lista' fun='borrar_sucursal' dix='trabajo' v_idsucursal='$key->idsucursal' id='eliminar' tp='¿Desea eliminar la sucursal seleccionada?'><i class='far fa-trash-alt'></i></button>";

					echo "</div>";
					echo "</div>";
					echo "<div class='col-2'>".$key->nombre."</div>";
					echo "<div class='col-2'>".$key->ubicacion."</div>";
				echo "</div>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
