<?php
	require_once("db_.php");
?>
<nav class='navbar navbar-expand-lg navbar-sagyc navbar-light  '>
	<div class='container-fluid'>
	<a class='navbar-brand' ><i class='fas fa-user-check'></i>Usuarios</a>
	<button class='navbar-toggler navbar-toggler-right' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	</button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
				<form class='form-inline my-2 my-lg-0' is="b-submit" id="form_busca" des="a_usuarios/lista" dix='trabajo' >
					<div class="input-group mr-sm-2">
						<div id="search-wrapper">
							<input type="search" id="buscar" name='buscar' placeholder="Buscar" />
							<i class="fa fa-search"></i>
						</div>
					</div>
				</form>
			<ul class='navbar-nav mr-auto'>



				<?php
				if($db->nivel_captura==1){
					echo "<li class='nav-item active'>";
					echo "<a class='nav-link barranav izq' title='Nuevo' is='a-link' id='new_personal' des='a_usuarios/editar' dix='trabajo' v_id='0'><i class='fas fa-plus'></i><span>Nuevo</span></a>";
					echo "</li>";
				}
				?>

				<li class='nav-item active'>
					<a class='nav-link barranav' title='Mostrar todo' is='a-link' id='lista_comision' des='a_usuarios/lista' dix='trabajo'><i class='fas fa-list-ul'></i><span>Lista</span></a>
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
