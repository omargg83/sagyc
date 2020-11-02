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

class Productos extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;
	public function __construct(){
		parent::__construct();

		$this->doc="a_imagenextra/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}

	}
	public function producto_buscar($texto){
		$sql="select * from productos where productos.nombre like '%$texto%' and idtienda='".$_SESSION['idtienda']."' limit 50";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
  }
	public function productos_lista(){
		try{
			$sql="SELECT
			productos_catalogo.nombre,
			productos_catalogo.codigo,
			productos_catalogo.tipo,
			productos.idproducto,
			productos.cantidad,
			productos.precio,
			productos.preciocompra,
			productos.preciom,
			productos.stockmin,
			productos.idsucursal
			from productos
			LEFT OUTER JOIN productos_catalogo ON productos_catalogo.idcatalogo = productos.idcatalogo
			where productos.idsucursal='".$_SESSION['idsucursal']."'limit 50";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function borrar_producto(){
		if (isset($_REQUEST['idproducto'])){ $idproducto=$_REQUEST['idproducto']; }
		return $this->borrar('productos',"idproducto",$idproducto);
	}

	public function producto_editar($id){
		try{
			$sql="SELECT
			productos_catalogo.nombre,
			productos_catalogo.codigo,
			productos_catalogo.tipo,
			productos_catalogo.descripcion,
			productos.idproducto,
			productos.activo_producto,
			productos.cantidad,
			productos.precio,
			productos.preciocompra,
			productos.preciom,
			productos.stockmin,
			productos.idsucursal,
			sucursal.idsucursal,
			sucursal.nombre as nombresuc,
			bodega.idbodega,
			bodega.cantidad
			from productos
			LEFT OUTER JOIN productos_catalogo ON productos_catalogo.idcatalogo = productos.idcatalogo
			LEFT OUTER JOIN sucursal ON sucursal.idsucursal =productos.idsucursal
			LEFT OUTER JOIN bodega ON bodega.idproducto = productos.idproducto
			where productos.idproducto=:id ";

			//$sql="select * from productos where idproducto=:id and idtienda='".$_SESSION['idtienda']."'";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id",$id);
			$sth->execute();
			return $sth->fetch(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}
	public function guardar_producto(){
		try{
			if (isset($_REQUEST['idproducto'])){$idproducto=$_REQUEST['idproducto'];}
			$arreglo =array();
			$tipo="";
			$imei="";

			if (isset($_REQUEST['activo_producto'])){
				$arreglo += array('activo_producto'=>$_REQUEST['activo_producto']);
			}

			if (isset($_REQUEST['precio'])){
				$arreglo += array('precio'=>$_REQUEST['precio']);
			}
			if (isset($_REQUEST['preciom'])){
				$arreglo += array('preciom'=>$_REQUEST['preciom']);
			}
			if (isset($_REQUEST['stockmin'])){
				$arreglo += array('stockmin'=>$_REQUEST['stockmin']);
			}

			if (isset($_REQUEST['preciocompra']) and strlen($_REQUEST['preciocompra'])>0  ){
				$arreglo += array('preciocompra'=>$_REQUEST['preciocompra']);
			}
			else{
				$arreglo += array('preciocompra'=>NULL);
			}

			$x="";

			if($idproducto==0){
				$arreglo+=array('idsucursal'=>$_SESSION['idsucursal']);
				$x=$this->insert('productos', $arreglo);
				$ped=json_decode($x);

				if($ped->error==0){
					$idproducto=$ped->id;

					$this->cantidad_update($idproducto,$tipo);

					$this->update('productos',array('idproducto'=>$idproducto), $arreglo);
				}
			}
			else{
				$x=$this->update('productos',array('idproducto'=>$idproducto), $arreglo);

				$this->cantidad_update($idproducto,$tipo);
			}
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}

	public function genera_barras(){
		try{
			parent::set_names();
			$id=$_REQUEST['id'];
			$codigo="9".str_pad($id, 8, "0", STR_PAD_LEFT);
			$arreglo =array();

			$arreglo = array('codigo'=>$codigo);
			$arreglo+=array('fechamod'=>date("Y-m-d H:i:s"));
			$x=$this->update('productos',array('id'=>$id), $arreglo);
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}
	public function existencia_agrega(){
		try{

			if($_REQUEST['cantidad']<1){
				$arreglo =array();
				$arreglo+=array('id'=>$idproducto);
				$arreglo+=array('error'=>1);
				$arreglo+=array('terror'=>"Error de cantidad, favor de verificar");
				return json_encode($arreglo);
			}

			$id=$_REQUEST['id'];
			$idproducto=$_REQUEST['idproducto'];
			$arreglo =array();
			$arreglo = array('idproducto'=>$idproducto);

			if (isset($_REQUEST['cantidad'])){
				$arreglo += array('cantidad'=>$_REQUEST['cantidad']);
			}
			if (isset($_REQUEST['nota'])){
				$arreglo += array('nota'=>$_REQUEST['nota']);
			}
			if (isset($_REQUEST['fecha'])){
				$fx=explode("-",$_REQUEST['fecha']);
				//$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
				$arreglo+=array('fecha'=>$_REQUEST['fecha']);
			}
			$x="";
			if($id==0){
				$arreglo+=array('fechaalta'=>date("Y-m-d H:i:s"));
				$arreglo+=array('idpersona'=>$_SESSION['idpersona']);
				$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
				$arreglo+=array('idsucursal'=>$_SESSION['idsucursal']);
				$x=$this->insert('bodega', $arreglo);
			}
			else{
				$arreglo+=array('fechamod'=>date("Y-m-d H:i:s"));
				$x=$this->update('bodega',array('id'=>$id), $arreglo);
			}
			$ped=json_decode($x);
			if($ped->error==0){
				$arreglo =array();
				$arreglo+=array('id'=>$idproducto);
				$arreglo+=array('error'=>0);
				$arreglo+=array('terror'=>0);
				$arreglo+=array('param1'=>"");
				$arreglo+=array('param2'=>"");
				$arreglo+=array('param3'=>"");
				return json_encode($arreglo);
			}
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}
	public function productos_inventario($id){
		try{
			$sql="select * from bodega where idproducto=$id and idsucursal='".$_SESSION['idsucursal']."' order by idbodega desc";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}
	public function borrar_ingreso(){
		$id=$_REQUEST['id'];
		$idproducto=$_REQUEST['idproducto'];

		$sql="SELECT * from bodega where id=:id";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id",$id);
		$sth->execute();
		$res=$sth->fetch(PDO::FETCH_OBJ);

		$x=$this->borrar('bodega',"id",$id);

		$arreglo =array();
		$arreglo+=array('id'=>$idproducto);
		$arreglo+=array('error'=>0);
		$arreglo+=array('terror'=>0);
		return json_encode($arreglo);
	}
	public function sucursal(){
		try{
			$sql="SELECT * FROM sucursal where idtienda='".$_SESSION['idtienda']."'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}

	public function categoria(){
		try{
			$sql="SELECT * FROM categorias where idtienda='".$_SESSION['idtienda']."'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}

}
$db = new Productos();
if(strlen($function)>0){
	echo $db->$function();
}
?>