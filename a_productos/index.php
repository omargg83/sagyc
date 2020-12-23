<?php
  require_once("db_.php");
 ?>

 <nav class='navbar navbar-expand-lg navbar-sagyc navbar-light  '>
   <div class='container-fluid'>
 		  <a class='navbar-brand' ><i class="fab fa-product-hunt"></i>Catalogo</a>
      <button class='navbar-toggler navbar-toggler-right' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
  			<span class='navbar-toggler-icon'></span>
  		</button>
 		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <form class='form-inline my-2 my-lg-0' is="b-submit" id="form_busca" des="a_productos/lista" dix='trabajo' >
          <div class="input-group  mr-sm-2">
            <div id="search-wrapper">
  						<input type="search" id="buscar" name='buscar' placeholder="Buscar" />
  						<i class="fa fa-search"></i>
  					</div>
          </div>
        </form>
   			<ul class='navbar-nav mr-auto'>
          <?php
      			if($_SESSION['a_sistema']==1){
              if($db->nivel_captura==1){
                if($_SESSION['matriz']==1){
      				    echo "<li class='nav-item active'><a class='nav-link barranav izq' is='a-link' title='Nuevo' id='new_poliza' des='a_productos/editar' v_id='0' dix='trabajo'><i class='fas fa-plus'></i><span>Nuevo Producto</span></a></li>";
                }
              }
            }
          ?>
          <li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='lista_prod' des='a_productos/lista' dix='trabajo'><i class='fas fa-list-ul'></i><span>Lista</span></a></li>
          <li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='lista_servicios' des='a_productos/excel' dix='trabajo'><i class='far fa-file-excel'></i><span>Excel</span></a></li>
   			</ul>
 		</div>
 	  </div>
 	</nav>

  <div id='trabajo'>
  	<?php
  		include 'lista.php';
  	?>
  </div>
