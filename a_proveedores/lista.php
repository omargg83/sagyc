<?php
	require_once("db_.php");

	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->provedores_buscar($texto);
		$texto=1;
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->provedores_lista($pag);
	}
?>


<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			LISTA DE PROVEEDORES
		</div>
	</div>
	<div class='header-row'>
		<div class='cell'>#</div>
		<div class='cell'>Nombre</div>
		<div class='cell'>Correo</div>
		<div class='cell'>Teléfono</div>
	</div>
		<?php
			foreach($pd as $key){
				echo "<div class='body-row' draggable='true'>";
					echo "<div class='cell'>";
						echo "<div class='btn-group'>";

						if($db->nivel_captura==1){
							echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_proveedores/editar' dix='trabajo' v_idproveedor='$key->idproveedor'><i class='fas fa-pencil-alt'></i></button>";
						}
						echo "</div>";
					echo "</div>";

					echo "<div class='cell' data-titulo='nombre'>".$key->nombre."</div>";
					echo "<div class='cell' data-titulo='Correo'>".$key->emailp."</div>";
					echo "<div class='cell' data-titulo='Teléfono'>".$key->telp."</div>";
				echo "</div>";
			}
		?>
	</div>
</div>

<?php
	if(strlen($texto)==0){
		$sql="SELECT count(idproveedor) as total FROM proveedores where idtienda='".$_SESSION['idtienda']."'";
		$sth = $db->dbh->query($sql);
		$contar=$sth->fetch(PDO::FETCH_OBJ);
		$paginas=ceil($contar->total/$_SESSION['pagina']);
		$pagx=$paginas-1;

		echo $db->paginar($paginas,$pag,$pagx,"a_proveedores/lista","trabajo");
	}
?>
