<?php
  require_once("db_.php");

 ?>

 <nav class='navbar navbar-expand-lg navbar-sagyc navbar-light  '>
   <div class='container-fluid'>
 		  <a class='navbar-brand' ><i class='fas fa-boxes'></i>Inventario</a>
      <button class='navbar-toggler navbar-toggler-right' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
  			<span class='navbar-toggler-icon'></span>
  		</button>
 		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <form class='form-inline my-2 my-lg-0' is="b-submit" id="form_busca" des="a_inventario/lista" dix='trabajo' >
          <div class="input-group  mr-sm-2">
            <div id="search-wrapper">
  						<input type="search" id="buscar" name='buscar' placeholder="Buscar" />
  						<i class="fa fa-search"></i>
  					</div>
          </div>
        </form>
   			<ul class='navbar-nav mr-auto'>
          <li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='lista_inventario' des='a_inventario/lista' dix='trabajo'><i class='fas fa-box-open'></i><span>Productos</span></a></li>
          <li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='lista_servicios' des='a_inventario/lista_servicios' dix='trabajo'><i class='fab fa-servicestack'></i><span>Servicios</span></a></li>
          <?php
          	if(array_key_exists('PRODUCTOS', $db->derecho)){
              if($_SESSION['a_sistema']==1){

              }

              echo "<li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='cate_nue' des='a_categorias/lista' dix='trabajo'><i class='fas fa-box'></i><span>Categorias</span></a></li>";
            }

            if($_SESSION['nivel']==66){
              echo "<li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='cate_nue' des='a_inventario/duplicados'  dix='trabajo'><i class='fas fa-box'></i><span>Duplicados</span></a></li>";
            }
          ?>

          <li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='lista_servicios' des='a_inventario/excel' dix='trabajo'><i class="far fa-file-excel"></i><span>Excel</span></a></li>
          <li class='nav-item active'><a class='nav-link barranav' is='f-print' title='Editar' id='print_persona' des='a_inventario/invent' dix='resultadox'><i class='fas fa-print'></i><span>Imprimir</span></a></li>
          <li class='nav-item active'><a class='nav-link barranav izq' is='a-link' title='Nuevo' id='new_poliza' des='a_inventario/agregar' v_id='0' dix='trabajo'><i class='fas fa-cloud-download-alt'></i><span>Agregar producto</span></a></li>
   			</ul>
	   </div>
 	  </div>
 	</nav>

  <div id='trabajo'>
  	<?php
  		include 'lista.php';
  	?>
  </div>
