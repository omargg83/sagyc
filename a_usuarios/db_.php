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
class Usuario extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		if(isset($_SESSION['idusuario']) and $_SESSION['autoriza'] == 1 and array_key_exists('USUARIOS', $this->derecho)) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function usuario($id){
		$sql="select * from usuarios where idusuario='$id'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetch(PDO::FETCH_OBJ);
	}
	public function usuario_buscar($texto){
		$sql="select usuarios.idusuario, usuarios.idtienda, usuarios.nombre, usuarios.USER,	usuarios.pass,	usuarios.nivel,	usuarios.activo,tienda.razon AS tienda, sucursal.idsucursal, sucursal.nombre as sucursal from usuarios
		left outer join tienda on tienda.idtienda=usuarios.idtienda
		where usuarios.nombre like '%$texto%' and tienda.idtienda='".$_SESSION['idtienda']."'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
  }
	public function usuario_lista(){
		try{
			$sql="SELECT usuarios.idusuario, usuarios.idtienda, usuarios.nombre, usuarios.USER,	usuarios.pass,	usuarios.nivel,	usuarios.activo,tienda.razon AS tienda FROM usuarios
			LEFT OUTER JOIN tienda ON tienda.idtienda = usuarios.idtienda
			where tienda.idtienda='".$_SESSION['idtienda']."'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			echo $e;
			return "Database access FAILED!";
		}
  }
  public function sucursal_lista(){
		$sql="SELECT * FROM sucursal where idtienda='".$_SESSION['idtienda']."'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}
	public function guardar_usuario(){
		$x="";
		$arreglo =array();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		if (isset($_REQUEST['nombre'])){
			$arreglo+=array('nombre'=>clean_var($_REQUEST['nombre']));
		}
		if (isset($_REQUEST['estado'])){
			$arreglo+=array('activo'=>$_REQUEST['estado']);
		}
		if (isset($_REQUEST['user'])){
			$arreglo+=array('user'=>clean_var($_REQUEST['user']));
		}
		if (isset($_REQUEST['nivel'])){
			$arreglo+=array('nivel'=>$_REQUEST['nivel']);
		}
		if (isset($_REQUEST['idsucursal'])){
			$arreglo+=array('idsucursal'=>$_REQUEST['idsucursal']);
		}

		if($id==0){
			$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
			$x=$this->insert('usuarios', $arreglo);
		}
		else{
			$x=$this->update('usuarios',array('idusuario'=>$id), $arreglo);
		}
		return $x;
	}
	public function password(){
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		if (isset($_REQUEST['pass1'])){$pass1=$_REQUEST['pass1'];}
		if (isset($_REQUEST['pass2'])){$pass2=$_REQUEST['pass2'];}
		if(trim($pass1)==($pass2)){
			$arreglo=array();
			$passPOST=md5(trim($pass1));
			$arreglo=array('pass'=>$passPOST);
			$x=$this->update('usuarios',array('idusuario'=>$id), $arreglo);
			return $x;
		}
		else{
			return "La contraseña no coincide";
		}
	}
	public function borrar_usuario(){
		if (isset($_REQUEST['id'])){ $id=$_REQUEST['id']; }
		return $this->borrar('usuarios',"idusuario",$id);
	}
	public function modulos(){
		$x="";
		$x.= "<option value='' selected></option>";
		$x.= "<optgroup label='Ventas'>";
		$x.= "<option value='VENTA'>Venta</option>";
		$x.= "<option value='VENTAREGISTRO'>Ventas registro</option>";

		$x.= "<optgroup label='Productos'>";
		$x.= "<option value='PRODUCTOS'>Productos</option>";
		$x.= "<option value='INVENTARIO'>Inventario</option>";

		$x.= "<optgroup label='Clientes'>";
		$x.= "<option value='CLIENTES'>Clientes</option>";
		$x.= "<option value='CITAS'>Citas</option>";

		$x.= "<optgroup label='Proveedores'>";
		$x.= "<option value='PROVEEDORES'>Proveedores</option>";
		$x.= "<option value='COMPRAS'>Compras</option>";
		$x.= "<option value='TRASPASOS'>Traspasos</option>";

		$x.= "<optgroup label='Empresa'>";
		$x.= "<option value='DATOSEMP'>Datos</option>";
		$x.= "<option value='SUCURSAL'>Sucursal</option>";
		$x.= "<option value='REPORTES'>Reportes</option>";
		$x.= "<option value='USUARIOS'>Usuarios</option>";
		return $x;
	}

	public function nivel(){
		$x="";
		$x.="<option value='0' >0-Administrador</option>";
		$x.="<option value='1' >1-Subsecretarío</option>";
		$x.="<option value='2' >2-Dirección</option>";
		$x.="<option value='3' >3-Subdirector</option>";
		$x.="<option value='4' >4-Coordinador Administrativo</option>";
		$x.="<option value='5' >5-Jefe Depto.</option>";
		$x.="<option value='6' >6-Coordinador</option>";
		$x.="<option value='7' >7-Secretaria</option>";
		$x.="<option value='8' >8-Chofer</option>";
		$x.="<option value='9' >9-Personal</option>";
		$x.="<option value='10' >10-Informatica</option>";
		$x.="<option value='11' >11-Administrador del sistema</option>";
		$x.="<option value='12' >12-Oficialia</option>";
		return $x;
	}
	public function guardar_permiso(){
		$x="";

		$arreglo =array();

		if (isset($_REQUEST['idusuariox'])) {
			$idusuariox=$_REQUEST['idusuariox'];
		}
		else{
			$acceso=0;
		}
		if (isset($_REQUEST['modulo'])) {
			$aplicacion=$_REQUEST['modulo'];
			$arreglo+=array('modulo'=>$_REQUEST['modulo']);
		}

		if (isset($_REQUEST['captura'])) $arreglo+=array('captura'=>$_REQUEST['captura']);
		if (isset($_REQUEST['nivelx'])) $arreglo+=array('nivel'=>$_REQUEST['nivelx']);

		$sql="select * from usuarios_permiso where idusuario='$idusuariox' and modulo='$aplicacion'";
		$a=$this->general($sql);

		$arreglo+=array('idusuario'=>$idusuariox);

		if(count($a)>0){
			$x=$this->update('usuarios_permiso',array('idpermiso'=>$a[0]['idpermiso']),$arreglo);
		}
		else{
			$x=$this->insert('usuarios_permiso', $arreglo);
		}

		$arreglo =array();
		$arreglo+=array('id'=>$idusuariox);
		$arreglo+=array('error'=>0);
		return json_encode($arreglo);

	}
	public function borrar_permiso(){
		if (isset($_REQUEST['idpermiso'])){ $idpermiso=$_REQUEST['idpermiso']; }
		$this->borrar('usuarios_permiso',"idpermiso",$idpermiso);

		$arreglo =array();
		$arreglo+=array('id'=>$_REQUEST['idusuario']);
		$arreglo+=array('error'=>0);
		return json_encode($arreglo);
	}
	public function agregar_todos(){
		$id=$_REQUEST['idusuario'];

		$x="";
		$sql="delete from usuarios_permiso where idusuario='$id'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'USUARIOS'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'VENTA'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'VENTAREGISTRO'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'PRODUCTOS'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'INVENTARIO'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'CLIENTES'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'CITAS'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'PROVEEDORES'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'COMPRAS'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'TRASPASOS'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'DATOSEMP'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'SUCURSAL'));
		$x=$this->insert('usuarios_permiso', array('idusuario'=>$id,'captura'=>0,'nivel'=>0,'modulo'=>'REPORTES'));

		$arreglo =array();
		$arreglo+=array('id'=>$id);
		$arreglo+=array('error'=>0);
		return json_encode($arreglo);
	}

}

$db = new Usuario();
if(strlen($function)>0){
	echo $db->$function();
}
