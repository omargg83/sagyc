<?php
  require_once("db_.php");
  $pd=$db->emitidasxsuc();
  ?>

<div class='container'>
	<div class='tabla_v' id='tabla_css'>
    <div class='title-row'>
      <div class='cell'>
        VENTAS EMITIDAS POR SUCURSAL
      </div>
    </div>
    <div class='header-row'>
    <!--  <div class='col-1'>-</div> -->
      <div class='cell'>Ticket #</div>
      <div class='cell'>Fecha</div>
      <div class='cell'>Cliente</div>
      <div class='cell'>Sucursal</div>
      <div class='cell'>Total</div>
      <div class='cell'>Estado</div>
    </div>

      <?php
        $monto_t=0;
        foreach($pd as $key){
          echo "<div class='body-row'>";

            echo "<div class='cell text-center'>";
              echo $key->numero;
            echo "</div>";

            echo "<div class='cell'>".$key->fecha."</div>";


            echo "<div class='cell text-center'>";
              echo $key->nombrecli;
            echo "</div>";

            echo "<div class='cell text-center'>";
              echo $key->nombre;
            echo "</div>";

            echo "<div class='cell text-right' >".moneda($key->total)."</div>";
            $monto_t+=$key->total;
            echo "<div class='cell text-center'>";
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
</div>
