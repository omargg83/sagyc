<?php
	require_once("db_.php");

	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->producto_buscar($texto);
		$texto=1;
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->productos_lista($pag);
	}
	$sucursal=$db->sucursal();

?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			LISTA DE PRODUCTOS
		</div>
	</div>
	<div class='header-row'>
		<div class='cell'>#</div>
		<div class='cell'>Tipo</div>
		<div class='cell'>Código</div>
		<div class='cell'>Nombre</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='body-row' draggable='true'>";
					echo "<div class='cell'>";
						echo "<div class='btn-group'>";

						echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_productos/editar' dix='trabajo' v_idcatalogo='$key->idcatalogo'><i class='fas fa-pencil-alt'></i></button>";

						////////////quitar este boton o esconder
					//	echo "<button type='button' class='btn btn-danger btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_productos/homologar' omodal=1 v_idcatalogo='$key->idcatalogo'><i class='fas fa-pencil-alt'></i>HOMOLOGAR</button>";

						echo "</div>";
					echo "</div>";

					echo "<div class='cell' data-titulo='Tipo'>";
						if($key->tipo==0) echo "Servicio";
						if($key->tipo==3) echo "Producto";
					echo "</div>";

					echo "<div class='cell' data-titulo='Código'>".$key->codigo."</div>";
					echo "<div class='cell'data-titulo='Nombre'>".$key->nombre."</div>";
				echo '</div>';
			}
		?>

	</div>
</div>


	<?php
		if(strlen($texto)==0){
			$sql="SELECT count(productos_catalogo.idcatalogo) as total
			from productos_catalogo	where productos_catalogo.idtienda='".$_SESSION['idtienda']."'";
			$sth = $db->dbh->query($sql);
			$contar=$sth->fetch(PDO::FETCH_OBJ);
			$paginas=ceil($contar->total/$_SESSION['pagina']);
			$pagx=$paginas-1;
			echo $db->paginar($paginas,$pag,$pagx,"a_productos/lista","trabajo");
		}
	?>
