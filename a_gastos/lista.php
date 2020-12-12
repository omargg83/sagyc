<?php
	require_once("db_.php");
	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->gastos_buscar($texto);
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->gastos_lista($pag);
	}
?>
<div class='container'>
<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-12'>
			LISTA DE GASTOS
		</div>
	</div>
	<div class='row header-row'>
		<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>#</div>
		<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Fecha</div>
		<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Gasto</div>
		<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Descripción</div>
		<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Costo</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
					echo "<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 text-center'>";
						echo "<div class='btn-group'>";

						echo "<button type='button' class='btn btn-warning btn-sm' id='edit_persona' is='b-link' title='Editar' des='a_gastos/editar' dix='trabajo' v_idgastos='$key->idgastos'><i class='fas fa-pencil-alt'></i></button>";

						echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_gastos/db_' des='a_gastos/lista' fun='borrar_gasto' dix='trabajo' v_idgastos='$key->idgastos' id='eliminar' tp='¿Desea eliminar el gasto seleccionado?'><i class='far fa-trash-alt'></i></button>";

						echo "</div>";
					echo "</div>";

					echo "<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->fecha."</div>";
					echo "<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->gasto."</div>";
					echo "<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 '>".$key->descripcion."</div>";
					echo "<div class='col-12 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 text-right'>".moneda($key->costo)."</div>";
				echo "</div>";
			}
		?>
	</div>
	</div>

	<?php
		if(strlen($texto)==0){
			$sql="SELECT count(idgastos) as total FROM gastos where idtienda='".$_SESSION['idtienda']."' and idsucursal= '".$_SESSION['idsucursal']."'";
			$sth = $db->dbh->query($sql);
			$contar=$sth->fetch(PDO::FETCH_OBJ);
			$paginas=ceil($contar->total/$_SESSION['pagina']);
			$pagx=$paginas-1;

			echo $db->paginar($paginas,$pag,$pagx,"a_gastos/lista","trabajo");
		}
	?>
