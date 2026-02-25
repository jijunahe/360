<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL); ini_set('display_errors', '1');
$documentroot=str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]);
require_once($documentroot.'application/extensions/PHPMailer/class.phpmailer.php');
 
require_once($documentroot.'application/extensions/class_sql_inject.php');
class Origenes extends Survey_Common_Action
{
 	public $kp='93857366asmdmfmm';
  	
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
	private function getOrigenes($id=NULL){
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
					}
				}
 				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				$aData["origenes"]=$this->getOrigenes(); 
				$aData["mensaje"]=$mensaje;
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 				$validaeditar=AnaUsuario::model()->vaidausr(false);	
				$this->_renderWrappedTemplate('origenes', 'index', $aData);
 			}
		}
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