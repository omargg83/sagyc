<?php
  require_once("db_.php");
  $pd=$db->productos_vendidos();

  ?>
<div class='container'>
	<div class='tabla_v' id='tabla_css'>
    <div class='title-row'>
      <div>
        VENTAS Y PRODUCTOS POR VENDEDOR
      </div>
    </div>
    <div class='header-row'>
      <div class='cell'>Ticket #</div>
      <div class='cell'>Fecha</div>
      <div class='cell'>Producto</div>
      <div class='cell'>Cantidad</div>
      <div class='cell'>Precio U.</div>
      <div class='cell'>Total</div>
      <div class='cell'>Estado</div>
      <div class='cell'>Vendedor</div>
    </div>

      <?php
      $monto_t=0;
        foreach($pd as $key){
          echo "<div class='body-row'>";

            echo "<div class='cell text-center data-titulo='Numero''>";
              echo $key->numero;
            echo "</div>";

            echo "<div class='cell' data-titulo='Fecha'>".$key->fecha."</div>";


            echo "<div class='cell text-center'>";
              echo $key->nombre;
            echo "</div>";

            echo "<div class='cell text-center'>";
              echo $key->v_cantidad;
            echo "</div>";

            echo "<div class='cell text-right' >".moneda($key->v_precio)."</div>";
            echo "<div class='cell text-right' >".moneda($key->v_cantidad*$key->v_precio)."</div>";
            $monto_t+=($key->v_cantidad*$key->v_precio);
            echo "<div class='cell text-center'>";
              echo $key->estado;
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
