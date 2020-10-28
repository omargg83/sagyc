<div class='row'>
  <div class='col-12'>
    <div class="form-group row">
      <div class="col-sm-12">
        <form is="b-submit" id="form_busca" des="a_venta/productos_lista" dix='resultadosx' >
    			<input  type='hidden' id='idventa' NAME='idventa' value='<?php echo $idventa; ?>'>
    			<div clas='row'>
    					<div class="input-group mb-3">
    					<input type="text" class="form-control" name="prod_venta" id='prod_venta' placeholder='buscar producto' aria-label="buscar producto" aria-describedby="basic-addon2">
    					<div class="input-group-append">
    						<button class="btn btn-warning btn-sm" type="submit" ><i class='fas fa-search'></i>Buscar</button>
    					</div>
    				</div>
    			</div>
    		</form>
    		<div clas='row' id='resultadosx' style='height:300px; overflow:auto;'>

    		</div>
      </div>
    </div>
  </div>
</div>
