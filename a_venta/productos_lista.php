<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];
  $idventa=$_REQUEST['idventa'];

	if($idventa>0){
		$sql="select * from venta where idventa='$idventa'";
		$sth = $db->dbh->prepare($sql);
		$sth->execute();
		$venta=$sth->fetch(PDO::FETCH_OBJ);
		$estado_compra=$venta->estado;
	}
	else{
		$estado_compra="Activa";
	}


  $sql="SELECT * from productos	left outer join productos_catalogo on productos_catalogo.idcatalogo=productos.idcatalogo
	where idsucursal=".$_SESSION['idsucursal']." and (nombre like '%$texto%' or  codigo like '%$texto%') order by nombre limit 20";
  $sth = $db->dbh->prepare($sql);
  $sth->execute();
  $res=$sth->fetchAll(PDO::FETCH_OBJ);


	echo "<div class='sagyc_productos'>";
	  if(count($res)>0){
	    foreach ($res as $key) {

			if($estado_compra=="Activa" and $_SESSION['a_sistema']==1){
				if($db->nivel_captura==1){
					echo "<button class='sagyc_item' type='button' is='b-link' id='sel_producto_$key->idproducto' 
					des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' 
					class='btn btn-warning btn-sm' title='Seleccionar producto' omodal='1'";
						if(strlen($key->archivo)>0 and file_exists("../".$db->f_productos."/".$key->archivo)){
						echo "style='background-image: url(\"".$db->f_productos."/".$key->archivo."\")'";
						}
						else{
						echo "style='background-image: url(\"img/unnamed.png'\") ";
						}
						echo ">";
						echo "<span>";
						echo  trim($key->nombre);          
						echo "</span>";
					echo "</button>";
	  
					//echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_venta/producto_selecciona' dix='resultadosx' v_idproducto='$key->idproducto' v_idventa='$idventa' class='btn btn-warning btn-sm' title='Seleccionar producto' omodal='1'><i class='fas fa-plus'></i></button>";
				}
			}
		      	
	    }
	  }
		echo "</div>";
	echo "</div>";
?>
