<?php
	require_once("db_.php");
	if(!isset($_SESSION['idusuario']) or strlen($_SESSION['idusuario'])==0 or $_SESSION['autoriza']==0){
		header("location: login/");
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="img/favicon.ico">
    <title>SAGYC POS</title>

    <link rel="icon" type="image/png" href="img/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">


    <link rel="stylesheet" href="demo.css" />
    <link rel="stylesheet" href="lib/load/css-loader.css">
    <!-- <link rel="stylesheet" type="text/css" href="lib/modulos.css"/>-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="chat/chat.css" />
    <link href="lib/animate.min.css" rel="stylesheet"/>


  </head>
  <?php
    $valor=$_SESSION['idfondo'];
    echo "<body style='background-image: url(\"$valor\")'>";
  ?>
  <div class="loader loader-double is-active" id='cargando_div'>
    <h2><span style='font-color:white'></span></h2>
  </div>

	<div class="modal" tabindex="-1" role="dialog" id="myModal" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-xl" role="document" id='modal_dispo'>
			<div class="modal-content" id='modal_form'>

			</div>
		</div>
	</div>


  <div class="grid-container">
   <div class="menu-icon">
    <i class="fas fa-bars header__menu"></i>
  </div>


  <header class="header">
    <img src='img/sagyc.png' width='60' height='30' alt=''>
    <div class="header__search"><b><?php echo trim($_SESSION['n_sistema']); ?></b></div>
    <div class='header-btn'>
      
      <ul class='menu'>
        <?php
            echo "<li class='dropdown'>";
              echo "<a class='dropbtn option'><i class='fas fa-desktop text-secondary'></i></a>";
              echo "<div class='dropdown-content' id='fondo'>";
              echo "</div>";
            echo "</li>";

            echo "<li class='dropdown'>";
              echo  "<a class='dropbtn option'><i class='fab fa-rocketchat fa-spin'></i></a>";
              echo "<div class='dropdown-content' id='chatx'>";
              echo "</div>";
            echo "</li>";
        
            if($_SESSION['a_sistema']==1){
              echo "<li>";
                echo "<a href='#' class='option' title='Precios' is='b-link' des='a_precios/index' omodal='1'><i class='fas fa-search-dollar'></i></a>";
              echo "</li>";
            }
        ?>
        <li><a href="#" onclick='salir()' class='option' title='Salir'><i class='fas fa-sign-out-alt text-red'></i></a></li>
      </ul>
    </div>
  </header>

  <aside class="sidenav">
    <div class="sidenav__close-icon">
      <i class="fas fa-times sidenav__brand-close"></i>
    </div>

    <?php
		  echo "<div class='sidebar-sucursal' ><b>".$_SESSION['sucursal_nombre']."</b></div>";
    ?>
    <div class="sidebar-header">
      <div class="user-pic">
        <?php
          if(strlen($_SESSION['foto'])>0 and file_exists($db->f_usuarios."/".$_SESSION['foto'])){
            echo "<img class='img-responsive rounded-circle' src='".$db->f_usuarios.$_SESSION['foto']."' alt='User picture'>";
          }
          else{
            echo "<img class='img-responsive rounded-circle' src='img/user.jpg' alt='User picture'>";
          }
        ?>
      </div>
      <div class="user-info">
        <span class="user-name"><?php echo $_SESSION['nombre']; ?>
        </span>
        <!--<span class="user-role">Administrator</span> -->
        <span class="user-status">
          <i class="fa fa-circle"></i>
          <span>Online</span>
        </span>
      </div>
    </div>

     <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>

          <li>
            <a href='#dash/index' is='menu-link'>
              <i class='fas fa-home'></i>
              <span>Inicio</span>
            </a>
          </li>

           <?php

              if((array_key_exists('VENTA', $db->derecho) and $_SESSION['a_sistema']==1) or $_SESSION['nivel']==66)
              echo "<li><a href='#a_venta/venta' id='ventax' is='menu-link' title='Pedidos'><i class='fas fa-cash-register'></i><span>+ Venta</span></a></li>";

              if(array_key_exists('VENTAREGISTRO', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_ventas/index' id='ventas' is='menu-link' title='Pedidos'><i class='fas fa-shopping-basket'></i><span>Ventas</span></a></li>";

              if(array_key_exists('COMPRAS', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_compras/index' is='menu-link' title='Compras'><i class='fas fa-shopping-bag'></i><span>Compras</span></a></li>";

              if((array_key_exists('PRODUCTOS', $db->derecho) and $_SESSION['matriz']==1) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_productos/index' is='menu-link' title='Productos'><i class='fab fa-product-hunt'></i><span>Catalogo</span></a></li>";

              if(array_key_exists('INVENTARIO', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_inventario/index' is='menu-link' title='inventario'><i class='fas fa-boxes'></i><span>Inventario</span></a></li>";

              if(array_key_exists('CLIENTES', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_cliente/index' is='menu-link' title='Clientes'><i class='fas fa-user-tag'></i><span>Clientes</span></a></li>";

              if(array_key_exists('CITAS', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_citas/index' is='menu-link' title='Citas'><i class='far fa-calendar-check'></i><span>Citas/Agenda</span></a></li>";

              if(array_key_exists('PROVEEDORES', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_proveedores/index' is='menu-link' title='Proveedores'><i class='fas fa-people-carry'></i><span>Proveedores</span></a></li>";

              if(array_key_exists('TRASPASOS', $db->derecho) or $_SESSION['nivel']==66)
              echo "<li class=''><a href='#a_traspasos/index' is='menu-link' title='Traspasos'><i class='fas fa-arrows-alt-h'></i><span>Traspasos</span></a></li>";

              if(array_key_exists('GASTOS', $db->derecho) or $_SESSION['nivel']==66)
                  echo "<li class=''><a href='#a_gastos/index' is='menu-link' title='Datosemp'><i class='fas fa-donate'></i><span>Gastos</span></a></li>";

	            echo "<li class='header-menu'>";
	              echo "<span>Empresa</span>";
	            echo "</li>";
	            echo "<li class='sidebar-dropdown'>";
		            echo "<a href='#'>";
		              echo "<i class='fas fa-hand-holding-usd'></i>";
		              echo "<span>Reportes</span>";
		            echo "</a>";
		            echo "<div class='sidebar-submenu'>";
		              echo "<ul>";
										if(array_key_exists('REPORTES', $db->derecho) and $_SESSION['a_sistema']==1)
										echo "<li class=''><a href='#a_reporte/index' is='menu-link' title='Reportes'><i class='far fa-chart-bar'></i><span>Reportes</span></a></li>";

										if(array_key_exists('SUPERVISOR', $db->derecho) or $_SESSION['nivel']==66)
										echo "<li class=''><a href='#a_supervisor/index' is='menu-link' title='Supervisor'><i class='far fa-eye'></i><span>Supervisor</span></a></li>";
		              echo "</ul>";
	            	echo "</div>";
	          	echo "</li>";
							echo "<li class='sidebar-dropdown'>";
		            echo "<a href='#'>";
		              echo "<i class='fas fa-tools'></i>";
		              echo "<span>Configuración</span>";
		            echo "</a>";
		            echo "<div class='sidebar-submenu'>";
		              echo "<ul>";
											if(array_key_exists('DATOSEMP', $db->derecho) or $_SESSION['nivel']==66)
											echo "<li class=''><a href='#a_datosemp/index' is='menu-link' title='Datos de la empresa'><i class='fas fa-wrench'></i><span>Datos Emp.</span></a></li>";

											if(array_key_exists('USUARIOS', $db->derecho) or $_SESSION['nivel']==66)
				              echo "<li class=''><a href='#a_usuarios/index' is='menu-link' title='Usuarios'><i class='fas fa-users'></i><span>Usuarios</span></a></li>";
		              echo "</ul>";
	            	echo "</div>";
	          	echo "</li>";
					?>
          </ul>
      </div>

  </aside>

  <main class="main" id='contenido'>
    <div class="main-header">
      <div class="main-header__heading">Hello User</div>
      <div class="main-header__updates">Recent Items</div>
    </div>

    <div class="main-overview">
      <div class="overviewcard">
        <div class="overviewcard__icon">Overview</div>
        <div class="overviewcard__info">Card</div>
      </div>
      <div class="overviewcard">
        <div class="overviewcard__icon">Overview</div>
        <div class="overviewcard__info">Card</div>
      </div>
      <div class="overviewcard">
        <div class="overviewcard__icon">Overview</div>
        <div class="overviewcard__info">Card</div>
      </div>
      <div class="overviewcard">
        <div class="overviewcard__icon">Overview</div>
        <div class="overviewcard__info">Card</div>
      </div>
    </div>

    <div class="main-cards">
      <div class="card">Card</div>
      <div class="card">Card</div>
      <div class="card">Card</div>
    </div>
  </main>

  <footer class="footer">
    <div class="footer__copyright">&copy; 2020 SAGYC</div>
    <div class="footer__signature">www.sagyc.com.mx</div>
  </footer>
</div>

 <!--   Core JS Files   -->
    <script src="lib/jquery-3.5.1.js" type="text/javascript"></script>

    <!--   url   -->
    <script src="lib/jquery/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/jquery/jquery-ui.min.css" />

    <!--   Boostrap   -->
    <link rel="stylesheet" href="lib/boostrap/css/bootstrap.css">
    <script src="lib/boostrap/js/bootstrap.js"></script>
    
    <!--   Alertas   -->
    <script src="lib/swal/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/swal/dist/sweetalert2.min.css">

    <!--   para imprimir   -->
    <script src="lib/VentanaCentrada.js" type="text/javascript"></script>

    <!--   Cuadros de confirmación y dialogo   -->
    <link rel="stylesheet" href="lib/jqueryconfirm/css/jquery-confirm.css">
    <script src="lib/jqueryconfirm/js/jquery-confirm.js"></script>

    <!--   iconos   -->
    <link rel="stylesheet" href="lib/fontawesome-free-5.12.1-web/css/all.css">

    <script src="lib/popper.min.js"></script>
    <script src="lib/tooltip.js"></script>

    <!--   Propios   -->
    <script src="chat/chat.js"></script>
    <script src="sagyc.js"></script>
    <script src="vainilla.js"></script>

    <!--- calendario -->
    <link href='lib/fullcalendar-4.0.1/packages/core/main.css' rel='stylesheet' />
    <link href='lib/fullcalendar-4.0.1/packages/daygrid/main.css' rel='stylesheet' />
    <link href='lib/fullcalendar-4.0.1/packages/timegrid/main.css' rel='stylesheet' />

    <script src='lib/fullcalendar-4.0.1/packages/core/main.js'></script>
    <script src='lib/fullcalendar-4.0.1/packages/interaction/main.js'></script>
    <script src='lib/fullcalendar-4.0.1/packages/daygrid/main.js'></script>
    <script src='lib/fullcalendar-4.0.1/packages/timegrid/main.js'></script>
    <script src='lib/fullcalendar-4.0.1/packages/core/locales/es.js'></script>

  </body>
</html>
