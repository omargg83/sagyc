<?php
	require_once("db_.php");

	$idproducto=$_REQUEST['idproducto'];
	$pag=0;
	if(isset($_REQUEST['pag'])){
	$pag=$_REQUEST['pag'];
	}
  	$row=$db->productos_inventario($idproducto, $pag);
	$per = $db->producto_editar($idproducto);
	$tipo=$per->tipo;
  echo "<div class='card'>";
  echo "<div class='card-body'>";
		if($idproducto>0){
			echo "<div class='row'>";
				echo "<div class='col-12'>";
						echo "<div class='btn-group'>";
						if($tipo==3){
							echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_inventario/form_agrega' omodal='1' v_id='0' v_idproducto='$idproducto' ><i class='fas fa-plus'></i>existencias</button>";

							echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_inventario/form_quita' omodal='1' v_id='0' v_idproducto='$idproducto' ><i class='fas fa-minus'></i>existencias</button>";
						}
						echo "</div>";
				echo "</div>";
			echo "</div>";
		}
		echo "<br>";
	echo "</div>";

			echo "<div class='tabla_v' id='tabla_css'>";

		echo "<div class='header-row'>";
				if($_SESSION['nivel']==66){
				echo "<div class='cell'>-</div>";
				}
			echo "<div class='cell'>Fecha</div>";
			echo "<div class='cell'>Tipo</div>";
			echo "<div class='cell'>Descripción</div>";
			echo "<div class='cell'>Cantidad</div>";
			echo "<div class='cell'>Existencia</div>";
		echo "</div>";

     	 $total=0;
		$contar=0;
		foreach($row as $key){
			echo "<div class='body-row' draggable='true'>";
						echo "<div class='cell '>";
							echo "<div class='btn-group'>";

								if($_SESSION['nivel']==66){
									echo "<button type='button' class='btn btn-warning btn-sm' id='edit_bodega' is='b-link' title='Editar' des='a_inventario/form_bodega' dix='trabajo' v_idproducto='$key->idproducto' v_idbodega='$key->idbodega' omodal='1'><i class='fas fa-pencil-alt'></i></button>";
								}

								////////////agregar en este if el permiso. lo que puse solo permite eliminar si es ingreso, no elimina ni venta ni traspaso, nada... solo ingreso
								if(strlen($key->idcompra)==0 and strlen($key->idpadre)==0 and $contar==0 and strlen($key->idventa)==0){
									echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_inventario/db_' des='a_inventario/editar' desid='idproducto' fun='borrar_ingreso' dix='trabajo' id='eliminar' v_idbodega='$key->idbodega' tp='¿Desea eliminar el ingreso seleccionado?'><i class='far fa-trash-alt'></i></button>";
								}
							echo "</div>";

						echo "</div>";
			echo "<div class='cell' data-titulo='fecha'>";
				echo fecha($key->fecha,2);
							if(strlen($key->observaciones)>0){
								echo "<br>";
								echo $key->observaciones;
							}
			echo "</div>";
			echo "<div class='cell' data-titulo='Tipo'>";
				if($key->cantidad<0 and strlen($key->idcompra)==0 and strlen($key->idpadre)==0 and strlen($key->idventa)==0){
				echo "Descuento";
				}
				else if($key->cantidad>0 and strlen($key->idcompra)==0 and strlen($key->idpadre)==0){
				echo "Ingreso";
				}
				else if($key->cantidad>0 and strlen($key->idcompra)>0){
				echo "Compra";
				}
				else if(strlen($key->idventa)>0){
				echo "Venta";
				}
				else if($key->cantidad<0 and strlen($key->idtraspaso)>0){
				echo "Traspaso";
				}
							else if($key->cantidad>0 and strlen($key->idpadre)>0){
				echo "Ingreso x traspaso";
				}
							$usuario=$db->usuario($key->idpersona);
							echo "<br>";
							echo $usuario->nombre;
			echo "</div>";

			echo "<div class='cell text-center' data-titulo='Descripción'>";

				if(strlen($key->idtraspaso)>0){
				$sql="select * from traspasos where idtraspaso=$key->idtraspaso";
				$sth = $db->dbh->query($sql);
				$traspaso=$sth->fetch(PDO::FETCH_OBJ);
				echo "#:".$traspaso->numero;
				echo "<br>".$traspaso->nombre;
				}
				if(strlen($key->idcompra)>0){
				$sql="select * from compras where idcompra=$key->idcompra";
				$sth = $db->dbh->query($sql);
				$compra=$sth->fetch(PDO::FETCH_OBJ);
				echo "#:".$compra->numero;
				echo "<br>".$compra->nombre;
				}
				if(strlen($key->idventa)>0){
				$sql="select * from venta where idventa=$key->idventa";
				$sth = $db->dbh->query($sql);
				$venta=$sth->fetch(PDO::FETCH_OBJ);
				echo "#:".$venta->numero;
				}
							if(strlen($key->idpadre)>0){
								$sql="select * from bodega where idbodega='$key->idpadre'";
								$sth = $db->dbh->query($sql);
								$origen=$sth->fetch(PDO::FETCH_OBJ);

								$sql="select * from traspasos where idtraspaso=$origen->idtraspaso";
								$sth = $db->dbh->query($sql);
				$traspaso=$sth->fetch(PDO::FETCH_OBJ);
								echo "#:".$traspaso->numero;
								echo "<br>".$traspaso->nombre;
							}
			echo "</div>";
			echo "<div class='cell text-center' data-titulo='Cantidad'>";
				echo $key->cantidad;
			echo "</div>";
			echo "<div class='cell text-center ' data-titulo='Existencia'>";
				echo $key->existencia;
			echo "</div>";


			echo "</div>";
			$contar++;
		}
    echo "</div>";
  echo "</div>";

	$sql="select count(bodega.idbodega) as total from bodega where idproducto=$idproducto and idsucursal='".$_SESSION['idsucursal']."' order by idbodega desc";
	$sth = $db->dbh->query($sql);
	$contar=$sth->fetch(PDO::FETCH_OBJ);
	$paginas=ceil($contar->total/$_SESSION['pagina']);
	$pagx=$paginas-1;

	echo "<nav aria-label='Page navigation text-center'>";
		echo "<ul class='pagination'>";
		echo "<li class='page-item'><a class='page-link' is='b-link' title='Editar' des='a_inventario/lista_bodega' v_idproducto='$idproducto' dix='registro_bodega'>Primera</a></li>";
			$max=$pag+4;
			$min=$pag-4;
			for($i=0;$i<$paginas;$i++){
				if($min<=$i and $i<=$max){
					$b=$i+1;
					echo "<li class='page-item"; if($pag==$i){ echo " active";} echo "'><a class='page-link' is='b-link' title='Editar' des='a_inventario/lista_bodega' dix='registro_bodega' v_pag='$i' v_idproducto='$idproducto'>$b</a></li>";
				}
			}
		echo "<li class='page-item'><a class='page-link' is='b-link' title='Editar' des='a_inventario/lista_bodega' dix='registro_bodega' v_pag='$pagx' v_idproducto='$idproducto'>Ultima</a></li>";
		echo "</ul>";
	echo "</nav>";
echo "</div>";		
  
?>
