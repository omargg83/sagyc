<?php
	require_once("db_.php");
	$pd = $db->tienda_lista();
	echo "<div class='container' style='background-color:".$_SESSION['cfondo']."; '>";
?>

	<table id='x_cliente' class='table table-sm' style='font-size:10pt;'>
	<thead>
	<th>#</th>
	<th>Razon</th>
	<th>Nombre del sistema</th>
	<th>Calle</th>
	<th>No.</th>
	</thead>
	<tbody>
		<?php
			foreach($pd as $key){
				echo "<tr>";
					echo "<td>";
					echo "<div class='btn-group'>";

					echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_empresas/editar' dix='trabajo' v_idtienda='$key->idtienda'><i class='fas fa-pencil-alt'></i></button>";

					echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_usuarios/lista' dix='trabajo' v_idtienda='$key->idtienda'><i class='fas fa-users'></i></button>";
					
					echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_sucursal/lista' dix='trabajo' v_idtienda='$key->idtienda'><i class='fas fa-store-alt'></i></button>";

					echo "</div>";
					echo "</td>";
					echo "<td>".$key->razon."</td>";
					echo "<td>".$key->nombre_sis."</td>";
					echo "<td>".$key->calle."</td>";
					echo "<td>".$key->no."</td>";
				echo "</tr>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
