<?php
	require_once("db_.php");
	$pd = $db->sucursal_lista();
	echo "<div class='container' style='background-color:".$_SESSION['cfondo']."; '>";
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

					echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_sucursal/editar' dix='trabajo' v_idsucursal='$key->idsucursal'><i class='fas fa-pencil-alt'></i></button>";

					echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_sucursal/db_' des='a_sucursal/lista' fun='borrar_sucursal' dix='trabajo' v_idsucursal='$key->idsucursal' id='eliminar' tp='¿Desea eliminar la sucursal seleccionada?'><i class='far fa-trash-alt'></i></button>";

					echo "</div>";
					echo "</td>";
					echo "<td>".$key->nombre."</td>";
					echo "<td>".$key->ubicacion."</td>";
				echo "</tr>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
