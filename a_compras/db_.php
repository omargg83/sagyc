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

class Compras extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;
	public function __construct(){
		parent::__construct();
		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function compras_lista(){
		try{
			$sql="SELECT * FROM compras where idtienda='".$_SESSION['idtienda']."'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED!".$e->getMessage();
		}
	}
	public function compra($id){
		try{
		  $sql="select * from compras where idcompra=:id";
		  $sth = $this->dbh->prepare($sql);
		  $sth->bindValue(":id",$id);
		  $sth->execute();
		  return $sth->fetch(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
		  return "Database access FAILED!".$e->getMessage();
		}
	}
	public function guardar_compra(){
		$x="";
		$arreglo =array();

		$idcompra=$_REQUEST['idcompra'];
		if (isset($_REQUEST['nombre'])){
			$arreglo+=array('nombre'=>$_REQUEST['nombre']);
		}
		if (isset($_REQUEST['ubicacion'])){
			$arreglo+=array('ubicacion'=>$_REQUEST['ubicacion']);
		}

		if($idcompra==0){
			$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
			$x=$this->insert('compras', $arreglo);
		}
		else{
			$x=$this->update('compras',array('idcompra'=>$idcompra), $arreglo);
		}
		return $x;
	}
	public function borrar_compra(){
		$idcompra=$_REQUEST['idcompra'];
		$x=$this->borrar('compras',"idcompra",$idcompra);
		return $x;
	}

	public function proveedores_lista(){
		$sql="SELECT * FROM proveedores where idtienda='".$_SESSION['idtienda']."'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}
	public function entrada($id){
		$sql="select * from bodega where idcompra='$id'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}
	public function guardar_entrada(){
		$arreglo =array();
		$idcompra=$_REQUEST['idcompra'];
		if (isset($_REQUEST['numero'])){
			$arreglo+=array('numero'=>$_REQUEST['numero']);
		}
		if (isset($_REQUEST['idproveedor'])){
			$arreglo+=array('idproveedor'=>$_REQUEST['idproveedor']);
		}
		if (isset($_REQUEST['idcompra'])){
			$arreglo+=array('idcompra'=>$_REQUEST['idcompra']);
		}
		if (isset($_REQUEST['estado'])){
			$arreglo+=array('estado'=>$_REQUEST['estado']);
		}
		if (isset($_REQUEST['unico'])){
			$arreglo+=array('unico'=>$_REQUEST['unico']);
		}
		if($idcompra==0){
			$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
			$arreglo+=array('estado'=>"Activa");
			$x=$this->insert('compras', $arreglo);
		}
		else{
			$x=$this->update('compras',array('idcompra'=>$idcompra), $arreglo);
		}
		return $x;
	}
	public function agregacompra(){
		$idcompra=$_REQUEST['idcompra'];
		$idproducto=$_REQUEST['idproducto'];
		$observaciones=$_REQUEST['observaciones'];
		$cantidad=$_REQUEST['cantidad'];
		$precio=$_REQUEST['precio'];

		$arreglo=array();
		$arreglo+=array('idcompra'=>$idcompra);
		$arreglo+=array('idproducto'=>$idproducto);
		$arreglo+=array('idpersona'=>$_SESSION['idpersona']);
		$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
		$arreglo+=array('idsucursal'=>$_SESSION['idsucursal']);
		$arreglo+=array('observaciones'=>$observaciones);
		$arreglo+=array('cantidad'=>$cantidad);

		$x=$this->insert('bodega', $arreglo);

		$arr=array();
		$arr=array('id'=>$idcompra);
		return json_encode($arr);
	}
}

$db = new Compras();
if(strlen($function)>0){
	echo $db->$function();
}
