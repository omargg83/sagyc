<?php
  require_once("db_.php");
	echo "<div class='alert alert-warning'><b>REPORTES</b></div>";
	echo "<div class='main-overview'>";
		

		if(array_key_exists('REPORTE_VENTAS', $db->derecho)){
			echo "<div class='overviewcard'>";
				echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_reporte/reporte1'><i class='far fa-arrow-alt-circle-right'></i></a>";
				echo "<div class='overviewcard__icon'>Reporte de ventas";
				echo "</div>";
				echo "<div class='overviewcard__info'><i class='fas fa-cash-register fa-3x'></i></div>";
			echo "</div>";
		}
		if(array_key_exists('REPORTE_VENTAS_PROD', $db->derecho)){
			echo "<div class='overviewcard'>";
				echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_reporte/reporte2'><i class='far fa-arrow-alt-circle-right'></i></a>";
				echo "<div class='overviewcard__icon'>Ventas y productos por vendedor";
				echo "</div>";
				echo "<div class='overviewcard__info'><i class='fas fa-people-carry fa-3x'></i></div>";
			echo "</div>";
		}
		if(array_key_exists('REPORTE_CORTE_DE_CAJA', $db->derecho)){
			echo "<div class='overviewcard'>";
				echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_reporte/reporte3'><i class='far fa-arrow-alt-circle-right'></i></a>";
				echo "<div class='overviewcard__icon'>Corte de caja";
				echo "</div>";
				echo "<div class='overviewcard__info'><i class='fas fa-receipt fa-3x'></i></div>";
			echo "</div>";
		}

		if(array_key_exists('REPORTE_CORTE_DE_CAJA', $db->derecho)){
			echo "<div class='overviewcard'>";
				echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_reporte/reporte4'><i class='far fa-arrow-alt-circle-right'></i></a>";
				echo "<div class='overviewcard__icon'>Corte de caja por usuario";
				echo "</div>";
				echo "<div class='overviewcard__info'><i class='fas fa-hand-holding-usd fa-3x'></i></div>";
			echo "</div>";
		}

		
	echo "</div>";
?>
