<?php
	require_once("db_.php");
  $texto=$_REQUEST['prod_venta'];
  $idcompra=$_REQUEST['idcompra'];

  $sql="SELECT * from productos where idtienda=:tienda and tipo=3 and
  (nombre like :texto or
    descripcion like :texto or
    codigo like :texto  or
    rapido like :texto or
    marca like :texto or
    modelo like :texto
  ) order by tipo limit 20";
  $sth = $db->dbh->prepare($sql);
  $sth->bindValue(":texto","%$texto%");
  $sth->bindValue(":tienda",$_SESSION['idtienda']);
  $sth->execute();
  $res=$sth->fetchAll(PDO::FETCH_OBJ);

  echo "<div class='row'>";
  echo "<table class='table table-sm' style='font-size:14px'>";
  echo  "<tr>";
  echo  "<th>-</th>";
  echo  "<th>Código</th>";
  echo  "<th>Nombre</th>";
  echo  "<th>Marca</th>";
  echo  "<th>Modelo</th>";
  echo  "<th>Precio</th>";
  echo "</tr>";
  if(count($res)>0){
    foreach ($res as $key) {
      echo  "<tr>";
      echo  "<td>";
      echo  "<div class='btn-group'>";
      if($key->tipo==3){
        echo "<button type='button' is='b-link' id='sel_producto_$key->idproducto' des='a_compras/selecciona_producto' dix='productos' v_idproducto='$key->idproducto' v_idcompra='$idcompra' class='btn btn-warning btn-sm' title='Seleccionar cliente'><i class='fas fa-plus'></i></button>";
      }
      echo  "</div>";
      echo  "</td>";

      echo  "<td>";
        echo  "<span style='font-size:12px'>";
        echo  "<B>BARRAS: </B>".$key->codigo."  ";
        echo  "<br><B>RAPIDO: </B>".$key->rapido;
        echo  "</span>";
      echo  "</td>";

      echo  "<td>";
      echo  $key->nombre;
      echo  "</td>";

      echo  "<td>";
      echo  $key->marca;
      echo  "</td>";

      echo  "<td>";
      echo  $key->modelo;
      echo  "</td>";

      echo  "<td align='right'>";
        echo 	moneda($key->precio);
      echo  "</td>";

      echo  "</tr>";
    }
  }
?>
