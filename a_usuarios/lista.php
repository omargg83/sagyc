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
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
			LISTA DE USUARIOS
		</div>
	</div>
	<div class='header-row'>
		<div class='cell'>#</div>
		<div class='cell'>Nombre</div>
		<div class='cell'>Correo</div>
		<div class='cell'>Activo</div>
		<div class='cell'>Sucursal</div>
	</div>

		<?php
			foreach($pd as $key){
				echo "<div class='body-row' draggable='true'>";
					echo "<div class='cell'>";
						echo "<div class='btn-group'>";
						if($db->nivel_captura==1){
							echo "<button class='btn btn-warning btn-sm' is='b-link' des='a_usuarios/editar' dix='trabajo' v_id='$key->idusuario' id='edit_persona'><i class='fas fa-pencil-alt'></i></button>";

							if($_SESSION['nivel']==66){
									echo "<button type='button' class='btn btn-danger btn-sm' is='b-link' db='a_usuarios/db_' fun='cambiar_user' dix='trabajo' v_id='$key->idusuario' id='cabiar' tp='¿Desea cambiar a la cuenta selecionada?'><i class='fas fa-user-shield'></i></button>";
							}
						}
						echo "</div>";
					echo "</div>";


					echo "<div class='cell' data-titulo='Nombre'>";
						if(strlen($key->archivo)>0 and file_exists("../".$db->f_usuarios."/".$key->archivo)){
							echo "<img src='".$db->f_usuarios."/".$key->archivo."' width='30px' class='img-thumbnail'/>";
						}
						else{
							echo "<img src='img/user.jpg' width='30px' class='img-thumbnail'/>";
						}
						echo $key->nombre;
					echo "</div>";
					echo "<div class='cell' data-titulo='Correo'>".$key->correo."</div>";
					echo "<div class='cell' data-titulo='Activo'>";
						if ($key->activo==0) { echo "Inactivo"; }
						if ($key->activo==1) { echo "Activo"; }
					echo "</div>";
					echo "<div class='cell' data-titulo='Sucursal'>";
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
