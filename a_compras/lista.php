<?php
	require_once("db_.php");

	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->compras_buscar($texto);
		$texto=1;
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->compras_lista($pag);
	}

	?>
<div class='container'>
	<div class='tabla_css' id='tabla_css'>
		<div class='row titulo-row'>
			<div class='col-12'>
				LISTA DE COMPRAS
			</div>
		</div>
		<div class='row header-row'>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>#</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Fecha</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Numero</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Nombre</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Proveedor</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Estado</div>
		</div>

			<?php
				foreach($pd as $key){
					echo "<div class='row body-row' draggable='true'>";
						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>";

							echo "<div class='btn-group'>";
							if($db->nivel_captura==1){
								echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_compras/editar' dix='trabajo' v_idcompra='$key->idcompra'><i class='fas fa-pencil-alt'></i></button>";
							}
							echo "</div>";

						echo "</div>";

						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>".fecha($key->fecha)."</div>";
						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>".$key->numero."</div>";
						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>".$key->nombre."</div>";
						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>".$key->idproveedor."</div>";
						echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>".$key->estado."</div>";

					echo "</div>";
				}
			?>
		</div>
	</div>

	<?php
		if(strlen($texto)==0){
			$sql="SELECT count(idsucursal) as total FROM compras where idsucursal='".$_SESSION['idsucursal']."' order by numero desc";
			$sth = $db->dbh->query($sql);
			$contar=$sth->fetch(PDO::FETCH_OBJ);
			$paginas=ceil($contar->total/$_SESSION['pagina']);
			$pagx=$paginas-1;

			echo $db->paginar($paginas,$pag,$pagx,"a_compras/lista","trabajo");

		}
	?>
