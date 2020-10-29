<?php
  require_once("db_.php");


  if(isset($_REQUEST['idventa'])){
    $idventa=$_REQUEST['idventa'];
    $n_cliente="";
  }
  else{
    $idventa=0;
    $sql="select * from clientes where idtienda='".$_SESSION['idtienda']."' limit 1";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $cliente=$sth->fetch(PDO::FETCH_OBJ);
    $n_cliente=$cliente->nombre;
  }
?>

<input type="text" name="idventa" id="idventa" value="<?php echo $idventa; ?>" readonly>
<input type="text" name="idcliente" id="idcliente" value="<?php echo $cliente->idcliente; ?>" readonly>
<div class="container-fluid">
	<div class='card'>
    <div class='card-header'>Venta #<?php echo $idventa; ?></div>
    <div class='card-body'>
      <div class='row'>
        <div class='col-7'>
          <div class='row' id='cliente'>
            <div class='col-12'>
              <?php
                include 'dato_cliente.php';
              ?>
            </div>
          </div>
          <div class='row' >
            <div class='col-12' id='lista'>

            </div>
          </div>
        </div>
        <div class='col-5'>
          <?php
            include 'producto_buscar.php';
          ?>
          <hr>
          <?php
            include 'dato_compra.php';
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    let idventa=document.getElementById("idventa").value;
    lista(idventa);
  });
</script>
