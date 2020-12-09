<?php
	require_once("db_.php");

	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->categorias_buscar($texto);
	}
	else{
		$pd = $db->categoria_lista();
	}
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";

	if($_SESSION['a_sistema']==1){
		echo "<br><button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_categorias/editar' dix='trabajo' v_idcat='0'><i class='fas fa-pencil-alt'></i>Nueva</button></hr>";
	}
	echo "<hr>";
?>

<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-xl col-auto'>
			LISTA DE CATEGORÍAS
		</div>
	</div>
	<div class='row header-row '>
		<div class='col-2'>#</div>
		<div class='col-10'>NOMBRE CATEGORÍA</div>
	</div>
		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
					echo "<div class='col-2'>";
						echo "<div class='btn-group'>";

						echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_categorias/editar' dix='trabajo' v_idcategoria='$key->idcategoria'><i class='fas fa-pencil-alt'></i></button>";

						echo "</div>";
					echo "</div>";

					echo "<div class='col-10'>".$key->nombre."</div>";
				echo "</div>";
			}
		?>
	</div>
</div>
