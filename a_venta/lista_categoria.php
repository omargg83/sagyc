<?php
	require_once("db_.php");
  $categoria=$db->categoria_lista();
	echo "<div class='container'>";
	  echo "<div class='row'>";
		foreach($categoria as $key){
			echo "<div class='col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3'>";
	      echo "<button type='button' class='btn btn-light btn-sm mr-1 my-1' style='font-size:10px' id='categorias' is='p-categoria' title='Editar' v_idcategoria='$key->idcategoria'>";
	        if(strlen($key->archivo)>0 and file_exists("../".$db->f_categoria."/".$key->archivo)){
	          echo "<img src='".$db->f_categoria."/".$key->archivo."' width='70px' height='70px' />";
	        }
	        else{
	          echo "<img src='img/unnamed.png' width='70px' height='70px'/>";
	        }
	        echo "<br>";
	        echo $key->nombre;
			  echo "</button>";
			echo "</div>";
		}
	  echo "</div>";
  echo "</div>";
?>
