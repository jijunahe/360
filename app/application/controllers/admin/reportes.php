<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
 
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Reportes extends Survey_Common_Action
{
 	private $kp='93857366asmdmfmm';
	private $filesbi="/filesbi/cubos/";
	private $filesbideleted="/filesbi/cubos/deleted/";
	function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        Yii::app()->loadHelper('database');
		$this->kp= $this->kp.substr($this->kp,0,8);
    }
	 
	public function validar($data){
		$nulls=array();
		foreach($data as $k=>$v){
			if(is_null($v)){
				array_push($nulls,$k);
			}
		}
		$estado=true;
		if(count($nulls)>0){
			$estado=false;
		}
		return array($estado,$nulls);
	}
	public function getOrigenes($id=NULL){
		$dat=NULL;
		if($id!=NULL){
			$dat = new CDbCriteria;
			$dat->condition = "id = ".(int)$id;
		}
 		$origenes=AnaOrigendedatos::model()->findAll($dat);
		$newO=array();
		foreach($origenes as $k=>$v){
			$org=(object)array();
			foreach($v as $id=>$valor){
				$org->{$id}=$valor;
			}
 			array_push($newO,$org);
		}
		return $newO;
	} 
 	
	
	public function encrypt($data,$key){ 
	 error_reporting(E_ALL); ini_set('display_errors', '1');

		$mode = MCRYPT_MODE_CBC;
		$algorithm = MCRYPT_3DES;
  		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode),MCRYPT_DEV_URANDOM);
 		$encrypted_data = mcrypt_encrypt($algorithm, $key, date("Y-m-d")." ".$data." ", $mode, $iv);
		$plain_text = base64_encode($encrypted_data);		
 		return $plain_text;
	}

	public function decrypt($data,$key){
		$mode = MCRYPT_MODE_CBC;
		$algorithm = MCRYPT_3DES;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode),MCRYPT_DEV_URANDOM);
  		$encrypted_data = base64_decode($data);
		$decoded = mcrypt_decrypt($algorithm, $key, $encrypted_data, $mode, $iv);
 		return $decoded;
 	}
	
	public function getDecript($dato,$jsondecode=false){
		$r=$this->decrypt($this->escape($dato),$this->kp);
		//printVar($r);
		$decripted=explode(" ",$r);
		//printVar($decripted[count($decripted)-2],count($decripted)-2);
		if(isset($decripted[1])){
			if($jsondecode==true){
				return  json_decode(base64_decode($decripted[count($decripted)-2]));
			}else{
			return base64_decode($decripted[count($decripted)-2]);
			}
		}else{return "error";}
	}
	
  	
 	
	private function crear($post){
		 Yii::app()->cache->flush();
		//error_reporting(E_ALL); ini_set('display_errors', '1');
 		$campos=array("nombre","id_motor","origendedatos","usuario","password","puerto","ip");
 		$labels=array("nombre"=>"","id_motor"=>"","origendedatos"=>"","usuario"=>"","password"=>"","puerto"=>"","ip"=>"");
 		$set=array();
		$validar=array("nombre"=>NULL,"id_motor"=>NULL,"origendedatos"=>NULL,"usuario"=>NULL,"password"=>NULL,"puerto"=>NULL,"ip"=>NULL);
		foreach($_POST as $k=>$v){
			if(in_array($k,$campos) and !is_null($v) and $v!=""){
				$validar[$k]=1;
				$set[$k]=$this->escape($v);
			} 
		}
		$r=$this->validar($validar);
		$data=array();
		//printVar($validar);
		if($r[0]==true){
			if((int)$_POST["id"]>0){
  				$dat=AnaOrigendedatos::model()->findByPk((int)$_POST["id"]);
				foreach($set as $k=>$v){
					if($k!="password" and $k!="usuario" and  $k!="origendedatos"  and $k!="ip" ){
						$dat->{$k}=$v;
					}else{
						$dat->{$k}=$this->encrypt(base64_encode($v),$this->kp); 
					}
				}
				$dat->save();
  				$estado=true;
 			}else{		
 				$dat = new AnaOrigendedatos();
				foreach($set as $k=>$v){
					if($k!="password" and $k!="usuario" and  $k!="origendedatos" and $k!="ip" ){
						$dat->{$k}=$v;
					}else{
						$dat->{$k}=$this->encrypt(base64_encode($v),$this->kp);
					}
				}
				
				$dat->id_usuario=Yii::app()->user->id;
				$dat->fecha=date("Y-m-d H:i:s");
				
				$res=$dat->save();
 				$estado=true;
			}
		}else{
			$data=$r[1];
 			$estado=false;
		}
 		return array($estado,$data);
 	}
  	
	private function eliminar($id){
		$dat=AnaOrigendedatos::model()->findByPk((int)$id);
		if(isset($dat->id)){
			$datbk = new AnaOrigendedatosBk;
			foreach($dat as $k=>$val){
				if($k!="id"){
					$datbk->{$k}=$val;
				}else{
					$datbk->id_origen=$val;
				}
			}
			$datbk->save();
			$dat->delete();
		}

	}	
    public function index()
    {   Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){
			$mensaje=array();
			if((int)Yii::app()->user->id>0){ 
				if(isset($_POST["option"])){
					//printVar($_POST);
					if(isset($_POST["test"])){
						$_POST["option"]=$_POST["test"];
					}
 					switch($_POST["option"]){
						case "crear":
							unset($_POST["option"]); 
							$r=$this->crear($_POST);  
 							$mensaje=$r;
 						break;
						case "Test":unset($_POST["option"]); 
							$test = new PDO('mysql:host='.$_POST["ip"].';port='.(int)$_POST["puerto"].';dbname='.$_POST["origendedatos"], $_POST["usuario"],  $_POST["password"]);
							unset($test);
							echo "ok"; 
							exit;
						break;
						case "dimensiones":
 							$tcubo=$this->getCubos((int)$_POST["id"]," id_usuario=".Yii::app()->user->id);
							$estado=false;
							$nd=array();
							$dimensiones=array();
							$nombrecubo="";
							if(isset($tcubo[0]->id)){
								$nombrecubo=$tcubo[0]->nombre;
								$nombre=md5($this->escape($tcubo[0]->nombre));
								$datos=$this->getArchivoCubo($nombre);
								if($datos[0]==true){
									$key = $this->kp;
									$decoded=$datos[1];   
									$ndecoded=explode(" ",$this->decrypt($decoded,$key));
									//echo $ndecoded[1];
									if(isset($ndecoded[1])){
										$datos=json_decode(base64_decode($ndecoded[1]));
 										foreach($datos as $k=>$d){
											if($k!="dimensiones"){
												$nd[$k]=$d;
											}else{
												$dimensiones=json_decode(base64_decode($d));
											}
										}
									 $estado=true;
									}
								}
 							}
							echo json_encode(array($estado,$nd,$nombrecubo,$dimensiones));
							exit;							
 						break;
						case "eliminar":
							$this->eliminar($_POST["id"]);
							$mensaje=array("ok");
						break;
						case "":
						break;
						case "decript":
							$r=$this->decrypt($this->escape($_POST["dato"]),$this->kp);
							$decripted=explode(" ",$r);
							if(isset($decripted[1])){
								echo json_encode(array(base64_decode($decripted[1])));
							}else{echo json_encode(array("error"));}
							exit;
						break; 
						case "creargrafico":
 							$set=(object) array();
							$set->id_cubo=(int)$_POST["idtabla"];
							$set->filas= ($_POST["query"]["f"]);
							$set->columnas=($_POST["query"]["c"]);
							$set->filtro=($_POST["filtros"]);
							$set->fil=($_POST["query"]["fil"]);
							//$set->id_tipografico=1; 
  							echo json_encode($set);
							exit;
						break;
						 
						case "guardarreporte":
							$mensaje="No hay datos de configuración";
							$estado=0;
							$dataj=json_decode($_POST["reporte"]);
							$idr_reporte=NULL;
							if($_POST["reporte"]!=""){
								$idrep=-1;
								if(isset($_POST["id"])){
									$idrep=(int)$_POST["id"];
								}
								$nombre=$this->escape($_POST["titulo"]);
								$dat = new CDbCriteria;
								$dat->condition = "id_usuario = ".(int)Yii::app()->user->id."  and id=".$idrep;
								$rt=AnaReporte::model()->find($dat);
								if(isset($rt->id)){
									$dat = new CDbCriteria;
									$dat->condition = "id_usuario = ".(int)Yii::app()->user->id." and nombre='".$nombre."' and id<>".$idrep;
									$testr=AnaReporte::model()->find($dat);
									if(!isset($testr->id)){
 										$rt->nombre=$nombre;
										$rt->id_usuario=(int)Yii::app()->user->id;
										$rt->config=$_POST["reporte"];
										$rt->save();
										
										$query="id_usuario = ".(int)Yii::app()->user->id." and ";
										$query.="nombre='".$nombre."' and id_reporte=".$idrep." and ";
										$query.="config='".$_POST["reporte"]."'";
										
										$dat = new CDbCriteria;
										$dat->condition =$query ;
										$testversion=AnaReporteVersiones::model()->find($dat);
										if(!isset($testversion->id)){
 											$rep = new AnaReporteVersiones;
											$rep->nombre=$nombre;
											$rep->id_usuario=(int)Yii::app()->user->id;
											$rep->config=$_POST["reporte"];
											$rep->id_reporte=$idrep;
											$rep->fecha=date("Y-m-d H:i:s");
											$rep->save();										
										}	
 										$mensaje="El reporte ha sido actualizado";
										$estado=1;
										$idr_reporte=$idrep;
 									}else{
										$mensaje="El titulo para el reporte ya existe"; 
										$estado=0;
										$idr_reporte=null;
 									}
								}else{
 									$nombre=$this->escape($_POST["titulo"]);
									$dat = new CDbCriteria;
									$dat->condition = "id_usuario = ".(int)Yii::app()->user->id." and nombre='".$nombre."'";
									$testr=AnaReporte::model()->find($dat);
									if(!isset($testr->id) ){
										$repa = new AnaReporte;
										$repa->nombre=$nombre;
										$repa->id_usuario=(int)Yii::app()->user->id;
										$repa->config=$_POST["reporte"];
										$repa->fecha=date("Y-m-d H:i:s");
										$repa->save();
										
										$rep = new AnaReporteVersiones;
										$rep->nombre=$nombre;
										$rep->id_usuario=(int)Yii::app()->user->id;
										$rep->config=$_POST["reporte"];
										$rep->id_reporte=$repa->id;
										$rep->fecha=date("Y-m-d H:i:s");
										$rep->save();
 										$mensaje="El reporte ha sido guardado";
										$estado=1;
										$idr_reporte=$repa->id;
									}else{
										$mensaje="El titulo para el reporte ya existe ";
										$estado=0;
										$idr_reporte=null;
									}									
 								}
							}
							echo json_encode(array("estado"=>$estado,"mensaje"=>$mensaje,"id_reporte"=>$idr_reporte));
							exit;						
						break;
					}
				}
 				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				$dat = new CDbCriteria;
				$dat->condition = "id_usuario = ".(int)Yii::app()->user->id;
				$reportes=AnaReporte::model()->findAll($dat);
				//$aData["origenes"]=$this->encrypt(base64_encode(json_encode($this->getOrigenes())),$this->kp); 
				//$aData["origenesB"]=json_encode($this->getOrigenes()); 
				$aData["cubos"]=$this->getCubos(); 
				$aData["reportesusuario"]=$reportes; 
			//	printVar($aData["cubos"]);
				$aData["mensaje"]=$mensaje;
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 				$validaeditar=AnaUsuario::model()->vaidausr(false);	
				$this->_renderWrappedTemplate('reportes', 'index', $aData);
 			}
		}
    }
	public  function  dashboard(){
		Yii::app()->cache->flush();
	    
		if(isset(Yii::app()->user->id)){
			$mensaje=array();
			if((int)Yii::app()->user->id>0){ 
				 
 				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
 				$aData["idr"]=(int)$_GET["idr"];
				$dat = new CDbCriteria;
				$dat->condition = "id_usuario = ".(int)Yii::app()->user->id." and id=".$aData["idr"];
				$reportes=AnaReporte::model()->findAll($dat);
				//$aData["origenes"]=$this->encrypt(base64_encode(json_encode($this->getOrigenes())),$this->kp); 
				//$aData["origenesB"]=json_encode($this->getOrigenes()); 
				$aData["cubos"]=$this->getCubos(); 
				$aData["reportesusuario"]=$reportes; 				 
				 
			//	printVar($aData["cubos"]);
				
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 				$validaeditar=AnaUsuario::model()->vaidausr(false);	
				$this->_renderWrappedTemplate('reportes', 'dashboard', $aData);
 			}
		}
		
 	}
	public function getArchivoCubo($nombre_archivo){
		$file=$this->filesbi.$nombre_archivo.".cubo";
		$estado="NO";
		$datos=NULL;
 		if(file_exists($file))
		{
 			$datos=nl2br(file_get_contents($file));
   			fclose($file);
			$estado=true;
		}				
 		return array($estado,$datos);
 	}	
	
	
	
	public function getCubos($id=NULL,$query=""){
		$sql="";
		if((int)$id>0){
			$sql=" and id =".(int)$id;
		} 
		if($query!=""){
			$sql.=" and ".$query;
		}
		$dat = new CDbCriteria;
		$dat->condition = "id>0 ".$sql;
  		$cubos=AnaCubo::model()->findAll($dat);
		$newO=array();
		foreach($cubos as $k=>$v){
			$org=(object)array();
			foreach($v as $id=>$valor){
				$org->{$id}=$valor;
			}
 			array_push($newO,$org);
		}
		return $newO;
	} 
 	 
	
    public function escape($str)
    {
        if (is_string($str)) {
            $str = $this->escape_str($str);
        }
        elseif (is_bool($str))
        {
            $str = ($str === true) ? 1 : 0;
        }
        elseif (is_null($str))
        {
            $str = 'NULL';
        }

        return $str;
    }

    public function escape_str($str, $like = FALSE)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val)
            {
                $str[$key] = $this->escape_str($val, $like);
            }

            return $str;
        }

        // Escape single quotes
        $str = str_replace("'", "''", $this->remove_invisible_characters($str));

        return $str;
    }

    public function remove_invisible_characters($str, $url_encoded = TRUE)
    {
        $non_displayables = array();

        // every control character except newline (dec 10)
        // carriage return (dec 13), and horizontal tab (dec 09)

        if ($url_encoded) {
            $non_displayables[] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
            $non_displayables[] = '/%1[0-9a-f]/'; // url encoded 16-31
        }
        $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
         do
        {
            $str = preg_replace($non_displayables, '', $str, -1, $count);
        } while ($count);
        return $str;
    }	
     private function _getSurveyCountForUser(array $user)
    {
        return Survey::model()->countByAttributes(array('owner_id' => $user['uid']));
    }
	
    /**
    * Renders template(s) wrapped in header and footer
    *
    * @param string $sAction Current action, the folder to fetch views from
    * @param string|array $aViewUrls View url(s)
    * @param array $aData Data to be passed on. Optional.
    */
    protected function _renderWrappedTemplate($sAction = 'user', $aViewUrls = array(), $aData = array())
    {
        parent::_renderWrappedTemplate($sAction, $aViewUrls, $aData);
    }
	
}