<?php
require_once("../control_db.php");

if($_SESSION['des']==1 and strlen($function)==0)
{
	echo "<div class='alert alert-primary' role='alert'>";
	$arrayx=explode('/', $_SERVER['SCRIPT_NAME']);
	echo print_r($arrayx);
	echo "<hr>";
	echo print_r($_REQUEST);
	echo "</div>";
}

class Venta extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		if(isset($_SESSION['idusuario']) and $_SESSION['autoriza'] == 1 and array_key_exists('VENTA', $this->derecho)) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function venta($id){
		$sql="select * from venta where idventa='$id'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetch(PDO::FETCH_OBJ);
	}
	public function agregaventa(){
		$x="";
		$cliente="";
		$observaciones="";
		$cantidad="0";
		$precio="0";
		$tipo="0";
		$idventa=$_REQUEST['idventa'];
		$idcliente=$_REQUEST['idcliente'];
		$idproducto=$_REQUEST['idproducto'];

		$sql="select * from productos
		left outer join productos_catalogo on productos_catalogo.idcatalogo=productos.idcatalogo
		where idproducto='$idproducto'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		$producto=$sth->fetch(PDO::FETCH_OBJ);

		if(!isset($_REQUEST['precio'])){
			$arreglo =array();
			$arreglo+=array('error'=>1);
			$arreglo+=array('terror'=>"Falta precio");
			return json_encode($arreglo);
		}
		else{
			$precio=clean_var($_REQUEST['precio']);
		}

		if(!isset($_REQUEST['cantidad'])){
			$arreglo =array();
			$arreglo+=array('error'=>1);
			$arreglo+=array('terror'=>"Falta cantidad");
			return json_encode($arreglo);
		}
		else{
			$cantidad=clean_var($_REQUEST['cantidad']);
		}

		if($precio==0){
			$arreglo =array();
			$arreglo+=array('error'=>1);
			$arreglo+=array('terror'=>"Verificar precio $precio");
			return json_encode($arreglo);
		}
		if($cantidad==0){
			$arreglo =array();
			$arreglo+=array('error'=>1);
			$arreglo+=array('terror'=>"Verificar cantidad");
			return json_encode($arreglo);
		}

		if($producto->tipo==3){
			$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$idproducto'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$cantidad_bg=$sth->fetch(PDO::FETCH_OBJ);
			if ($cantidad>$cantidad_bg->total){
				$arreglo =array();
				$arreglo+=array('error'=>1);
				$arreglo+=array('terror'=>"Verificar cantidad");
				return json_encode($arreglo);
			}
		}

		try{
			if(isset($_REQUEST['idproducto'])){
				$precio=$_REQUEST['precio'];



				if($idventa==0){
					$date=date("Y-m-d H:i:s");
					$estado="Activa";
					$sql = "SELECT MAX(numero) FROM venta where idsucursal='".$_SESSION['idtienda']."'";
					$statement = $this->dbh->prepare($sql);
					$statement->execute();
					$numero=$statement->fetchColumn()+1;

					$arreglo=array();
					$arreglo+=array('idcliente'=>$idcliente);
					$arreglo+=array('estado'=>$estado);
					$arreglo+=array('numero'=>$numero);
					$arreglo+=array('fecha'=>$date);
					$arreglo+=array('idusuario'=>$_SESSION['idusuario']);
					$arreglo+=array('idsucursal'=>$_SESSION['idsucursal']);
					$x=$this->insert('venta', $arreglo);
					$ped=json_decode($x);
					if($ped->error==0){
						$idventa=$ped->id;
					}
					else{
						return $x;
					}
				}
				else{
					$sql="select * from venta where idventa='$idventa'";
					$sth = $this->dbh->prepare($sql);
					$sth->execute();
					$venta=$sth->fetch(PDO::FETCH_OBJ);
					$numero=$venta->numero;
					$date=$venta->fecha;
					$estado=$venta->estado;
				}

				$arreglo=array();
				$arreglo+=array('idventa'=>$idventa);
				$arreglo+=array('idpersona'=>$_SESSION['idusuario']);
				$arreglo+=array('idsucursal'=>$_SESSION['idsucursal']);
				$arreglo+=array('idproducto'=>$producto->idproducto);
				$arreglo+=array('v_cantidad'=>$cantidad);
				$arreglo+=array('v_precio'=>$precio);
				$total=$cantidad*$precio;
				$arreglo+=array('v_total'=>$total);
				$cantidad=$cantidad*-1;
				$arreglo+=array('cantidad'=>$cantidad);
				$arreglo+=array('nombre'=>$producto->nombre);
				$x=$this->insert('bodega', $arreglo);
				$ped=json_decode($x);

				$total=$this->suma_venta($idventa);

				if($ped->error==0){
					$arreglo =array();
					$arreglo+=array('idventa'=>$idventa);
					$arreglo+=array('error'=>0);
					$arreglo+=array('numero'=>$numero);
					$arreglo+=array('estado'=>$estado);
					$arreglo+=array('total'=>$total);
					$fecha1 = date ( "Y-m-d" , strtotime($date) );
					$arreglo+=array('fecha'=>$fecha1);
					$arreglo+=array('error'=>0);
					return json_encode($arreglo);
				}
				else{
					return $x;
				}
			}
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function ventas_pedido($id){
		$sql="select * from bodega where idventa='$id' order by idbodega desc";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}
	public function borrar_venta(){
		$idbodega=$_REQUEST['idbodega'];
		$idventa=$_REQUEST['idventa'];
		$x=$this->borrar('bodega',"idbodega",$idbodega);
		$total=$this->suma_venta($idventa);

		$arreglo =array();
		$arreglo+=array('idventa'=>$idventa);
		$arreglo+=array('error'=>0);
		$arreglo+=array('total'=>$total);
		return json_encode($arreglo);
	}
	public function agregar_cliente(){
		try{
			$idventa=$_REQUEST['idventa'];
			$idcliente=$_REQUEST['idcliente'];
			if($idventa==0){
				$sql = "SELECT MAX(numero) FROM venta where idsucursal='".$_SESSION['idtienda']."'";
				$statement = $this->dbh->prepare($sql);
				$statement->execute();
				$numero=$statement->fetchColumn()+1;

				$arreglo=array();
				$arreglo+=array('idcliente'=>$idcliente);
				$arreglo+=array('estado'=>"Activa");
				$arreglo+=array('numero'=>$numero);

				$date=date("Y-m-d H:i:s");
				$arreglo+=array('fecha'=>$date);
				$arreglo+=array('idusuario'=>$_SESSION['idusuario']);
				$arreglo+=array('idsucursal'=>$_SESSION['idsucursal']);
				$x=$this->insert('venta', $arreglo);
			}
			else{
				$arreglo=array();
				$arreglo+=array('idcliente'=>$idcliente);
				$x=$this->update('venta',array('idventa'=>$idventa), $arreglo);
			}
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function suma_venta($idventa){
		$sql="select sum(v_precio * v_cantidad) as total from bodega where idventa='$idventa' ";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		$rex=$sth->fetch(PDO::FETCH_OBJ);

		$arreglo=array();
		$arreglo+=array('total'=>$rex->total);
		$this->update('venta',array('idventa'=>$idventa), $arreglo);
		return $rex->total;
	}
	public function finalizar_venta(){

		$total_g=clean_var($_REQUEST['total_g']);
		$efectivo_g=clean_var($_REQUEST['efectivo_g']);
		$cambio_g=clean_var($_REQUEST['cambio_g']);
		$tipo_pago=clean_var($_REQUEST['tipo_pago']);

		if($total_g>0){
			if($total_g<=$efectivo_g){
				if (isset($_REQUEST['idventa'])){$idventa=$_REQUEST['idventa'];}
				$arreglo =array();
				$arreglo+=array('tipo_pago'=>$tipo_pago);
				$arreglo+=array('estado'=>"Pagada");
				return $this->update('venta',array('idventa'=>$idventa), $arreglo);
			}
			else{
				return "favor de verificar";
			}
		}
		else{
			return "Debe de agregar un producto";
		}
	}
	public function cliente($idcliente){
		try{
			$sql="select * from clientes where idcliente='$idcliente'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetch(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
}

$db = new Venta();
if(strlen($function)>0){
	echo $db->$function();
}
