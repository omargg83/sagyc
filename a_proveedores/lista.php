<?php
	require_once("db_.php");

	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->provedores_buscar($texto);
	}
	else{
		$pd = $db->provedores_lista();
	}
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
	<table class='table table-sm' style='font-size:10pt;'>
	<thead>
	<th>#</th>
	<th>Nombre</th>
	<th>Email</th>
	<th>Telefonos</th>
	</thead>
	<tbody>
		<?php
			foreach($pd as $key){
				echo "<tr>";
					echo "<td>";
					echo "<div class='btn-group'>";

					echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_proveedores/editar' dix='trabajo' v_idproveedor='$key->idproveedor'><i class='fas fa-pencil-alt'></i></button>";

					echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_proveedores/db_' des='a_proveedores/lista' fun='borrar_cliente' dix='trabajo' v_idproveedor='$key->idproveedor' id='eliminar' tp='¿Desea eliminar el proveedor seleccionado?'><i class='far fa-trash-alt'></i></button>";

					echo "</div>";
					echo "</td>";

					echo "<td>".$key->nombre."</td>";
					echo "<td>".$key->emailp."</td>";
					echo "<td>".$key->telp."</td>";
				echo "</tr>";
			}
		?>
	</div>
	</tbody>
	</table>
</div>
