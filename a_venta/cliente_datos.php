<?php
	require_once("db_.php");

  if(isset($_REQUEST['idcliente'])){
    $idcliente=$_REQUEST['idcliente'];
    $sql="select * from clientes where idtienda=".$_SESSION['idtienda']." and idcliente=$idcliente ";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $cliente=$sth->fetch(PDO::FETCH_OBJ);
    $n_cliente=$cliente->nombre;
    $idcliente=$cliente->idcliente;
  }
	if(isset($_REQUEST['idventa'])){
		$idventa=$_REQUEST['idventa'];
		$pd = $db->venta($idventa);
		$estado_compra=$pd->estado;
	}
?>

<input type="hidden" name="idcliente" id="idcliente" value="<?php echo $idcliente; ?>" readonly>
	<div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
		<small>Cliente</small>
		<div class="input-group">
		  <div class="input-group-prepend">
				<?php
					if($estado_compra=="Activa"){
						if($_SESSION['a_sistema']==1){
							echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_venta/cliente_busca' dix='trabajo' omodal='1'><i class='fas fa-user-tag'></i></button>";
						}
					}
				?>
		  </div>
			<input type="text" class="form-control form-control-sm" name="n_cliente" id='n_cliente' placeholder='Cliente' aria-label="buscar producto" aria-describedby="basic-addon2" value="<?php echo $n_cliente; ?>" readonly>
		</div>
	</div>
