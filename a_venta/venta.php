<?php
  require_once("db_.php");
  $estado="nuevo";

  if(isset($_REQUEST['idventa'])){
    $idventa=$_REQUEST['idventa'];
    $estado="editar";

    $sql="select * from venta where idventa='$idventa'";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $venta=$sth->fetch(PDO::FETCH_OBJ);
    $idcliente=$venta->idcliente;

    $sql="select * from clientes where idtienda='".$_SESSION['idtienda']."' and idcliente='$idcliente'";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $cliente=$sth->fetch(PDO::FETCH_OBJ);
    $idcliente=$cliente->idcliente;
    $n_cliente=$cliente->nombre;
  }
  else{
    $idventa=0;
    $idcliente=0;

    $sql="select * from clientes where idtienda='".$_SESSION['idtienda']."' limit 1";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $cliente=$sth->fetch(PDO::FETCH_OBJ);
    $idcliente=$cliente->idcliente;
    $n_cliente=$cliente->nombre;
  }
?>

<input type="hidden" name="idventa" id="idventa" value="<?php echo $idventa; ?>" readonly>

<div class="container-fluid">
	<div class='card'>
    <div class='card-header'>Venta #<?php echo $idventa; ?></div>
    <div class='card-body'>
      <div class='row'>
        <div class='col-7'>
          <div class='row' >
            <div class='col-12' id='cliente_datos'>
              <?php
                include 'cliente_datos.php';
              ?>
            </div>
          </div>
          <hr>
          <div class='row' >
            <div class='col-12' id='lista'>
              <?php
                include 'lista_pedido.php';
              ?>
            </div>

          </div>
        </div>
        <div class='col-5'>
          <?php
            include 'producto_buscar.php';
          ?>
          <hr>
          <div id='dato_compra'>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    let idventa=document.getElementById("idventa").value;
    datos_compra(idventa);
  });
</script>
