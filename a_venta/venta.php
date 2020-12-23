<?php
  require_once("db_.php");
  $estado="nuevo";
  echo "<div id='trabajo'>";
  if(isset($_REQUEST['idventa'])){
    $idventa=$_REQUEST['idventa'];
    $estado="editar";

    $sql="select * from venta where idventa='$idventa'";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $venta=$sth->fetch(PDO::FETCH_OBJ);
    $numero_compra=$venta->numero;
    $estado_compra=$venta->estado;
    $comanda=$venta->comanda;

    $fecha1 = date ( "Y-m-d" , strtotime($venta->fecha) );
    $fecha_compra=$fecha1;

    $idcliente=$venta->idcliente;
    $sql="select * from clientes where idtienda='".$_SESSION['idtienda']."' and idcliente='$idcliente'";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $cliente=$sth->fetch(PDO::FETCH_OBJ);
    $idcliente=$cliente->idcliente;
    $n_cliente=$cliente->nombre;

    $sql="select tipoticket from sucursal where idsucursal='".$_SESSION['idsucursal']."'";
    $sth = $db->dbh->prepare($sql);
    $sth->execute();
    $sucu=$sth->fetch(PDO::FETCH_OBJ);
    $tamanoticket=$sucu->tipoticket;
  }
  else{
    $idventa=0;
    $idcliente=0;
    $numero_compra=0;
    $total=0;
    $comanda="";
    $fecha_compra=date ( "Y-m-d" );
    $estado_compra="Activa";

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
      <div class='card-header'>
        <div class='row'>
          <div class='col-sm-12 col-md-12 col-lg-12 col-xl-8'>
            
            Venta :   <span id='div_numero'><?php echo $numero_compra; ?></span>
            <span id='div_comanda'>
              <?php echo "--(".$comanda.")"; ?>
            </span>
            <span id='div_estado'>
              <?php echo " * ".$estado_compra." * "; ?>
            </span>


          </div>

          <div class='col-sm-12 col-md-12 col-lg-12 col-xl-4'>
            <?php
              if($estado_compra=="Activa"){
                if($_SESSION['a_sistema']==1){
                  if($db->nivel_captura==1){
                    echo "<button type='button' class='btn btn-warning btn-sm' id='finalizar' is='is-finalizar'><i class='fas fa-cash-register'></i>Finalizar</button>";
                  }
                }
              }
              else{
                if($_SESSION['a_sistema']==1){
                  echo "<button type='button' class='btn btn-warning btn-sm mr-2' id='nueva' is='b-link' des='a_venta/venta' dix='trabajo'><i class='fas fa-cash-register'></i>Nueva</button>";

                  if ($tamanoticket==0) {
                    echo "<button type='button' class='btn btn-warning btn-sm mr-2'  id='print_persona' is='b-print' title='Editar' des='a_venta/imprimir' dix='trabajo' v_idventa='$idventa'><i class='fas fa-print'></i>Imprimir</button>";
                  }
                  else {
                    echo "<button type='button' class='btn btn-warning btn-sm mr-2'  id='print_persona' is='b-print' title='Editar' des='a_venta/imprimir88mm' dix='trabajo' v_idventa='$idventa'><i class='fas fa-print'></i>Imprimir</button>";
                  }
                  if($estado_compra=="Pagada"){
                    echo "<button type='button' class='btn btn-warning btn-sm' is='b-link' db='a_venta/db_' des='a_venta/venta' desid='idventa' fun='editar_venta' dix='trabajo' id='eliminar' v_idventa='$idventa' tp='¿Desea editar la venta seleccionada?'><i class='fas fa-user-edit'></i>Editar</button>";
                  }
                  if($estado_compra=="Editar"){
                    echo "<button type='button' class='btn btn-success btn-sm mr-2' id='finedit' is='is-finedit'><i class='fas fa-cash-register'></i>Finalizar</button>";
                  }
                }
              }
              ?>
          </div>

        </div>
      </div>
      <div class='card-body'>
        <div class='row'>
          <div class='col-sm-12 col-md-12 col-lg-8 col-xl-6'>
            <div class='row' id='buscar_form'>
              <?php
                include 'buscar_form.php';
              ?>
            </div>
            <div clas='row' id='resultadosx' style='min-height:400px; max-height: 600px; overflow:auto;'>
              <?php
                include 'lista_categoria.php';
              ?>
            </div>
          </div>

          <div class='col-sm-12 col-md-12 col-lg-4 col-xl-6'>
            <div class='row mb-3' id='dato_compra'>
              <?php
                include 'dato_compra.php';
              ?>
            </div>

            <div class='row mb-3' id='cliente_datos'>
              <?php
                include 'cliente_datos.php';
              ?>
            </div>

            <div class='row' >
              <div class='col-12' id='lista' style='min-height:300px; overflow:auto;'>
                <?php
                  include 'lista_pedido.php';
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
