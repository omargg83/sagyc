<?php
	require_once("db_.php");

	if(isset($_REQUEST['idtraspaso'])){
    $idtraspaso=$_REQUEST['idtraspaso'];
		$sql="select * from traspasos where idtraspaso='$idtraspaso'";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $traspaso=$sth->fetch(PDO::FETCH_OBJ);
    $estado_compra=$traspaso->estado;
		$idsucursal=$traspaso->idsucursal;
  }
  else{
    $idtraspaso=0;
  }

	$pedido = $db->traspaso_pedido($idtraspaso);
	echo "<div class='tabla_css col-xl col-auto' id='tabla_css'>";
		echo "<div class='row header-row'>";
			echo "<div class='col-xl col-auto'>-</div>";
			echo "<div class='col-xl col-auto'>Código</div>";
			echo "<div class='col-xl col-auto'>Descripcion</div>";
			echo "<div class='col-xl col-auto'>Cantidad</div>";
		echo "</div>";

	if($idtraspaso>0){
		$total=0;
		foreach($pedido as $key){
			echo "<div class='row body-row' draggable='true'>";

				echo "<div class='col-xl col-auto'>";
					echo "<div class='btn-group mr-3'>";
						if($estado_compra=="Activa"){
							echo "<button class='btn btn-warning btn-sm' id='del_$key->idbodega' type='button' is='t-borraprod' v_idbodega='$key->idbodega' v_idproducto='$key->idproducto' title='Borrar'><i class='far fa-trash-alt'></i></button>";
						}
						if($idsucursal==$_SESSION['idsucursal'] and $key->trasp_recepcion!=1){
							echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_traspasos/db_' des='a_traspasos/editar' desid='$idtraspaso' fun='recibir_traspaso' dix='trabajo' v_idtraspaso='$idtraspaso' v_idbodega='$key->idbodega' id='finaliza' tp='¿Desea recibir el producto seleccionado?'><i class='fas fa-cloud-download-alt'></i>Recibir</button>";
						}
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl col-auto'>";
					echo $key->codigo;
				echo "</div>";

				echo "<div class='col-xl col-auto'>";
					echo $key->nombre;
				echo "</div>";

				echo "<div class='col-xl col-auto text-center'>";
					echo number_format($key->v_cantidad);
				echo "</div>";

			echo "</div>";
		}

	}
	echo "</div>";
?>
