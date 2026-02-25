<?php 
	
 //require_once($_SERVER["DOCUMENT_ROOT"]."/pdf/fpdf.php");
require_once(CLASS_DIR."class.db.php");
//error_reporting(E_ALL);
ini_set('display_errors', '0'); 
class Action{
	public $bdObj;
	public $id=214322;
	public $idempresa=NULL;
	
	public $eneltrabajo=array("214322X50X1405"=>0,"214322X50X1406"=>0,"214322X50X1407"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
	public $enelclimalaboral=array("214322X50X1409"=>0,"214322X50X1410"=>0,"214322X50X1411"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
	public $conmivida=array("214322X50X1413"=>0,"214322X50X1414"=>0,"214322X50X1415"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
	public $enlaorganizacion=array("214322X50X1417"=>0,"214322X50X1418"=>0,"214322X50X1419"=>0,"214322X50X1542"=>0,"total"=>0,"resultado"=>"","preguntas"=>4);
	public $preguntas=array("214322X50X1405","214322X50X1406","214322X50X1407","214322X50X1409","214322X50X1410","214322X50X1411","214322X50X1413","214322X50X1414","214322X50X1415","214322X50X1417","214322X50X1418","214322X50X1419","214322X50X1542");
	public $preguntas_key=array(
									"214322X50X1405"=>"eneltrabajo",
									"214322X50X1406"=>"eneltrabajo",
									"214322X50X1407"=>"eneltrabajo",
									"214322X50X1409"=>"enelclimalaboral",
									"214322X50X1410"=>"enelclimalaboral",
									"214322X50X1411"=>"enelclimalaboral",
									"214322X50X1413"=>"conmivida",
									"214322X50X1414"=>"conmivida",
									"214322X50X1415"=>"conmivida",
									"214322X50X1417"=>"enlaorganizacion",
									"214322X50X1418"=>"enlaorganizacion",
									"214322X50X1419"=>"enlaorganizacion",
									"214322X50X1542"=>"enlaorganizacion"
								);
	
	
  	public function __construct()
	{
		$this->bdObj=new db("mysql:host=".serverdb_link.";port=3306;dbname=".database_link,username_link ,password_link );
		if(isset($_GET["id"])){
			$this->idAnswer=(int)$_GET["id"];
		}
		 
		if(isset($_GET["idempresa"])){
			$this->idempresa=$_GET["idempresa"]; 
		}
		 
		 
 	}
	
 
	
	
	public function init(){
		$query=" 214322X50X1426<>''";
		if($this->idempresa!=NULL){ 
			$query=" 214322X50X1426='".$this->idempresa."'";
		}
			$test=$this->bdObj->select(PREFIJO_TABLAS."cubo_".$this->id,$query);
			if(isset($test[0]["idAnswer"])){
				$contador_eneltrabajo_t=0;
				$contador_enelclimalaboral_t=0;
				$contador_conmivida_t=0;
				$contador_enlaorganizacion_t=0;
				
				$acumulador_eneltrabajo_t=0;
				$acumulador_enelclimalaboral_t=0;
				$acumulador_conmivida_t=0;
				$acumulador_enlaorganizacion_t=0;
			
 				foreach($test as $data){
					$data=(object)$data;
					
					$contador_eneltrabajo=0;
					$contador_enelclimalaboral=0;
					$contador_conmivida=0;
					$contador_enlaorganizacion=0;
					
					$acumulador_eneltrabajo=0;
					$acumulador_enelclimalaboral=0;
					$acumulador_conmivida=0;
					$acumulador_enlaorganizacion=0;
					$rhis->eneltrabajo=array("214322X50X1405"=>0,"214322X50X1406"=>0,"214322X50X1407"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
					$rhis->enelclimalaboral=array("214322X50X1409"=>0,"214322X50X1410"=>0,"214322X50X1411"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
					$rhis->conmivida=array("214322X50X1413"=>0,"214322X50X1414"=>0,"214322X50X1415"=>0,"total"=>0,"resultado"=>"","preguntas"=>3);
					$rhis->enlaorganizacion=array("214322X50X1417"=>0,"214322X50X1418"=>0,"214322X50X1419"=>0,"214322X50X1542"=>0,"total"=>0,"resultado"=>"","preguntas"=>4);
 					
					foreach($data as $key=>$value){
 						
						if(in_array($key,$this->preguntas)){
							//$eneltrabajo,$enelclimalaboral, $conmivida,$enlaorganizacion
							$rt=number_format(((($value)/((int)$this->{$this->preguntas_key[$key]}["preguntas"]*10))*10),6);
							 
							if(isset($this->{$this->preguntas_key[$key]}[$key])){
								
								$this->{$this->preguntas_key[$key]}[$key]=$rt;
								${"acumulador_".$this->preguntas_key[$key]}+=$this->{$this->preguntas_key[$key]}[$key];
								//printVar(${"acumulador_".$this->preguntas_key[$key]},$this->preguntas_key[$key]);
								${"contador_".$this->preguntas_key[$key]}++;
								if(${"contador_".$this->preguntas_key[$key]}==(int)$this->{$this->preguntas_key[$key]}["preguntas"]){
									$this->{$this->preguntas_key[$key]}["total"]=round(${"acumulador_".$this->preguntas_key[$key]},1,PHP_ROUND_HALF_UP);
									if($this->{$this->preguntas_key[$key]}["total"]>=6 and $this->{$this->preguntas_key[$key]}["total"]<=10){
										$this->{$this->preguntas_key[$key]}["resultado"]="feliz";
									}else if($this->{$this->preguntas_key[$key]}["total"]<=5.9){
										$this->{$this->preguntas_key[$key]}["resultado"]="triste";
									}
								}
							} 
							 
						}						
  					}
					
					$contador_eneltrabajo_t+=$contador_eneltrabajo;
					$contador_enelclimalaboral_t+=$contador_enelclimalaboral;
					$contador_conmivida_t+=$contador_conmivida;
					$contador_enlaorganizacion_t+=$contador_enlaorganizacion;
					
					$acumulador_eneltrabajo_t+=round($acumulador_eneltrabajo,1,PHP_ROUND_HALF_UP);
					$acumulador_enelclimalaboral_t+=round($acumulador_enelclimalaboral,1,PHP_ROUND_HALF_UP);
					$acumulador_conmivida_t+=round($acumulador_conmivida,1,PHP_ROUND_HALF_UP);
					$acumulador_enlaorganizacion_t+=round($acumulador_enlaorganizacion,1,PHP_ROUND_HALF_UP);
 				
				
					
				} 
				$totales=count($test);
				
				$contador_eneltrabajo_t=($contador_eneltrabajo_t)/$totales;
				$contador_enelclimalaboral_t=($contador_enelclimalaboral_t)/$totales;
				$contador_conmivida_t=($contador_conmivida_t)/$totales;
				$contador_enlaorganizacion_t=($contador_enlaorganizacion_t)/$totales;
				
 				$acumulador_eneltrabajo_t=round(($acumulador_eneltrabajo_t/$totales),1,PHP_ROUND_HALF_UP);
				$acumulador_enelclimalaboral_t=round(($acumulador_enelclimalaboral_t/$totales),1,PHP_ROUND_HALF_UP);
				$acumulador_conmivida_t=round(($acumulador_conmivida_t/$totales),1,PHP_ROUND_HALF_UP);
				$acumulador_enlaorganizacion_t=round(($acumulador_enlaorganizacion_t/$totales),1,PHP_ROUND_HALF_UP);
			
 				$puntaje=round(($acumulador_eneltrabajo_t+$acumulador_enelclimalaboral_t+$acumulador_conmivida_t+$acumulador_enlaorganizacion_t)/4,1,PHP_ROUND_HALF_UP);

				
				$html='
				<center>
				<table border="0px">  
				  
				  <tr style="height: 70px;">
					  <td colspan="3"> </td>
				  </tr>
				  <tr style="height: 120px;">
					  <td style="width: 120px; background-color:#F8BD41;    padding: 3px;"><center><b  style="color:#fff;font-size: 25px;">CareE</b><br><b  style="color:#fff;font-size: 12px;">Tengo el control de mis emociones</b> <br><b style="color:#fff;font-size: 25px;">'.$acumulador_eneltrabajo_t.'</b></center> </td>
					  <td style="width: 120px;"></td>
					  <td style="width: 120px; background-color:#4892A7;    padding: 3px;"><center><b style="color:#fff;font-size: 25px;">CareGrow</b><br><b  style="color:#fff;font-size: 12px;">Puedo desarrollar mis fortalezas.</b> <br><b style="color:#fff;font-size: 25px;">'.$acumulador_enlaorganizacion_t.'</b></center> </td>
				  </tr>
				  <tr style="height: 120px;">
					  <td  style="width: 120px;"></td>
					  <td  style="width: 120px;background-color:#41719C;    padding: 3px;"><center><span style="color:#fff;font-size: 25px;"> <b>Índice de felicidad</b><br> <b>'.$puntaje.'</b></span></center></td>
					  <td  style="width: 120px;"></td>
				  </tr>
				   <tr style="height: 120px;">
					  <td style="width: 120px;background-color:#E94649;    padding: 3px;"><center><b style="color:#fff;font-size: 25px;" >CareJob</b><br><b style="color:#fff;font-size: 12px;">Me siento muy feliz con lo que hago</b><br><b style="color:#fff;font-size: 25px;">'.$acumulador_enelclimalaboral_t.'</b> </center></td>
					  <td  style="width: 120px;"></td>
					  <td style="width: 120px;background-color:#A6A6A6;    padding: 3px;"><center><b style="color:#fff;font-size: 25px;" >CareBiz</b><br><b style="color:#fff;font-size: 12px;">Me comprometo con la organización</b><br><b style="color:#fff;font-size: 25px;">'.$acumulador_conmivida_t.'</b> </center></td>
				  </tr>
				  
				   <tr style="height: 5px;">
					  <td colspan="3"> </td>
				  </tr>
				  </table></center>';
				
				//echo $html; 
   				//exit;
			 
				echo $_GET['callback']."(".json_encode(array("ok",$acumulador_eneltrabajo_t,$acumulador_enlaorganizacion_t,$acumulador_enelclimalaboral_t,$acumulador_conmivida_t,$puntaje)).");";exit;
			}
		/*}else{
			echo $_GET['callback']."(".json_encode(array("error","Ingrese codigo empresa")).");";exit;
		}*/
 	}
}