<?php
	require_once("db_.php");
	$pd = $db->compras_lista();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-12'>
			LISTA DE COMPRAS
		</div>
	</div>
	<div class='row header-row'>
		<div class='col-2'>#</div>
		<div class='col-2'>Fecha</div>
		<div class='col-2'>Numero</div>
		<div class='col-2'>Nombre</div>
		<div class='col-4'>Proveedor</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
					echo "<div class='col-2'>";

						echo "<div class='btn-group'>";
							echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_compras/editar' dix='trabajo' v_idcompra='$key->idcompra'><i class='fas fa-pencil-alt'></i></button>";
							echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_compras/db_' des='a_compras/lista' fun='borrar_compra' dix='trabajo' v_idcompra='$key->idcompra' id='eliminar' tp='¿Desea eliminar la compra seleccionada?'><i class='far fa-trash-alt'></i></button>";
						echo "</div>";

					echo "</div>";

					echo "<div class='col-2'>".fecha($key->fecha)."</div>";
					echo "<div class='col-2'>".$key->numero."</div>";
					echo "<div class='col-2'>".$key->nombre."</div>";
					echo "<div class='col-4'>".$key->idproveedor."</div>";

				echo "</div>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
