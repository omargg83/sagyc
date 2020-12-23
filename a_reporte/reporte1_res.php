<?php
  require_once("db_.php");
  $pd=$db->emitidas();
?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		  <div class='title-row'>
          <div>
            VENTAS EMITIDAS
          </div>
      </div>
        <div class='header-row'>
            <div class='cell'>Ticket #</div>
            <div class='cell'>Fecha</div>
            <div class='cell'>Cliente</div>
            <div class='cell'>Tienda</div>
            <div class='cell'>Total</div>
            <div class='cell'>Estado</div>
       </div>

       <?php
      $monto_t=0;
      foreach($pd as $key){
        echo "<div class='body-row'>";

          echo "<div class='cell text-center' data-titulo='Numero'>";
            echo $key->numero;
          echo "</div>";

          echo "<div class='cell' data-titulo='Fecha'>".fecha($key->fecha,2)."</div>";


          echo "<div class='cell'>";
            echo $key->nombrecli;
          echo "</div>";

          echo "<div class='cell text-center'>";
            echo $key->nombre;
          echo "</div>";

          echo "<div class='cell text-right' >".moneda($key->total)."</div>";
          $monto_t+=$key->total;
          echo "<div class='cell'>";
            echo $key->estado;
          echo "</div>";

        echo '</div>';
      }

      echo "<div class='body-row'>";
          echo "<tr>";
          echo "<td>Total  </td>";
          echo "<div class='cell text-right' ><b>".moneda($monto_t)."</b></div>";
          echo"</tr>";
      echo'</div>';
      ?>
    
  </div>
</div>