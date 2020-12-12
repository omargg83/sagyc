<?php
	require_once("db_.php");

	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->usuario_buscar($texto);
		$texto=1;
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->usuario_lista($pag);
	}
?>
<div class='container'>
<div class='tabla_css' id='tabla_css'>
	<div class='row titulo-row'>
		<div class='col-12'>
			LISTA DE USUARIOS
		</div>
	</div>
	<div class='row header-row'>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>#</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3'>NOMBRE</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3'>CORREO</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>ACTIVO</div>
		<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>SUCURSAL</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='row body-row' draggable='true'>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>";
						if($db->nivel_captura==1){
							echo "<button class='btn btn-warning btn-sm' is='b-link' des='a_usuarios/editar' dix='trabajo' v_id='$key->idusuario' id='edit_persona'><i class='fas fa-pencil-alt'></i></button>";

							if($_SESSION['nivel']==66){
									echo "<button type='button' class='btn btn-danger btn-sm' is='b-link' db='a_usuarios/db_' fun='cambiar_user' dix='trabajo' v_id='$key->idusuario' id='cabiar' tp='¿Desea cambiar a la cuenta selecionada?'><i class='fas fa-user-shield'></i></button>";
							}
						}
						echo "</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3'>".$key->nombre."</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3'>".$key->correo."</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>";
						if ($key->activo==0) { echo "Inactivo"; }
						if ($key->activo==1) { echo "Activo"; }
					echo "</div>";
					echo "<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>";
						$sucursal=$db->sucursal($key->idsucursal);
						echo $sucursal->nombre;
					echo "</div>";
				echo "</div>";
			}
		?>
	</div>
</div>


<?php
	if(strlen($texto)==0){
		if($db->nivel_personal==0){
			$sql="SELECT count(usuarios.idusuario) as total FROM usuarios
			LEFT OUTER JOIN tienda ON tienda.idtienda = usuarios.idtienda
			where tienda.idtienda='".$_SESSION['idtienda']."'";
			$sth = $db->dbh->query($sql);
			$contar=$sth->fetch(PDO::FETCH_OBJ);
			$paginas=ceil($contar->total/$_SESSION['pagina']);
			$pagx=$paginas-1;

			echo $db->paginar($paginas,$pag,$pagx,"a_usuarios/lista","trabajo");
		}
	}
?>
