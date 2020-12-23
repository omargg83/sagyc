<?php
  require_once("db_.php");
  $pd=$db->corte_caja_usuario();
  ?>
<div class='container'>
	<div class='tabla_v' id='tabla_css'>
    <div class='title-row'>
      <div class='cell'>
        CORTE DE CAJA POR USUARIO
      </div>
    </div>
    <div class='header-row'>
    <!--  <div class='col-1'>-</div> -->
      <div class='cell'>Fecha</div>
      <div class='cell'>Total</div>
      <div class='cell'>Tipo de Pago</div>
      <div class='cell'>Vendedor</div>
    </div>

      <?php
        $monto_t=0;
        foreach($pd as $key){
          echo "<div class='body-row'>";
          
            echo "<div class='cell text-center'>".$key->fecha."</div>";

            echo "<div class='cell text-center'>";
              echo moneda($key->total);
                   $monto_t+=$key->total;
            echo "</div>";

            echo "<div class='cell text-center'>";
              echo $key->tipo_pago;
            echo "</div>";

            echo "<div class='cell text-center'>";
              echo $key->vendedor;
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
</div>
