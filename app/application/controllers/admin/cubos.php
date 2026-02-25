<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
  
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Cubos extends Survey_Common_Action
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
	private function getOrigenes($id=NULL){
		$sql="";
		if((int)$id>0){
			$sql=" and id =".(int)$id;
		} 
		$dat = new CDbCriteria;
		$dat->condition = "id_usuario = ".Yii::app()->user->id.$sql;
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


	private function getCubos($id=NULL,$query=""){
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

 
	
	private function encrypt($data,$key){
		$mode = MCRYPT_MODE_CBC;
		$algorithm = MCRYPT_3DES;
  		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode),MCRYPT_DEV_URANDOM);
 		$encrypted_data = mcrypt_encrypt($algorithm, $key, date("Y-m-d")." ".$data." ", $mode, $iv);
		$plain_text = base64_encode($encrypted_data);		
 		return $plain_text;
	}

	private function  decrypt($data,$key){
		$mode = MCRYPT_MODE_CBC;
		$algorithm = MCRYPT_3DES;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode),MCRYPT_DEV_URANDOM);
  		$encrypted_data = base64_decode($data);
		$decoded = mcrypt_decrypt($algorithm, $key, $encrypted_data, $mode, $iv);
 		return $decoded;
 	}
  
 	private function getDecript($dato){
		$r=$this->decrypt($this->escape($dato),$this->kp);
		$decripted=explode(" ",$r);
		if(isset($decripted[1])){
			return base64_decode($decripted[1]);
		}else{return "error";}
	}	
	
	
	
	private function crearCubo($nombre_archivo,$datos){
		$file=$this->filesbi.$nombre_archivo.".cubo";
		$estado="NO";
 		if($archivo = fopen($file, "a"))
		{
			if(fwrite($archivo,$datos. "")){ 
				$estado=true;
			}else{
				$estado=false;
			}
 			fclose($archivo);
		}				
 		return $estado;
 	}
 	
	private function getArchivoCubo($nombre_archivo){
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

    public function index()
    {   Yii::app()->cache->flush();
 		if(isset(Yii::app()->user->id)){
			if((int)Yii::app()->user->id>0){ 
				if(isset($_POST["option"])){
					switch($_POST["option"]){
						case "tablas":
							$con=$this->getOrigenes((int)$_POST["id"]);
 							if(isset($con[0])){$con=$con[0];
								//echo $this->getDecript($con->origendedatos);exit;
								
								$objDb= new PDO('mysql:host='.$this->getDecript($con->ip).';port='.$con->puerto.';dbname='.$this->getDecript($con->origendedatos),$this->getDecript($con->usuario),$this->getDecript($con->password)  , array(PDO::ATTR_PERSISTENT => true));
								//sleep(1);
								$stmt = $objDb->prepare('show tables');
 								$test=$stmt->execute();	
								if($test==true){
									$tablas=$stmt ->fetchAll();
								}
								echo json_encode($tablas);
							}exit;
						break;
						case "guardar":
							 
 							$dimensiones=$_POST["tokenid"];
							$origen=$this->getOrigenes((int)$_POST["idorigen"]);
							$idorigen=(int)$_POST["idorigen"];
							$taiku=NULL;
							
							if(isset($origen[0]->id)){ 
								$key = $this->kp;
								//printVar($dimensiones);exit;
								$source=base64_encode(json_encode(array("idorigen"=>$origen[0]->id,"origen"=>$origen[0]->nombre,"tabla"=>$_POST["idtabla"],"dimensiones"=>"".$dimensiones."")));
 								$origentaiku=$this->encrypt($source,$key); 
 								$nombre=md5($this->escape($_POST["nombre"]));
								$r=$this->crearCubo($nombre,$origentaiku);
 								if($r==true){
									$tcubo=$this->getCubos(NULL," nombre='".$this->escape($_POST["nombre"])."' and id_usuario=".Yii::app()->user->id);
									if(!isset($tcubo[0]->id)){
										$cuboSet=new AnaCubo();
										$cuboSet->nombre=$this->escape($_POST["nombre"]);
										$cuboSet->id_origendatos=$origen[0]->id;
										$cuboSet->activo='1';
										$cuboSet->fecha=date("Y-m-d H:i:s");
										$cuboSet->fechamodificado=date("Y-m-d H:i:s");
										$cuboSet->id_usuario=Yii::app()->user->id;
										$cuboSet->save();
									}else{
										$set=AnaCubo::model()->findByPk($tcubo[0]->id);
										$set->fechamodificado=date("Y-m-d H:i:s");
										$set->save();
									}
 								}
								echo json_encode(array($r));
 							}
							
							exit;
						break;
						case "eliminar":
							$tcubo=$this->getCubos((int)$_POST["id"]," id_usuario=".Yii::app()->user->id);
							$estado=false;
							if(isset($tcubo[0]->id)){
								$nombrecubo=$tcubo[0]->nombre;
								$nombre=md5($this->escape($tcubo[0]->nombre));
								$file=$this->filesbi.$nombre.".cubo";
								$filedeleted=$this->filesbideleted.$nombre."_deleted.cubo";
								if(file_exists($file)){
									copy($file,$filedeleted);
									unlink($file);
									$set=AnaCubo::model()->findByPk($tcubo[0]->id); 
									$set->delete();
									$estado=true;
								}
							}
							echo json_encode(array($estado));exit;
						break;
						case "getcubo":
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
									$ndecoded=explode(" ",$this->decrypt($decoded,$key));//printVar($nombre);exit;   
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
						case "instanciar":
							$con=$this->getOrigenes((int)$_POST["id"]);
 							if(isset($con[0])){$con=$con[0];
								$objDb= new PDO('mysql:host='.$this->getDecript($con->ip).';port='.$con->puerto.';dbname='.$this->getDecript($con->origendedatos),$this->getDecript($con->usuario),$this->getDecript($con->password)  , array(PDO::ATTR_PERSISTENT => true));
								//sleep(1);
								$stmt = $objDb->prepare('show tables');
								$test=$stmt->execute();	
								$tablas=array();
								$temp=array();
								if($test==true){
									$tablas=$stmt ->fetchAll();	
									foreach($tablas as $k=>$tabla){
										foreach($tabla as $d){
											if(!in_array($d,$temp)){
												array_push($temp,$d);
											}
										}
										
									}
								}
								//printVar($this->escape($_POST["tabla"]),$_POST["tabla"]);
								if(in_array($this->escape($_POST["tabla"]),$temp)){
									$stmt = $objDb->prepare('describe  '.$this->escape($_POST["tabla"]));
									$test=$stmt->execute();	
									$instancia=NULL;
									$nInstancia=array();
									if($test==true){
										$instancia=$stmt ->fetchAll();
 										foreach($instancia as $in){
											$in["Type"]=$this->extracInstancia($in["Type"]);
											array_push($nInstancia,array("tipo"=>$in["Type"],"campo"=>$in["Field"]));
										}
									}
									
									echo json_encode($nInstancia);
								}
								
							}exit;
						
						break;
					}
				}
				$aData["origenes"]= $this->getOrigenes();
				$aData["cubos"]= $this->getCubos(null," id_usuario=".Yii::app()->user->id);
 				$validaeditar=AnaUsuario::model()->vaidausr(false);	
				$this->_renderWrappedTemplate('cubos', 'index', $aData);
				
			}
		}
    }
 	 
	 private function extracInstancia($ipo){
		 $n=explode("(",$ipo);
		 if(isset( $n[1])){
			$n=$n[0]; 
		 }else{
			 $n=$ipo;
		 }
		 return $n;
	 }
	
    private function escape($str)
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

    private function escape_str($str, $like = FALSE)
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

    private function remove_invisible_characters($str, $url_encoded = TRUE)
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