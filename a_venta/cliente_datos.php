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
?>

<input type="hidden" name="idcliente" id="idcliente" value="<?php echo $idcliente; ?>" readonly>
<div clas='row'>
  <div class="input-group mb-3">
    <input type="text" class="form-control form-control-sm" name="n_cliente" id='n_cliente' placeholder='Cliente' aria-label="buscar producto" aria-describedby="basic-addon2" value="<?php echo $n_cliente; ?>" readonly>
    <div class="input-group-append">
			<button class="btn btn-warning btn-sm" type="button" is="b-link" des="a_venta/cliente_busca" dix="trabajo" omodal='1'>Seleccionar</button>
    </div>
  </div>
</div>