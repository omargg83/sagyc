<?php
	require_once("db_.php");
	$pd = $db->compras_lista();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>

	<table id='x_cliente' class='table table-sm' style='font-size:10pt;'>
	<thead>
	<th>#</th>
	<th>Nombre</th>
	<th>Ubicacion</th>
	</thead>
	<tbody>
		<?php
			foreach($pd as $key){
				echo "<tr>";
					echo "<td>";
					echo "<div class='btn-group'>";

					echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_compras/editar' dix='trabajo' v_idcompra='$key->idcompra'><i class='fas fa-pencil-alt'></i></button>";

					echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_compras/db_' des='a_compras/lista' fun='borrar_compra' dix='trabajo' v_idcompra='$key->idcompra' id='eliminar' tp='¿Desea eliminar la compra seleccionada?'><i class='far fa-trash-alt'></i></button>";

					echo "</div>";
					echo "</td>";
					echo "<td>".$key->fecha."</td>";
					echo "<td>".$key->numero."</td>";
				echo "</tr>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
