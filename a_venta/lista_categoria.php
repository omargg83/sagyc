<?php
	require_once("db_.php");
  $categoria=$db->categoria_lista();
	
	  echo "<div class='sagyc_productos'>";
		foreach($categoria as $key){
			
			echo "<button class='sagyc_item' type='button' id='categorias' is='p-categoria' title='Editar' v_idcategoria='$key->idcategoria'";
			if(strlen($key->archivo)>0 and file_exists("../".$db->f_categoria."/".$key->archivo)){
				echo "style='background-image: url(\"".$db->f_categoria."/".$key->archivo."\")'";
			}
			else{
				echo "style='background-image: url(\"img/unnamed.png'\") ";
			}
			echo ">";
			echo "<span>";
			echo $key->nombre;
			echo "</span>";
			echo "</button>";
			
		}
	  echo "</div>";
  
?>
