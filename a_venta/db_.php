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
		$this->doc="a_clientes/papeles/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function agregaventa(){

		$x="";
		$cliente="";
		$observaciones="";
		$cantidad="0";
		$precio="0";
		$tipo="0";
		$idventa=$_REQUEST['idventa'];

		try{
			if(isset($_REQUEST['idproducto'])){
				$idproducto=$_REQUEST['idproducto'];
				$cantidad=$_REQUEST['cantidad'];
				$precio=$_REQUEST['precio'];

				$sql="select * from productos where idproducto='$idproducto'";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();
				$producto=$sth->fetch(PDO::FETCH_OBJ);

				if($producto->tipo==3){
					$sql="select sum(cantidad) as total from bodega where idsucursal='".$_SESSION['idsucursal']."' and idproducto='$idproducto'";
					$sth = $this->dbh->prepare($sql);
					$sth->execute();
					$suma=$sth->fetch(PDO::FETCH_OBJ);
				}

				if($idventa==0){
					$date=date("Y-m-d H:i:s");

					$sql = "SELECT MAX(numero) FROM venta where idtienda='".$_SESSION['idtienda']."'";
					$statement = $this->dbh->prepare($sql);
					$statement->execute();
					$numero=$statement->fetchColumn()+1;

					$arreglo=array();
					$arreglo+=array('idcliente'=>1);
					$arreglo+=array('estado'=>"Activa");
					$arreglo+=array('numero'=>$numero);
					$arreglo+=array('fecha'=>$date);
					$arreglo+=array('idusuario'=>$_SESSION['idpersona']);
					$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
					$x=$this->insert('venta', $arreglo);
					$ped=json_decode($x);
					if($ped->error==0){
						$idventa=$ped->id;
					}
				}

				$arreglo=array();
				$arreglo+=array('idventa'=>$idventa);
				$arreglo+=array('idpersona'=>$_SESSION['idpersona']);
				$arreglo+=array('idtienda'=>$_SESSION['idtienda']);
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

				return $idventa;


				$arreglo =array();
				$arreglo+=array('id'=>$idventa);
				$arreglo+=array('error'=>0);
				$arreglo+=array('terror'=>0);
				$arreglo+=array('param1'=>"");
				$arreglo+=array('param2'=>"");
				$arreglo+=array('param3'=>"");
				return json_encode($arreglo);
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
}

$db = new Venta();
if(strlen($function)>0){
	echo $db->$function();
}
