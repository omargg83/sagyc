<?php
require_once("../db_.php");

echo "<div class='main-overview'>";
	if(array_key_exists('VENTA', $db->derecho)){
		echo "<div class='overviewcard'>";
			echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_venta/venta'><i class='far fa-arrow-alt-circle-right'></i></a>";
			echo "<div class='overviewcard__icon'>Nueva Venta";
			echo "</div>";
			echo "<div class='overviewcard__info'><i class='fas fa-cash-register fa-2x'></i></div>";
		echo "</div>";
	}
	if(array_key_exists('VENTAREGISTRO', $db->derecho)){
		echo "<div class='overviewcard'>";
			echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_ventas/index'><i class='far fa-arrow-alt-circle-right'></i></a>";
			echo "<div class='overviewcard__icon'>Registro de Ventas";
			echo "</div>";
			echo "<div class='overviewcard__info'><i class='fas fa-shopping-basket fa-2x'></i></div>";
		echo "</div>";
	}
	if(array_key_exists('PRODUCTOS', $db->derecho)){
		echo "<div class='overviewcard'>";
			echo "<a class='btn btn-warning btn-sm btn-block' id='menu_ventas' is='menu-link' href='#a_productos/index'><i class='far fa-arrow-alt-circle-right'></i></a>";
			echo "<div class='overviewcard__icon'>Productos";
			echo "</div>";
			echo "<div class='overviewcard__info'><i class='fab fa-product-hunt fa-2x'></i></div>";
		echo "</div>";
	}
	
echo "</div>";

