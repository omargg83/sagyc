<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];
  $sql="SELECT * from productos where idtienda=".$_SESSION['idtienda']." and
  	(nombre like '%$texto%' or
    descripcion like '%$texto%' or
    codigo like '%$texto%'  or
    rapido like '%$texto%'
  ) order by nombre limit 1";
  $sth = $db->dbh->prepare($sql);
  $sth->execute();
  $res=$sth->fetchAll(PDO::FETCH_OBJ);
	echo "<div class='container'>";
	echo "<div class='tabla_css' id='tabla_css'>";
		echo "<div class='row header-row'>";
			echo "<div class='col-2'>Indicador</div>";
			echo "<div class='col-2'>Stock</div>";
			echo "<div class='col-6'>Descripción</div>";
			echo "<div class='col-2'>Precio</div>";
		echo "</div>";

	  if(count($res)>0){
	    foreach ($res as $key) {
				$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$key->idproducto'";
				$sth = $db->dbh->prepare($sql);
				$sth->execute();
				$cantidad=$sth->fetch(PDO::FETCH_OBJ);

	      echo "<div class='row body-row' is='b-card' draggable='true'>";
	      echo  "<div class='col-2'>";
		      echo  "<div class='btn-group'>";
					if($cantidad->total>0 or $key->tipo==0){
			      echo "<button type='button'  id='0' des='' dix='0' v_idproducto='0' class='btn btn-warning btn-sm' title='Producto en existencia o se trata de un servicio' omodal='1'><i class='far fa-thumbs-up'></i></button>";
					}
					else {
						echo "<button type='button'  id='0' des='' dix='0' v_idproducto='0' class='btn btn-danger btn-sm' title='Producto sin stock' omodal='1'><i class='far fa-thumbs-down'></i></button>";
					}

		    echo  "</div>";
	      echo  "</div>";

				echo  "<div class='col-2 text-center'>";
					echo $cantidad->total;
	      echo  "</div>";

	      echo  "<div class='col-6'>";
				echo  $key->codigo;
				echo "<br>";
	      echo  $key->nombre;
	      echo  "</div>";

				echo  "<div class='col-2'>";
	        echo 	moneda($key->precio);
	      echo  "</div>";

	      echo  "</div>";
	    }
	  }
		echo "</div>";
	echo "</div>";
?>