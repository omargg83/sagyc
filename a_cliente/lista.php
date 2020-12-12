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
<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-12'>
			LISTA DE CLIENTES
		</div>
	</div>
	<div class='row header-row'>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>#</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>RFC</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Razon Social</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Nombre</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Correo</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Telefono</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 text-center'>";
							echo "<div class='btn-group'>";
							if($db->nivel_captura==1){
								echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_cliente/editar' dix='trabajo' v_id='$key->idcliente'><i class='fas fa-pencil-alt'></i></button>";
							}

						echo "</div>";
					echo "</div>";

					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->rfc."</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->razon_social."</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->nombre."</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->correo."</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->telefono."</div>";
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
