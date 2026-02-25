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
						case "creargrafico":
							unset($_POST["option"]); 
							
							printVar($_POST);
							
							
							
							exit;
 						break;
						 
					}
				}
 				$oRecord = User::model()->findByPk(Yii::app()->user->id); 
				//$aData["origenes"]=$this->encrypt(base64_encode(json_encode($this->getOrigenes())),$this->kp); 
				//$aData["origenesB"]=json_encode($this->getOrigenes()); 
				$aData["cubos"]=$this->getCubos(); 
			//	printVar($aData["cubos"]);
				$aData["mensaje"]=$mensaje;
				$dUsuario = AnaUsuario::model()->findByPk($oRecord->iduseval);
 				$validaeditar=AnaUsuario::model()->vaidausr(false);	
				$this->_renderWrappedTemplate('reportes', 'index', $aData);
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