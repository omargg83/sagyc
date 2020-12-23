<?php
	require_once("db_.php");

	$pag=0;
	$texto="";
	if(isset($_REQUEST['buscar'])){
		$texto=$_REQUEST['buscar'];
		$pd = $db->ventas_buscar($texto);
		$texto=1;
	}
	else{
		if(isset($_REQUEST['pag'])){
			$pag=$_REQUEST['pag'];
		}
		$pd = $db->ventas_lista($pag);
	}

?>
<div class='container'>
	<div class='tabla_v' id='tabla_css'>
		<div class='title-row'>
			<div>
				LISTA DE VENTAS ABIERTAS
			</div>
		</div>
		<div class='header-row'>
			<div class='cell'>#</div>
			<div class='cell'>Numero</div>
			<div class='cell'>Comanda</div>
			<div class='cell'>Fecha</div>
			<div class='cell'>Cliente</div>
			<div class='cell'>Total</div>
		</div>

		<?php
			foreach($pd as $key){
		?>
				<div class='body-row'>
					<div class='cell' >
						<div class="btn-group">
							<?php
								if($db->nivel_captura==1){
									echo "<button class='btn btn-warning btn-sm'  id='edit_persona' is='b-link' id='nueva_venta' des='a_venta/venta' dix='trabajo'  v_idventa='$key->idventa' v_general='1'><i class='fas fa-pencil-alt'></i></button>";
								}
							?>
						</div>
					</div>
					<div class='cell text-center' data-titulo='Numero'><?php echo $key->numero; ?></div>
					<div class='cell text-center' data-titulo='Comanda'><?php echo $key->comanda; ?></div>
					<div class='cell' data-titulo='Fecha'><?php echo fecha($key->fecha,2); ?></div>
					<div class='cell' data-titulo='Cliente'><?php echo $key->nombre; ?></div>
					<div class='cell' align="center" data-titulo='Total'><?php echo moneda($key->total); ?></div>


				</div>
		<?php
			}
		?>

		
	</div>
</div>

<?php
	if(strlen($texto)==0){
		$sql="select count(venta.idventa) as total from venta
		left outer join clientes on clientes.idcliente=venta.idcliente
		where venta.idsucursal='".$_SESSION['idsucursal']."' and (venta.estado='Activa' or venta.estado='Editar') order by venta.numero desc";

		$sth = $db->dbh->query($sql);
		$contar=$sth->fetch(PDO::FETCH_OBJ);
		$paginas=ceil($contar->total/$_SESSION['pagina']);
		$pagx=$paginas-1;

		echo $db->paginar($paginas,$pag,$pagx,"a_ventas/lista","trabajo");

	}
?>
