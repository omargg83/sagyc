  <div class="col-sm-12">
    <form is="p-busca" id="form_busca" >
      <div clas='row'>
          <div class="input-group mb-3">
          <input type="text" class="form-control form-control-sm" name="prod_venta" id='prod_venta' placeholder='buscar producto' aria-label="buscar producto" aria-describedby="basic-addon2">
          <?php
            if($estado_compra=="Activa"){
              echo "<div class='input-group-append'>";
                echo "<button class='btn btn-warning btn-sm' type='submit' ><i class='fas fa-search'></i>Buscar</button>";
                echo "<button class='btn btn-warning btn-sm' type='button' is='b-link' des='a_venta/lista_categoria' dix='resultadosx'><i class='fas fa-layer-group'></i>Categorias</button>";
              echo "</div>";
            }
          ?>
        </div>
      </div>
    </form>
  </div>
