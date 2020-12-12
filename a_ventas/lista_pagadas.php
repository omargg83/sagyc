<?php
	require_once("db_.php");

	$pag=0;
	$texto="";

	if(isset($_REQUEST['pag'])){
		$pag=$_REQUEST['pag'];
	}
	$pd = $db->ventas_pagadas($pag);


?>
<div class='container'>
	<div class='tabla_css' id='tabla_css'>
		<div class='row titulo-row'>
			<div class='col-12'>
				LISTA DE VENTAS EFECTUADAS
			</div>
		</div>
		<div class='row header-row'>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>#</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Numero</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Comanda</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Fecha</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Cliente</div>
			<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>Total</div>
		</div>

			<?php
				foreach($pd as $key){
			?>
					<div class='row body-row' draggable='true'>
						<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'>
							<div class="btn-group">
								<button class='btn btn-warning btn-sm'  id='edit_persona' is='b-link' id='nueva_venta' des='a_venta/venta' dix='trabajo' title='Ver detalle' v_idventa='<?php echo $key->idventa; ?> ' ><i class='far fa-eye'></i></button>
							</div>
						</div>
						<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 text-center'><?php echo $key->numero; ?></div>
						<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 text-center'><?php echo $key->comanda; ?></div>
						<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'><?php echo fecha($key->fecha,2); ?></div>
						<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2'><?php echo $key->nombre; ?></div>

						<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2' align="center"><?php echo moneda($key->total); ?></div>

					</div>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</div>

<?php
	if(strlen($texto)==0){
		$sql="select count(venta.idventa) as total from venta
		left outer join clientes on clientes.idcliente=venta.idcliente
		where venta.idsucursal='".$_SESSION['idsucursal']."' and venta.estado='Pagada' order by venta.numero desc";
		$sth = $db->dbh->query($sql);
		$contar=$sth->fetch(PDO::FETCH_OBJ);
		$paginas=ceil($contar->total/$_SESSION['pagina']);
		$pagx=$paginas-1;

		echo $db->paginar($paginas,$pag,$pagx,"a_ventas/lista_pagadas","trabajo");
	}
?>
