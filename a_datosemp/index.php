<?php
	require_once("db_.php");
?>
	<nav class='navbar navbar-expand-lg navbar-light bg-light '>
	<a class='navbar-brand' ><i class='far fa-building'></i>Datos Empresa</a>
	  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav mr-auto'>

				<li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='empresa' des='a_datosemp/lista' dix='trabajo'><i class='far fa-building'></i><span>Empresa</span></a></li>

				<li class='nav-item active'><a class='nav-link barranav' is='a-link' title='Mostrar todo' id='sucursal' des='a_sucursal/lista' dix='trabajo'><i class='fas fa-store'></i><span>Sucursales</span></a></li>

			</ul>
	  </div>
	</nav>
<div id='trabajo'>
	<?php
		include 'lista.php';
	?>
</div>
