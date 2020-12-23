<?php
	require_once("db_.php");
	if(isset($_REQUEST['texto'])){
		$texto=$_REQUEST['texto'];
	}
	else{
		$texto="";
	}

  $sql="SELECT * from clientes where nombre like '%$texto%' limit 100";
  $sth = $db->dbh->prepare($sql);
  $sth->execute();

	echo "<div class='tabla_v' id='tabla_css'>";
		echo "<div class='header-row'>";
			echo "<div class='cell'>-</div>";
			echo "<div class='cell'>Nombre</div>";
			echo "<div class='cell'>Correo</div>";
			echo "<div class='cell'>Telefono</div>";
		echo "</div>";

  foreach($sth->fetchAll(PDO::FETCH_OBJ) as $key){
	echo "<div class='body-row' is='b-card' draggable='true'>";
		echo  "<div class='cell'>";
			echo "<div class='btn-group mr-3'>";
	       		echo "<button type='button' is='is-cliente' v_idcliente='$key->idcliente' cmodal='2' class='btn btn-warning btn-sm' title='Seleccionar cliente'><i class='fas fa-plus'></i></button>";
			echo "</div>";
		echo "</div>";

		echo  "<div class='cell' data-titulo='Nombre'>";
        	echo $key->nombre;
      	echo "</div>";
      echo "<div class='cell' data-titulo='Correo'>";
          echo $key->correo;
      echo "</div>";
      echo "<div class='cell' data-titulo='Teléfono'>";
          echo $key->telefono;
      echo "</div>";
    echo "</div>";
  }
  echo "</div>";
?>
