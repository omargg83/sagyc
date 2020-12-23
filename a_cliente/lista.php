<?php
	require_once("db_.php");

	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->clientes_buscar($texto);
		$texto=1;
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->clientes_lista($pag);
	}
?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			LISTA DE CLIENTES
			</div>
		</div>
		<div class='header-row'>
			<div class='cell'>#</div>
			<div class='cell'>RFC</div>
			<div class='cell'>Razon Social</div>
			<div class='cell'>Nombre</div>
			<div class='cell'>Correo</div>
			<div class='cell'>Telefono</div>
		</div>

		<?php
			foreach($pd as $key){
				echo "<div class='body-row' draggable='true'>";
						echo "<div class='cell'>";
							echo "<div class='btn-group'>";
							if($db->nivel_captura==1){
								echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_cliente/editar' dix='trabajo' v_id='$key->idcliente'><i class='fas fa-pencil-alt'></i></button>";
							}

						echo "</div>";
					echo "</div>";

					echo "<div class='cell ' data-titulo='RFC'>".$key->rfc."</div>";
					echo "<div class='cell ' data-titulo='Razon Social'>".$key->razon_social."</div>";
					echo "<div class='cell ' data-titulo='Nombre'>".$key->nombre."</div>";
					echo "<div class='cell ' data-titulo='Correo'>".$key->correo."</div>";
					echo "<div class='cell ' data-titulo='Telefono'>".$key->telefono."</div>";
				echo "</div>";
			}
		?>
	</div>
</div>

<?php
	if(strlen($texto)==0){
		$sql="SELECT count(idcliente) as total FROM clientes where idtienda='".$_SESSION['idtienda']."'";
		$sth = $db->dbh->query($sql);
		$contar=$sth->fetch(PDO::FETCH_OBJ);
		$paginas=ceil($contar->total/$_SESSION['pagina']);
		$pagx=$paginas-1;

		echo $db->paginar($paginas,$pag,$pagx,"a_cliente/lista","trabajo");
	}
?>
