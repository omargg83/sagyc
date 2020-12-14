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
	<div class='tabla_css' id='tabla_css'>
		<div class='row titulo-row'>
			<div class='col-12'>
				LISTA DE VENTAS ABIERTAS
			</div>
		</div>
		<div class='row header-row'>
			<div class='col-12 col-xl col-auto'>#</div>
			<div class='col-12 col-xl col-auto'>Numero</div>
			<div class='col-12 col-xl col-auto'>Comanda</div>
			<div class='col-12 col-xl col-auto'>Fecha</div>
			<div class='col-12 col-xl col-auto'>Cliente</div>
			<div class='col-12 col-xl col-auto'>Total</div>
		</div>

			<?php
				foreach($pd as $key){
			?>
					<div class='row body-row' draggable='true'>
						<div class='col-12 col-xl col-auto' >
							<div class="btn-group">
								<?php
									if($db->nivel_captura==1){
										echo "<button class='btn btn-warning btn-sm'  id='edit_persona' is='b-link' id='nueva_venta' des='a_venta/venta' dix='trabajo'  v_idventa='$key->idventa' v_general='1'><i class='fas fa-pencil-alt'></i></button>";
									}
								?>
							</div>
						</div>
						<div class='col-12 col-xl col-auto text-center' data-titulo='Numero'><?php echo $key->numero; ?></div>
						<div class='col-12 col-xl col-auto text-center' data-titulo='Comanda'><?php echo $key->comanda; ?></div>
						<div class='col-12 col-xl col-auto' data-titulo='Fecha'><?php echo fecha($key->fecha,2); ?></div>
						<div class='col-12 col-xl col-auto' data-titulo='Cliente'><?php echo $key->nombre; ?></div>
						<div class='col-12 col-xl col-auto' align="center" data-titulo='Total'><?php echo moneda($key->total); ?></div>


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
		where venta.idsucursal='".$_SESSION['idsucursal']."' and (venta.estado='Activa' or venta.estado='Editar') order by venta.numero desc";

		$sth = $db->dbh->query($sql);
		$contar=$sth->fetch(PDO::FETCH_OBJ);
		$paginas=ceil($contar->total/$_SESSION['pagina']);
		$pagx=$paginas-1;

		echo $db->paginar($paginas,$pag,$pagx,"a_ventas/lista","trabajo");

	}
?>
