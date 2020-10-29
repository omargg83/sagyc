<?php
	require_once("db_.php");
	$idventa=$_REQUEST['idventa'];
	$pedido = $db->ventas_pedido($idventa);


	echo "<div id='tablax'>";
		echo "<div class='row' >";
			echo "<div class='col-1'>";
				echo "--";
			echo "</div>";
			
			echo "<div class='col-3'>";
				echo "<B>NOMBRE</B>";
			echo "</div>";

			echo "<div class='col-2 text-center'>";
				echo "<B>CANTIDAD</B>";
			echo "</div>";
			echo "<div class='col-2 text-right'>";
				echo "<B>PRECIO</B>";
			echo "</div>";
			echo "<div class='col-2 text-right'>";
				echo "<B>TOTAL</B>";
			echo "</div>";
		echo "</div>";
		echo "<hr>";
		if($idventa>0){
			foreach($pedido as $key){
				$sql="SELECT * from productos where idproducto=:id";
				$sth = $db->dbh->prepare($sql);
				$sth->bindValue(":id",$key->idproducto);
				$sth->execute();
				$res=$sth->fetch(PDO::FETCH_OBJ);

				echo "<div class='row' id='div_".$key->idbodega."'>";
					echo "<div class='col-1'>";
							echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_ventas/editar' dix='trabajo' db='a_ventas/db_' fun='borrar_venta' v_idventa='$idventa' v_id='".$key->idbodega."' tp='¿Desea eliminar el producto?' title='Borrar'><i class='far fa-trash-alt'></i></button>";
					echo "</div>";

					echo "<div class='col-3'>";
						echo $key->nombre;
					echo "</div>";

					echo "<div class='col-2 text-center'>";
						echo number_format($key->v_cantidad);
					echo "</div>";

					echo "<div class='col-2 text-right'>";
						echo number_format($key->v_precio,2);
					echo "</div>";

					echo "<div class='col-2 text-right'>";
						echo number_format($key->v_total,2);
					echo "</div>";
				echo "</div>";
				echo "<hr>";
			}
		}
?>
