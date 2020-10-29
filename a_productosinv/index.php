<?php
  require_once("db_.php");
  $_SESSION['nivel_captura']=1;
 ?>

 <nav class='navbar navbar-expand-sm navbar-light bg-light'>
 		  <a class='navbar-brand' ><i class="fab fa-product-hunt"></i>Productos</a>
 		  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
 			<span class='navbar-toggler-icon'></span>
 		  </button>
 		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
 			<ul class='navbar-nav mr-auto'>

        <form class='form-inline my-2 my-lg-0' is="b-submit" id="form_busca" des="a_productosinv/lista" dix='trabajo' >
          <div class="input-group  mr-sm-2">
            <input type="text" class="form-control form-control-sm" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon2"  name='buscar' id='buscar'>
            <div class="input-group-append">
              <button class="btn btn-warning btn-sm" type="submit" ><i class='fas fa-search'></i></button>
            </div>
          </div>
        </form>


        <li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='lista_prod' des='a_productosinv/lista' dix='trabajo'><i class='fas fa-list-ul'></i><span>Lista</span></a></li>
  			<li class='nav-item active'><a class='nav-link barranav izq' is='a-link' title='Nuevo' id='new_poliza' des='a_productosinv/editar' v_id='0' dix='trabajo'><i class='fas fa-plus'></i><span>Nuevo</span></a></li>


      </li>

 			</ul>
 		</div>
 	  </div>
 	</nav>

  <div id='trabajo'>
  	<?php
  		include 'lista.php';
  	?>
  </div>