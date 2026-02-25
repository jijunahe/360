<?php
// error_reporting(E_ALL);
 //ini_set('display_errors', '3');

	if (!defined('BASEPATH')) exit('No direct script access allowed');
	require_once($_SERVER["DOCUMENT_ROOT"].'/PHPMailer/class.phpmailer.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/pdf/PDF_MC_Table.php');
	class Objetivos extends Survey_Common_Action
	{
		public $reportePDF;
		function __construct($controller, $id)
		{
			parent::__construct($controller, $id);
			
			Yii::app()->loadHelper('database');
			$this->reportePDF = new PDF_MC_Table();
			//printVar($this->reportePDF->AddPage());
		}
		
		
		/**
			* Show users table
		*/
		public function index()
		{
			//printVar($_SERVER[DOCUMENT_ROOT]);
			
			$aData=array();
			
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["rbase"]="/evalGenserbeta/";
			
			$this->_renderWrappedTemplate('objetivos', 'index', $aData);
			
		}
		
		
	function crearReportePDF($nombreUsuario, $nombreJefe, $fechaEnvio,$idUsuario, $idPeriodo, $idTrimestre) {
           
		    $actividad = EvalActividad::model()->obtenerReporteActividad($idUsuario, $idPeriodo, $idTrimestre);
			
			$tempRetro = new CDbCriteria;
			$tempRetro->condition = 'idUsuario='.$idUsuario.'  and idTrimestre='. $idTrimestre;
			$rTempRetro = EvalRetroalimentacion::model()->findAll($tempRetro); 	


			$tempObj = new CDbCriteria;
			$tempObj->condition = 'idRetroalimentacion='.$rTempRetro[0]->idRetroalimentacion;
			$rObj = EvalObjetivo::model()->findAll($tempObj); 	

			$tempG = new CDbCriteria;
			$tempG->condition = 'idRetroalimentacion='.$rTempRetro[0]->idRetroalimentacion;
			$rG = EvalGestionjefe::model()->findAll($tempG); 	

			$tempAc = new CDbCriteria;
			$tempAc->condition = 'idRetroalimentacion='.$rTempRetro[0]->idRetroalimentacion;
			$rAc = EvalActitud::model()->findAll($tempAc);
			 
            $this->reportePDF->AddPage();
            $this->reportePDF->SetFont('Arial','',8);
            $this->reportePDF->SetY(10);
            $this->reportePDF->SetX(50);
            $this->reportePDF->Cell(40,10,'Genser-REPORTE DE CREACION DE OBJETIVOS Y RETROALIMENTACION JEFE-COLABORADOR.');
            $this->reportePDF->SetX(150);
            $this->reportePDF->SetY(20);
            $this->reportePDF->Cell(40,10,'Fecha: '.$fechaEnvio);
            $this->reportePDF->SetY(30);
            $this->reportePDF->Cell(40,10,'Usuario: '.$nombreUsuario);
            $this->reportePDF->SetY(40);
            $this->reportePDF->Cell(40,10,'Jefe: '.$nombreJefe);
            $this->reportePDF->SetY(50);
            $this->reportePDF->Cell(40,10,'RETROALIMENTACION CUALITATIVA JEFE-COLABORADOR');
            $this->reportePDF->SetY(60);
            $this->reportePDF->SetWidths(array(30,30,30,30,30,30));
            $this->reportePDF->Row(array("CONTINUAR", "INICIAR", "ASPECTOS QUE NO ESTAN FUNCIONANDO", "COMPORTAMIENTOS NUEVOS", "RETROALIMENTACION FORTALEZAS-JEFE", "RETROALIMENTACION AREAS DE OPORTUNIDAD-JEFE"));
            $this->reportePDF->SetWidths(array(30,30,30,30,30,30));
           
		   $this->reportePDF->Row(array(utf8_decode($rObj[0]->textoObjetivo),
                    utf8_decode($rObj[1]->textoObjetivo),
					utf8_decode($rAc[0]->textoActitud), 
                    utf8_decode($rAc[0]->textoReemplazo), 
                    utf8_decode($rG[0]->textoGestion), 
                     utf8_decode($rG[0]->textoAreaOportunidad)));
            $this->reportePDF->AddPage();
            $this->reportePDF->SetFont('Arial','',8);
            $this->reportePDF->SetY(10);
            $this->reportePDF->SetX(50);
            $this->reportePDF->Cell(40,10,'Genser-REPORTE DE CREACION DE OBJETIVOS Y RETROALIMENTACION JEFE-COLABORADOR.');
            $this->reportePDF->SetX(150);
            $this->reportePDF->SetY(20);
            $this->reportePDF->Cell(40,10,'Fecha: '.$fechaEnvio);
            $this->reportePDF->SetY(30);
            $this->reportePDF->Cell(40,10,'Usuario: '.$nombreUsuario);
            $this->reportePDF->SetY(40);
            $this->reportePDF->Cell(40,10,'Jefe: '.$nombreJefe);
            $this->reportePDF->SetY(50);
            $this->reportePDF->Cell(40,10,'REPORTE OBJETIVOS PLANTEADOS');
            $this->reportePDF->SetY(60);
            $this->reportePDF->SetWidths(array(30,65,65,20,10));
            $this->reportePDF->Row(array("Trimestre", "Objetivo", "Actividad", "Fecha Fin", "Peso"));
        $this->reportePDF->SetWidths(array(30,65,65,20,10));
        for($i=0;$i<count($actividad);$i++) {
             $this->reportePDF->Row(array($actividad[$i]->trimestre, $actividad[$i]->objetivo, $actividad[$i]->texto, $actividad[$i]->fechaFin, $actividad[$i]->peso));
        }
		 
         $textoReporte = $this->reportePDF->Output("reporte.pdf","S"); 
         return $textoReporte;
     }		
		
 		
		function enviarCorreo($correoTo, $cuerpo, $titulo){
			$mail = new PHPMailer ();
			$mail -> From = "System Talentracking";
			$mail -> FromName = "Sistema de evaluaciones";
			$mail -> AddAddress ($correoTo);
			$mail -> Subject = $titulo;
			$mail -> Body = $cuerpo;
			$mail -> IsHTML (true);
			
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465;
			$mail->Username = 'evaluacionGenser@correotalentracking.com';
			$mail->Password = 'jamahure123';
			
			if(!$mail->Send()) {
				return 'Error: ' . $mail->ErrorInfo;
				}else{
				return 'Correo enviado!';
			}
			
		}
		
		private function enviarCorreoReporte($correoJefe, $correoUsuario, $body, $reporte) {
		
			$mail = new PHPMailer();  // create a new object
			$mail -> From = "Administrador Talentracking";
			$mail -> FromName = "Sistema de evaluaciones";
			//$mail -> AddAddress ("siscore.soluciones@gmail.com");
			$mail -> AddAddress ("system@correotalentracking.com");
			$mail -> AddAddress ($correoJefe);
			$mail -> AddAddress ($correoUsuario);
			$mail -> Subject = "Reporte Creacion de Objetivos";
			$mail -> Body = $body;
			//$mail->AddAttachment($reporte, "reporte.pdf");
			//$mail->AddStringAttachment($reporte, "reporte.pdf", "base64", "application/octet-stream");
			$mail->AddStringAttachment($reporte, "reporte.pdf", "base64", "application/pdf");
			$mail -> IsHTML (true);
			
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true;  // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465; 
			$mail->Username = "system@correotalentracking.com";  
			$mail->Password = "jamahure4";           
			if(!$mail->Send()) {
				$error = 'Mail error: '.$mail->ErrorInfo; 
				return false;
				} else {
				//		$error = 'Message sent!';
				//		echo "El mensaje se ha enviado con exito a: ".$correoUsuario." y ".$correoJefe;
				return true;
			}
			
		}
		
		function seguimiento(){
			App()->getClientScript()->registerScriptFile(Yii::app()->getConfig('adminscripts')."Highcharts-2.2.0/js/highcharts.js");
 		
			$u = new CDbCriteria;
			$u->select="iduseval";
			$u->condition = 'uid='.(int)$_SESSION["loginID"];
			$ru = User::model()->find($u);		
			$datosc =EvalUsuarios::model()->selectUsuarioById($ru->iduseval); 
			
			$temJf = new CDbCriteria;
			$temJf->condition = 'id_evaludo='.$ru->iduseval.' and tipo=3';
			$temJf->order = 'id ASC';
			$rTJf= EvalEvaluadores::model()->findAll($temJf); 			 
			
			$temCargo = new CDbCriteria;
			$temCargo->condition = 'id='.$datosc->id_cargo;
 			$rCargo= EvalCargos::model()->find($temCargo); 			 
			
			$temTrimestre = new CDbCriteria;
  			$rTrimestre= EvalTrimestre::model()->findAll($temTrimestre); 			 
			
			$datosjefe=NULL;
			if(isset($rTJf[0]->id_evaluador)){
				$mJF = new CDbCriteria;
				$mJF->condition = 'id='.$rTJf[0]->id_evaluador;
				$rJf= EvalUsuarios::model()->find($mJF); 
				$datosjefe=$rJf;
			}				
			
			$aData["idU"]=$ru->iduseval;
			$aData["idJefe"]=$datosjefe->id;
			$aData["correoUsuario"]=$datosc->email;
			$aData["correoJefe"]=$datosjefe->email;
			$aData["nombreJefe"]=$datosjefe->nombres." ".$datosjefe->apellidos;
			$aData["nombreUsuario"]=$datosc->nombres." ".$datosc->apellidos;
			$aData["idCargo"]=$datosc->id_cargo;
			$aData["nombreCargo"]=$rCargo->nombre;
			$aData["numeroJefes"]=count($rTJf);
 			$aData["objetivosOperacionales"]= 1;
			
			$acumulado=array();
			$datosResumen=array();
			$totalCumplido=0;
			foreach($rTrimestre as $datosTrimestre){
 				$idTrimestre= $datosTrimestre->idTrimestre;
				$fechaFinTrimestre= $datosTrimestre->fechaFinTrimestre;

				$temActividad = new CDbCriteria;
  				$temActividad->condition = 'idTrimestre='.$idTrimestre.' and idUsuario='.$datosc->id;
 				$rActividad= EvalActividad::model()->findAll($temActividad); 
				$suma=0;
				$totalCompetencias=0;
				foreach($rActividad as $acum){
 					$suma+=$acum->porcentajeCumplidoActividad;
					$totalCompetencias++;
				}
				$datoT=NULL;
				$datoT->nombreTrimestre=$datosTrimestre->nombreTrimestre;
				$datoT->periodoTrmiestre=$datosTrimestre->fechaInicioTrimestre." a ".$datosTrimestre->fechaFinTrimestre;
				$datoT->totalCompetencias=$totalCompetencias;
				$datoT->totalCumplimiento=$suma;
				$totalCumplido+=$suma;
				array_push($acumulado,$suma);
				array_push($datosResumen,$datoT);

 			}
			$aData["rbase"]="/evalGenserbeta/";
			$aData["imageurl"]="/evalGenserbeta/img/";
 			$aData["totalCumplido"]=$totalCumplido;
			$aData["datosArray"]=$acumulado;
			$aData["datosResumen"]=$datosResumen;
			$aData["rTrimestre"]=$rTrimestre;
 			
			$this->_renderWrappedTemplate('objetivos', 'seguimiento', $aData);
		}
			
		
 		function AjaxAcciones(){
			
			$op="";
			if(isset($_POST["fijar"])){
				$op="fijar";
			}
			if(isset($_POST["nuevoobjetivo"])){
				$op="nuevoobjetivo";
			}
			
			if(isset($_POST["paramcom"])){
				$op="paramcom";
			}
			
			if(isset($_POST["retroalimentar"])){
				$op="retroalimentar";
			}
			
			if(isset($_POST["notificar"])){
				$op="notificar";
			}
			
			if(isset($_POST["geac"])){
				$op="geac";
			}
			
			if(isset($_POST["actualizaseguimiento"])){
				$op="actualizaseguimiento";
			}
			
			if(isset($_POST["trimestre"])){
				$tri = new CDbCriteria;
				$tri->condition = 'idTrimestre='.(int)$_POST["trimestre"];
				$rTrip = EvalTrimestre::model()->find($tri);
			}
			
			$u = new CDbCriteria;
			$u->select="iduseval";
			$u->condition = 'uid='.(int)$_SESSION["loginID"];
			$ru = User::model()->find($u);
			$cookie=Yii::app()->request->cookies['YII_CSRF_TOKEN']->value;
			switch($op){
				case "actualizaseguimiento":
				
					$contador=1;
					foreach($_POST as $key=>$dato){
						$itemKey=explode("_",$key);
 						if(isset($itemKey[1])){
 							if($itemKey[0]=="seguimientoText"){
											 
								$temAcc = new CDbCriteria;
								$temAcc->condition = 'idUsuario='.$ru->iduseval.' and idTrimestre='.(int)$_POST["trimestre"].' and porcentajeCumplidoActividad=0 and idActividad='.(int)$itemKey[1];
 								$rAcc = EvalActividad::model()->find($temAcc);
  								$rAcc->porcentajeCumplidoActividad=(int)$dato;
 								$rAcc->save();
								 
							}
						}
					}
					echo "OK";
				
 				break;
				case "geac":
					$temAcc = new CDbCriteria;
 					$temAcc->condition = 'idUsuario='.$ru->iduseval.' and idTrimestre='.(int)$_POST["trimestre"];
 					$rAcc = EvalActividad::model()->findAll($temAcc);
					$html=preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post',array("id"=>"FormConfig")));
 					$html.='<table width="100%" border="0" class="tbrepor1" cellpadding="2" cellspacing="0">
						<tbody>
							<tr style="background-color: #F2F2F2">
								<td width="7%" style="color:#1F497D;font-weight:bold;text-align: center;">
								Trimestre</td>
								<td width="10%" style="color:#1F497D;font-weight:bold;text-align: center;">
									Fecha fin</td>
								<td width="58%" style="color:#1F497D;font-weight:bold;text-align: center;">
								Descripcion detallada de la actividad</td>
								<td width="10%" style="color:#1F497D;font-weight:bold;text-align: center;">
								Porcentaje Asignado</td>
								<!--td width="5%" style="color:#1F497D;font-weight:bold;text-align: center;">
								Cumplio Actividad</td-->
								<td width="10%" style="color:#1F497D;font-weight:bold;text-align: center;">
								Porcentaje Cumplimiento</td>
							</tr>';
							$contador=0;
						foreach($rAcc as $dato){		
							$color='style="background-color: #F2F2F2"';
							if($contador%2==0){$color='';}$contador++;
							$html.='<tr '.$color.'>
								<td width="7%">
								'.$dato->idTrimestre.'</td>
								<td width="10%">
								'.$dato->fechaCumplimientoActividad.'</td>
								<td width="58%">
								'.$dato->textoActividad.'</td>
								<td width="10%">
								'.$dato->porcentajeAsignadoActividad.'%</td>
								<!--td width="5%">
									<input type="checkbox" name="seguimiento_'.$dato->idActividad.'">
								</td-->
								<td width="10%">';
									if($dato->porcentajeCumplidoActividad>0){$html.=$dato->porcentajeCumplidoActividad."%";}else{
										$html.='<input type="text"  name="seguimientoText_'.$dato->idActividad.'_'.$dato->porcentajeAsignadoActividad.'" value="0" maxlength="3" size="3">';
									}
								$html.='</td>
							</tr>';
						}		 
								$html.='<tr>
									<td colspan="6">
										<input type="button" name="terminarSeguimientoBTN"  value="Terminar">
									</td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="trimestre" value="'.$dato->idTrimestre.'" >
						<input type="hidden" name="actualizaseguimiento" >
						</form>';					
								
					echo $html;
 				
				
				break;
				case "notificar":
				$contador=1;
				foreach($_POST as $key=>$dato){
					$itemKey=explode($cookie,$key);
					
					if(isset($itemKey[1])){
						if($itemKey[0]=="correoUsuario" or $itemKey[0]=="correoJefe"){
							${"email".$contador}=$dato;
							$contador++;	
						}
					}
				}
				
				if($contador==3){
					 
					$datosc =EvalUsuarios::model()->selectUsuarioById($ru->iduseval); 
					 
					 
					$temJf = new CDbCriteria;
					$temJf->condition = 'id_evaludo='.$ru->iduseval.' and tipo=3';
					$temJf->order = 'id ASC';
					$rTJf= EvalEvaluadores::model()->find($temJf); 			 
					
					$datosjefe=NULL;
					if(isset($rTJf->id_evaluador)){
						$mJF = new CDbCriteria;
						$mJF->condition = 'id='.$rTJf->id_evaluador;
						$rJf= EvalUsuarios::model()->find($mJF); 
						$datosjefe=$rJf;
					}				
				
					$fechaEnvio = date("Y-m-d H:i:s");
					$reporte=$this->crearReportePDF($datosc->nombres." ".$datosc->apellidos, $datosjefe->nombres." ".$datosjefe->apellidos, $fechaEnvio,$datosc->id, $rTrip->idPeriodo, $rTrip->idTrimestre);
					$this->enviarCorreoReporte($email1, $email2,  "Reporte creacion objetivos", $reporte);
					$model=new EvalReporteobjetivo;
					$model->fechaEnvio=$fechaEnvio;
					$model->idUsuario=$datosc->id;
					$model->idJefe=$datosjefe->id;
					$model->tipoReporte=1;
					$model->idTrimestre=$rTrip->idTrimestre;
					$model->idPeriodo=$rTrip->idPeriodo;
					$model->save();
					echo "OK";
				}
				exit;
				break;
				
				case "retroalimentar":
				$model=new EvalRetroalimentacion;
				$model->idUsuario=$ru->iduseval;
				$model->idTrimestre=(int)$_POST["trimestre"];
				$model->tipoRetroalimentacion=1;
				$model->grabado=0;
				$model->fecha=date("Y-m-d H:i:s");
				$model->save();
				unset($model);
				$idRetroalimentacion = getLastInsertID("{{eval_retroalimentacion}}");
				foreach($_POST as $key=>$dato){
					$itemKey=explode($cookie,$key);
					if(isset($itemKey[0])){
						$identificador=$itemKey[0];
						if($identificador=="continuarText" or $identificador=="iniciarText"){
							$tipoObj=2;
							if($identificador=="continuarText"){$tipoObj=1;}
							$model=new EvalObjetivo;
							$model->textoObjetivo=trim($dato);
							$model->tipoObjetivo=$tipoObj;
							$model->idRetroalimentacion=$idRetroalimentacion;
							$model->tipoRetroalimentacion=1;
							$model->save();
							unset($model);
						}
						
						if($identificador=="pararCol1Text"){
							$tipoAc=2;
							if($identificador=="pararCol1Text"){$tipoAc=1;}
							$model=new EvalActitud;
							$model->textoActitud=trim($dato);
							$model->tipoActitud=0;
							$model->idRetroalimentacion=$idRetroalimentacion;
							$model->tipoRetroalimentacion=1;
							$model->textoReemplazo=trim($_POST["pararCol2Text".$cookie]);
							$model->save();
							unset($model);
						}
						if($identificador=="retFortalezaText"){
							$model=new EvalGestionjefe;
							$model->textoGestion=trim($dato);
							$model->tipoGestion=0;
							$model->idJefe=0;
							$model->idRetroalimentacion=$idRetroalimentacion;
							$model->tipoRetroalimentacion=1;
							$model->textoAreaOportunidad=trim($_POST["retOportunidadText".$cookie]);
							$model->save();
							unset($model);
						}
						
					}
				}
				echo "OK";
				exit;
				break;
				case "paramcom":
				
				//printVar($_POST);
				//   "R-"+data.idTrimestre+"-"+data.idComportamiento+"-0-"
				$r=false;
				foreach($_POST["index".$cookie] as $key=>$dato){
					list($tipo,$idTrimestre,$idComportamiento,$idCompetencia,$idCriterio,$null)=explode("-",$dato);
					if($tipo=="D"){
						$tipo="DESARROLLO";
						}else{
						$tipo="RESULTADOS";
					}
					//printVar($tipo."-".$idTrimestre."-".$idComportamiento."-".$idCompetencia."-".$idCriterio."-".$null);
					$actividad=$_POST["actividad".$cookie][$key];
					$peso=$_POST["peso".$cookie][$key];
					$fechaFinTrimestre=$rTrip->fechaFinTrimestre;
					$idPeriodo=$rTrip->idPeriodo;
					
					$model=new EvalActividad;
					$model->textoActividad=trim($actividad);
					$model->fechaCumplimientoActividad=$fechaFinTrimestre;
					$model->porcentajeAsignadoActividad=$peso;
					$model->porcentajeCumplidoActividad=0;
					$model->actividadCumplida=0;
					$model->idUsuario=$ru->iduseval;
					$model->idComportamiento=$idComportamiento;
					$model->idCompetencia=$idCompetencia;
					$model->idTrimestre=$idTrimestre;
					$model->idPeriodo=$idPeriodo;
					$model->correoEnviado=0;
					$model->actividadGrabada=0;
					$model->idCriterio=$idCriterio;
					$model->tipo=$tipo;
					$r=$model->save();
				}
				if($r){
					echo "OK";
					}else{
					echo "NO";
				}
				exit;
				break;
				case "nuevoobjetivo":
				$model = new EvalComportamiento;
				$model->textoComportamiento=trim($_POST["comportamiento"]);
				$model->comportamientoSeleccionado=1;
				$model->idUsuario=$ru->iduseval;
				$model->idTrimestre=(int)$_POST["trimestre"];
				$model->idPeriodo=$rTrip->idPeriodo;
				$model->idCompetencia=0;
				$model->idCriterio=0;
				$model->tipoComportamiento="RESULTADOS";
				$res=$model->save();
				//printVar($model);exit;
				if($res){
					
					$ult = new CDbCriteria;
					$ult->order = "idComportamiento DESC";
					$ultr = EvalComportamiento::model()->find($ult); 			
					
					$arrayres=(object)array("idComportamiento"=>$ultr->idComportamiento,"idTrimestre"=>(int)$_POST["trimestre"],"res"=>"ok","fechaFinTrimestre"=>$rTrip->fechaFinTrimestre,"texto"=>trim($_POST["comportamiento"]),"nombreTrimestre"=>$rTrip->nombreTrimestre );
					echo json_encode($arrayres);
					
					} else{
					
					$arrayres=(object)array("res"=>"no");
					echo json_encode($arrayres);
				}
				
				exit;
				break;
				
				case "fijar":
				$guarda="OK";
				$critsComps=$this->criscromps();
				
				for($i=0;$i<count($_POST["fijar"]);$i++){
					list($idRangoCompetencia,$idCriterio)=explode("||",$_POST["fijar"][$i]);
					$tri = new CDbCriteria;
					$tri->condition = 'idUsuario='.$ru->iduseval.' and idTrimestre='.(int)$_POST["trimestre"].' and idCompetencia='.(int)$idRangoCompetencia.'  and idCriterio='.(int)$idCriterio.' and idPeriodo='.$rTrip->idPeriodo;
					$rTri = EvalComportamiento::model()->find($tri); 
					
					if(!isset($rTri->idUsuario)){
						$id= EvalComportamiento::model()->insertarComportamiento($ru->iduseval, (int)$idRangoCompetencia,(int)$_POST["trimestre"], $rTrip->idPeriodo, $idCriterio,"DESARROLLO",$critsComps[0][(int)$_POST["fijar"][$i]]); 
						}else{
						$guarda.=" No guardo ".(int)$_POST["fijar"][$i]."<br>";
					}
				}
				echo $guarda;
				exit;
				break;
			}
		}
		
		function compararFechas($fecha1, $fecha2) {
			$comparador;
			$date1 = explode("-", $fecha1); 
			$date2 = explode("-", $fecha2); 
			
			$tmpDate1 = new DateTime();
			$tmpDate2 = new DateTime();
			
			//        $tmpDate1->setDate($year, $month, $day);
			
			$tmpDate1->setDate($date1[0], $date1[1], $date1[2]);
			$tmpDate2->setDate($date2[0], $date2[1], $date2[2]);
			
			// SI FECHA 1 ES MAYOR QUE FECHA 2 RETORNA 1
			if($tmpDate1 > $tmpDate2)
			{
				$comparador = 1;
				
			}
			// SI FECHA 1 ES MENOR QUE FECHA 2 RETORNA -1
			else if($tmpDate1 < $tmpDate2)
			{
				$comparador = -1;
			}
			// SI FECHA 1 ES IGUAL QUE FECHA 2 RETORNA 0
			else
			{
				$comparador = 0;
			}
			//        echo "RESULTADO COMPARADOR FECHAS: ".$comparador."<br>";
			return $comparador;
		}
		
		function criscromps(){
			
			$u = new CDbCriteria;
			$u->select="iduseval";
			$u->condition = 'uid='.(int)$_SESSION["loginID"];
			$ru = User::model()->find($u); 		 
			
			
			$datosc =EvalUsuarios::model()->selectUsuarioById($ru->iduseval); 
			$numJefes =$datosc->numeroJefes;
			$idUsuario =$ru->iduseval;
			
			$per=EvalPeriodos::model()->selectLastPeriodoActivo()->id;
			$critsComps = EvalCriterios::model()->selectTiposCriteriosOfCargo($datosc->id_cargo);	
			
			
			$resAutTemp = $this->selectRespuestasEvalAuto((int)$idUsuario,(int)$per);
			$resAut=NULL;$resAutOb=NULL;
			if(isset($resAutTemp[0])){$resAut=$resAutTemp[0];if(isset($resAutTemp[1][1])){$resAutOb=implode(", ",$resAutTemp[1]);}else{$resAutOb=$resAutTemp[1][0];}}
			
			$resJesTemp = $this->selectRespuestasEvalEvaluadores((int)$idUsuario,(int)$per,3);
			$resJes=NULL;$resJesOb=NULL;
			if(isset($resJesTemp[0])){$resJes=$resJesTemp[0];if(isset($resJesTemp[1][1])){$resJesOb=implode(", ",$resJesTemp[1]);}else{$resJesOb=$resJesTemp[1][0];}}
			
			$resParTemp = $this->selectRespuestasEvalEvaluadores((int)$idUsuario,(int)$per,2);
			$resPar=NULL;$resParOb=NULL;
			if(isset($resParTemp[0])){$resPar=$resParTemp[0];if(isset($resParTemp[1][1])){$resParOb=implode(", ",$resParTemp[1]);}else{$resParOb=$resParTemp[1][0];}}
			
			
			$resColTemp = $this->selectRespuestasEvalEvaluadores((int)$idUsuario,(int)$per,4);
			$resCol=NULL;$resColOb=NULL;
			if(isset($resColTemp[0])){$resCol=$resColTemp[0];if(isset($resColTemp[1][1])){$resColOb=implode(", ",$resColTemp[1]);}else{$resColOb=$resColTemp[1][0];}}
			$fd=array();
			
			$tEvals = array();
			$dd = NULL; $dd->nom = "Auto"; $dd->col = "resa"; $dd->por = 0;
			$dd->obs = $resAutOb;
			array_push($tEvals, $dd);
			if(count($datosc->jefes) > 0){
				$dd = NULL; $dd->nom = "Jefe"; $dd->col = "resj"; $dd->por = 0;
				$dd->obs = $resJesOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->evals) > 0){
				$dd = NULL; $dd->nom = "Pares"; $dd->col = "resp"; $dd->por = 0;
				$dd->obs = $resParOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->colas) > 0){
				$dd = NULL; $dd->nom = "Colaboradores"; $dd->col = "resc"; $dd->por = 0;
				$dd->obs = $resColOb;
				array_push($tEvals, $dd);
			}
			
			if(count($datosc->jefes) > 0 && count($datosc->evals) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.20;
				$tEvals[1]->por = 0.40;
				$tEvals[2]->por = 0.20;
				$tEvals[3]->por = 0.20;
				}else if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
				}else if(count($datosc->jefes) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
				}else{
				$tEvals[0]->por = 0.40;
				$tEvals[1]->por = 0.60;
			}		
			
			for($i=0; $i<count($critsComps); $i++){
				$cris = $critsComps[$i]->cris;
				$crt_id = $critsComps[$i]->crt_id;
				for($j=0; $j<count($cris); $j++){
					$inds = $cris[$j]->inds;
					$cr_id = $cris[$j]->cr_id;
					$mejo = "-1";
					$fort = "-1";
					$cris[$j]->mejo = "";
					$cris[$j]->fort = "";
					$oportunidadesMejora = array();
					$t = 0;
					for($k=0; $k<count($inds); $k++)
					{
						$co_id = $inds[$k]->co_id;
						
						
						
						$find = false;
						for($m=0; $m<count($resAut); $m++){
							$resa = $resAut[$m];
							if($resa->crt_id == $crt_id && $resa->cr_id == $cr_id && $resa->co_id == $co_id){
								$find = true;
								break;
							}
						}
						// si se encuetra la posicion se asignan las respuesttas			
						if($find){
							$inds[$k]->resa = $resAut[$m]->cal;
							$inds[$k]->resj = $resJes[$m]->cal;
							$inds[$k]->resp = $resPar[$m]->cal;
							$inds[$k]->resc = $resCol[$m]->cal;
							$prom = 0;
							$vaaan = 0;
							for($m=0; $m<count($tEvals); $m++){
								if($tEvals[$m]->col == "resa"){
									//$prom += $inds[$k]->resa;
									//$vaaan++;
									$prom += $inds[$k]->resa*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resj"){
									//$prom += $inds[$k]->resj;
									//$vaaan++;
									$prom += $inds[$k]->resj*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resp"){
									//$prom += $inds[$k]->resp;
									//$vaaan++;
									$prom += $inds[$k]->resp*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resc" && ($crt_id*1) != $parTec){
									//$prom += $inds[$k]->resc;
									//$vaaan++;
									$prom += $inds[$k]->resc*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resc" && ($crt_id*1) == $parTec){
									if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
										$prom = $inds[$k]->resa*0.25;
										$prom += $inds[$k]->resj*0.50;
										$prom += $inds[$k]->resp*0.25;
										}else{
										$prom = $inds[$k]->resa*0.40;
										$prom += $inds[$k]->resj*0.60;
									}
								}
							}
							/*
								if($prom > 0){
								$prom =  round ($prom / $vaaan, 2);
								}
							*/
							$inds[$k]->prom = $prom;
							$aaa = EvalComportamientos::model()->selectResumenGeneralByComportamiento2($co_id, round($prom, 1));
							$strtemp = "";
							if(isset($aaa->texto)){
								//					$strtemp = "<li>".$aaa."</li>";
								$strtemp = $aaa->texto."||".$aaa->id;
								$fd[0][$aaa->id]=$aaa->texto;
							}
							if($prom > 7.9){
								$fort.=" ".$strtemp;
								$fd[1][$aaa->id]=$aaa->texto;
								}else{
								$t++;
								$mejo.="&".$strtemp;
								array_push($oportunidadesMejora, $strtemp);
							}
						}
					}
					$cris[$j]->mejo = ("");
					$cris[$j]->fort = ("");
					if(trim($mejo) != "-1"){
						$cris[$j]->mejo = str_replace("-1","",$mejo);
					}
					if(trim($fort) != "-1"){
						$cris[$j]->fort = str_replace("-1","",$fort);
					}
				}
			}
			return $fd;
		}
		
		function trimestreFuncional(){
 			$aData=array();	
			$file=Yii::app()->getConfig('adminscripts')."colorbox/example1/colorbox.css";
			$cs=Yii::app()->clientScript;
			$cs->registerCssFile($file);		
			
			App()->getClientScript()->registerScriptFile(Yii::app()->getConfig('adminscripts')."colorbox/jquery.colorbox-min.js");
			App()->getClientScript()->registerScriptFile(Yii::app()->getConfig('adminscripts')."Highcharts-2.2.0/js/highcharts.js");
			$parTec= EvalParametros::model()->selectParametroInt('idCriteriosTecnicos');
			$colors = array("#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92");
			
			
			$u = new CDbCriteria;
			$u->select="iduseval";
			$u->condition = 'uid='.(int)$_SESSION["loginID"];
			$ru = User::model()->find($u); 		 
			
			
			$datosc =EvalUsuarios::model()->selectUsuarioById($ru->iduseval); 
			$numJefes =$datosc->numeroJefes;
			$idUsuario =$ru->iduseval;
			
			$per=EvalPeriodos::model()->selectLastPeriodoActivo()->id;
			$critsComps = EvalCriterios::model()->selectTiposCriteriosOfCargo($datosc->id_cargo);
			
			$idJefe = $datosc->idJefeFuncional;
			
			
			$temJf = new CDbCriteria;
			$temJf->condition = 'id_evaludo='.$idUsuario.' and tipo=3';
			$temJf->order = 'id ASC';
			$rTJf= EvalEvaluadores::model()->find($temJf); 			 
			
			$datosjefe=NULL;
			if(isset($rTJf->id_evaluador)){
				$mJF = new CDbCriteria;
				$mJF->condition = 'id='.$rTJf->id_evaluador;
				$rJf= EvalUsuarios::model()->find($mJF); 
				$datosjefe=$rJf;
			}		
			
			
			$tri = new CDbCriteria;
			$tri->select="nombreTrimestre,idTrimestre";
			$tri->condition = 'idPeriodo='.$per;
			$rTri = EvalTrimestre::model()->findAll($tri); 		 
			
			$resAutTemp = $this->selectRespuestasEvalAuto((int)$idUsuario,(int)$per);
			$resAut=NULL;$resAutOb=NULL;
			if(isset($resAutTemp[0])){$resAut=$resAutTemp[0];if(isset($resAutTemp[1][1])){$resAutOb=implode(", ",$resAutTemp[1]);}else{$resAutOb=$resAutTemp[1][0];}}
			
			$resJesTemp = $this->selectRespuestasEvalEvaluadores((int)$idUsuario,(int)$per,3);
			$resJes=NULL;$resJesOb=NULL;
			if(isset($resJesTemp[0])){$resJes=$resJesTemp[0];if(isset($resJesTemp[1][1])){$resJesOb=implode(", ",$resJesTemp[1]);}else{$resJesOb=$resJesTemp[1][0];}}
			
			$resParTemp = $this->selectRespuestasEvalEvaluadores((int)$idUsuario,(int)$per,2);
			$resPar=NULL;$resParOb=NULL;
			if(isset($resParTemp[0])){$resPar=$resParTemp[0];if(isset($resParTemp[1][1])){$resParOb=implode(", ",$resParTemp[1]);}else{$resParOb=$resParTemp[1][0];}}
			
			
			$resColTemp = $this->selectRespuestasEvalEvaluadores((int)$idUsuario,(int)$per,4);
			$resCol=NULL;$resColOb=NULL;
			if(isset($resColTemp[0])){$resCol=$resColTemp[0];if(isset($resColTemp[1][1])){$resColOb=implode(", ",$resColTemp[1]);}else{$resColOb=$resColTemp[1][0];}}
			
			$tEvals = array();
			$dd = NULL; $dd->nom = "Auto"; $dd->col = "resa"; $dd->por = 0;
			$dd->obs = $resAutOb;
			array_push($tEvals, $dd);
			if(count($datosc->jefes) > 0){
				$dd = NULL; $dd->nom = "Jefe"; $dd->col = "resj"; $dd->por = 0;
				$dd->obs = $resJesOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->evals) > 0){
				$dd = NULL; $dd->nom = "Pares"; $dd->col = "resp"; $dd->por = 0;
				$dd->obs = $resParOb;
				array_push($tEvals, $dd);
			}
			if(count($datosc->colas) > 0){
				$dd = NULL; $dd->nom = "Colaboradores"; $dd->col = "resc"; $dd->por = 0;
				$dd->obs = $resColOb;
				array_push($tEvals, $dd);
			}
			
			if(count($datosc->jefes) > 0 && count($datosc->evals) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.20;
				$tEvals[1]->por = 0.40;
				$tEvals[2]->por = 0.20;
				$tEvals[3]->por = 0.20;
				}else if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
				}else if(count($datosc->jefes) > 0 && count($datosc->colas) > 0){
				$tEvals[0]->por = 0.25;
				$tEvals[1]->por = 0.50;
				$tEvals[2]->por = 0.25;
				}else{
				$tEvals[0]->por = 0.40;
				$tEvals[1]->por = 0.60;
			}
			$fd=array();
			for($i=0; $i<count($critsComps); $i++){
				$cris = $critsComps[$i]->cris;
				$crt_id = $critsComps[$i]->crt_id;
				for($j=0; $j<count($cris); $j++){
					$inds = $cris[$j]->inds;
					$cr_id = $cris[$j]->cr_id;
					$mejo = "-1";
					$fort = "-1";
					$cris[$j]->mejo = "";
					$cris[$j]->fort = "";
					$oportunidadesMejora = array();
					$t = 0;
					for($k=0; $k<count($inds); $k++)
					{
						$co_id = $inds[$k]->co_id;
						$find = false;
						for($m=0; $m<count($resAut); $m++){
							$resa = $resAut[$m];
							if($resa->crt_id == $crt_id && $resa->cr_id == $cr_id && $resa->co_id == $co_id){
								$find = true;
								break;
							}
						}
						// si se encuetra la posicion se asignan las respuesttas			
						if($find){
							$inds[$k]->resa = $resAut[$m]->cal;
							$inds[$k]->resj = $resJes[$m]->cal;
							$inds[$k]->resp = $resPar[$m]->cal;
							$inds[$k]->resc = $resCol[$m]->cal;
							$prom = 0;
							$vaaan = 0;
							for($m=0; $m<count($tEvals); $m++){
								if($tEvals[$m]->col == "resa"){
									//$prom += $inds[$k]->resa;
									//$vaaan++;
									$prom += $inds[$k]->resa*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resj"){
									//$prom += $inds[$k]->resj;
									//$vaaan++;
									$prom += $inds[$k]->resj*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resp"){
									//$prom += $inds[$k]->resp;
									//$vaaan++;
									$prom += $inds[$k]->resp*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resc" && ($crt_id*1) != $parTec){
									//$prom += $inds[$k]->resc;
									//$vaaan++;
									$prom += $inds[$k]->resc*$tEvals[$m]->por;
									}else if($tEvals[$m]->col == "resc" && ($crt_id*1) == $parTec){
									if(count($datosc->jefes) > 0 && count($datosc->evals) > 0){
										$prom = $inds[$k]->resa*0.25;
										$prom += $inds[$k]->resj*0.50;
										$prom += $inds[$k]->resp*0.25;
										}else{
										$prom = $inds[$k]->resa*0.40;
										$prom += $inds[$k]->resj*0.60;
									}
								}
							}
							/*
								if($prom > 0){
								$prom =  round ($prom / $vaaan, 2);
								}
							*/
							$inds[$k]->prom = $prom;
							$aaa = EvalComportamientos::model()->selectResumenGeneralByComportamiento2($co_id, round($prom, 1));
							$strtemp = "";
							if(isset($aaa->texto)){
								//					$strtemp = "<li>".$aaa."</li>";
								$strtemp = $aaa->texto."||".$aaa->id."||";
								$fd[0][$aaa->id]=$aaa->texto;
							}
							if($prom > 7.9){
								$fort.=" ".$strtemp;
								}else{
								$t++;
								$mejo.="&".$strtemp;
								array_push($oportunidadesMejora, $strtemp);
							}
						}
					}
					$cris[$j]->mejo = ("");
					$cris[$j]->fort = ("");
					if(trim($mejo) != "-1"){
						$cris[$j]->mejo = str_replace("-1","",$mejo);
					}
					if(trim($fort) != "-1"){
						$cris[$j]->fort = str_replace("-1","",$fort);
					}
				}
			}
			
			
			$aData["oportunidadesMejora"]=$oportunidadesMejora;
			//printVar($critsComps);
			$aData["critsComps"]=$critsComps;
			$aData["tEvals"]=$tEvals;
			$aData["parTec"]=$parTec;
			$aData["datosc"]=$datosc;
			$aData["datosjefe"]=$datosjefe;
			$aData["colors"]=$colors;
			$aData["per"]=$per;
			$aData["rTri"]=$rTri;
			$aData["cunive"]=$this->selecUnidadesActivas();
			$aData["imageurl"]="/evalGenserbeta/img/";
			$aData["rbase"]="/evalGenserbeta/";
			$idp=$per; 
			if(count($_POST)==0){
				
				$this->_renderWrappedTemplate('objetivos', 'trimestreFuncional', $aData);
				}else if(isset($_POST["trimestre"])){
				
				$comp = new CDbCriteria;
				$comp->condition = 'idUsuario='.$idUsuario.' and idTrimestre='.(int)$_POST["trimestre"];
				$rComp = EvalComportamiento::model()->findAll($comp); 			
				//VALIDA SI EXISTEN COMPORTAMIENTOS
				if(!isset($rComp[0]->idUsuario)){
					$aData["idp"] =$idp;
					$aData["trimestre"] =(int)$_POST[trimestre];
					$aData["idUsuario"] =$idUsuario;
					$arrComp=array();
					$contador=0;
					foreach($critsComps as $dato){
						foreach($dato->cris as $data){
							$competencias=explode("&",$data->mejo);
							if(empty($competencias[0])){unset($competencias[0]);}
							$arrComp[$contador][0]=$data->cr_nombre;
							$arrComp[$contador][1]=$competencias;
							$arrComp[$contador][2]=$dato->crt_id;
							$contador++; 
						}
					}				 
					$aData["competencias"] =$arrComp; 
					$this->_renderWrappedTemplate('objetivos', 'creacionObjetivos', $aData);
					}else{
					$act = new CDbCriteria;
					$act->condition = 'idUsuario='.$idUsuario.' and idTrimestre="'.(int)$_POST["trimestre"].'"';
					$rAct = EvalActividad::model()->findAll($act); 	
					//VALIDA SI EXISTEN ACTIVIDADES
					$aData["idp"] =$idp;
					
					$aData["trimestre"] =(int)$_POST[trimestre];
					$aData["idUsuario"] =$idUsuario;
					$arrComp=array();
					$contador=0;
					$datos=array();
					$datos2=array();
					foreach($rComp as $row){
						$dato=NULL;
						$dato->idComportamiento=$row->idComportamiento;
						$dato->textoComportamiento=$row->textoComportamiento;
						$dato->comportamientoSeleccionado=$row->comportamientoSeleccionado;
						$dato->idUsuario=$row->idUsuario;
						$dato->idCompetencia=$row->idCompetencia;
						$dato->idTrimestre=$row->idTrimestre;
						$dato->idPeriodo=$row->idPeriodo;
						$dato->tipoComportamiento=$row->tipoComportamiento;
						$dato->idCriterio=$row->idCriterio;
						$dato->fechafin=$row->tipoComportamiento;
						
						$tri = new CDbCriteria;
						$tri->condition = 'idTrimestre='.$row->idTrimestre;
						$rTri = EvalTrimestre::model()->find($tri);
						$dato->nombreTimestre=$rTri->nombreTrimestre;
						$dato->fechaFinTrimestre=$rTri->fechaFinTrimestre;
						
						if($row->tipoComportamiento=="DESARROLLO"){
							array_push($datos, $dato);
							}else if($row->tipoComportamiento=="RESULTADOS"){
							array_push($datos2, $dato);
						}
						$temp = new CDbCriteria;
						$temp->condition = 'idUsuario='.$row->idUsuario.' and  idComportamiento='.$row->idComportamiento.' and idCompetencia='.$row->idCompetencia.' and idTrimestre='.$row->idTrimestre;
						$rTemp = EvalActividad::model()->find($temp); 	
						if(isset($rTemp->idActividad)){
							$dato->textoActividad=$rTemp->textoActividad;
							$dato->porcentaje=$rTemp->porcentajeAsignadoActividad;
						}
					}
					$aData["desarrollo"] =$datos;
					$aData["resultados"] =$datos2;				 
					if(!isset($rAct[0]->idActividad)){
						$this->_renderWrappedTemplate('objetivos', 'actividades', $aData);
						}else{
						$tempRetro = new CDbCriteria;
						$tempRetro->condition = 'idUsuario='.$idUsuario.'  and idTrimestre='.(int)$_POST["trimestre"];
						$rTempRetro = EvalRetroalimentacion::model()->findAll($tempRetro); 	
						$aData["retroalimentacion"] =NULL;				 
						$aData["objetivos"] =NULL;				 
						$aData["actitud"] =NULL;				 
						$aData["jefe"] =NULL;				 
						
						
						if($rTempRetro[0]->idRetroalimentacion>0){
						
							$tempObj = new CDbCriteria;
							$tempObj->condition = 'idRetroalimentacion='.$rTempRetro[0]->idRetroalimentacion;
							$rObj = EvalObjetivo::model()->findAll($tempObj); 	
							
							$tempG = new CDbCriteria;
							$tempG->condition = 'idRetroalimentacion='.$rTempRetro[0]->idRetroalimentacion;
							$rG = EvalGestionjefe::model()->findAll($tempG); 	
							
							$tempAc = new CDbCriteria;
							$tempAc->condition = 'idRetroalimentacion='.$rTempRetro[0]->idRetroalimentacion;
							$rAc = EvalActitud::model()->findAll($tempAc);
							
							
							$tempRo = new CDbCriteria;
							$tempRo->condition = "idUsuario = '".$idUsuario."' AND idTrimestre = '".(int)$_POST["trimestre"]."' AND idPeriodo = '".$idp."'";
							$rRo = EvalReporteobjetivo::model()->find($tempRo);
							
							$aData["reporteobjetivo"]=$rRo;
							$aData["objetivos"]=$rObj;
							$aData["actitud"]=$rAc;
							$aData["jefe"]=$rG;
							$aData["retroalimentacion"]=$rTempRetro;
						}
						$this->_renderWrappedTemplate('objetivos', 'retroalimentacion', $aData);
					}			
					
					
				}
			} 
			
		}
		
		protected function selecUnidadesActivas($id=NULL){
			if(isset($_POST["id"])){$id=(Int)$_POST["id"];}
			$criteria = new CDbCriteria;
			$sel="id>0";
			if($id>0){
				$sel=" id=".$id;
			}
			$criteria->select = 'id,UPPER(codigo) codigo,UPPER(nombre) nombre, UPPER(empresa) empresa,activa, row_date';
			$criteria->condition = $sel.' order by nombre';
			$unidades = EvalUnidades::model()->findAll($criteria);		
			return $unidades;
		}
		
		function selectRespuestasEvalEvaluadores($idu, $idp,$tipo){
			
			
			$controlMod = new CDbCriteria;
			$controlMod->select="id,usid,evalid,idsid,sid,fecha,submitdate,idaEncuestar,idperiodo,tipo";
			$controlMod->condition = 'idaEncuestar=:idaEncuestar and  idaEncuestar<>evalid  and idperiodo=:idperiodo and submitdate<>"" and tipo='.$tipo;
			$controlMod->params = array(':idaEncuestar' => (INT)$idu,":idperiodo"=>(int)$idp); 
			$REGISTROENCUESTA = EvalControl::model()->findAll($controlMod); 
			
			$totales=count($REGISTROENCUESTA);
			$valores=array();
			for($i=0;$i<$totales;$i++){
				
				$valores[$i]=$REGISTROENCUESTA[$i]->idsid;
				
			}
			$res=NULL;
			
			if($valores[0]>0){
				$res= $this->getDatosEncuestaEvaluadores($REGISTROENCUESTA[0]->sid,$valores);
			} 	
			return($res); 	
			
		}
		
		function selectRespuestasEvalAuto($idu, $idp){
		
		$controlMod = new CDbCriteria;
		$controlMod->select="id,usid,evalid,idsid,sid,fecha,submitdate,idaEncuestar,idperiodo,tipo";
		$controlMod->condition = 'evalid=:evalid and idaEncuestar=evalid and idperiodo=:idperiodo  and submitdate <>"" ';
		$controlMod->params = array(':evalid' => (INT)$idu,":idperiodo"=>(int)$idp);                        
		$REGISTROENCUESTA = EvalControl::model()->findAll($controlMod); 
 		
		$res= $this->getDatosEncuestaEvaluadores($REGISTROENCUESTA[0]->sid,array(0,$REGISTROENCUESTA[0]->idsid));
		
 		return($res); 	
		
		}
		
		
		function getDatosEncuestaEvaluadores($sid,$idRe){
		$queryString = " show tables like 'lime_survey_".(int)$sid."'";
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();
		$sufijo="_OLD";
		foreach($res[0] as $datos=>$value) {
		
		if($value=="lime_survey_".(int)$sid){
		$sufijo="";
		}
		
		}
		//printVar($idRe);
 		$excluir=array("id","token","submitdate","lastpage","startlanguage","startdate","datestamp","ipaddr","refurl");
        $queryString = "SELECT * FROM  lime_survey_".(int)$sid.$sufijo." where id in (".implode(",", $idRe).")";
		
  		$eguresult = dbExecuteAssoc($queryString);
		$res = $eguresult->readAll();
		
		$obj=array();
		$cantidad=count($res);
 		$resencu=NULL;
		//$resencu[iterador][id encuesta][id respuestas][id grupo preguntas 'CRITERIO'][id pregunta]
		$parametrizacion=array();
		
 		for($i=0;$i<$cantidad;$i++){
		$contador=1;
		$id=-1;
		$preguntas=0;
		foreach($res[$i] as $datos=>$values) {
		$data = NULL; 
		if($datos=="id"){
		$id=$values;
		} 
		if(!in_array($datos,$excluir)){
		$COLUMNA=str_replace("SQ001","",$datos);
		$ambitoColumna=explode("X",$COLUMNA);
		$resencu[$i][$ambitoColumna[0]][$id][$ambitoColumna[1]][$ambitoColumna[2]]=$values;
		
		
		$queryc = "SELECT
		{{eval_criterios}}.id_tipo_criterio,
		{{eval_criterios}}.id,
		{{groups}}.gid,
		{{groups}}.sid
		FROM
		{{groups}}
		INNER JOIN {{eval_criterios}} ON {{groups}}.idcriterio = {{eval_criterios}}.id
		WHERE
		{{groups}}.gid =".$ambitoColumna[1];
		
		$gcrt = dbExecuteAssoc($queryc);
		$resgcrt = $gcrt->readAll();
		
		$parametrizacion[$ambitoColumna[2]]["crt_id"]=$resgcrt[0]["id_tipo_criterio"];
		$parametrizacion[$ambitoColumna[2]]["cr_id"]=$resgcrt[0]["gid"];
		//$parametrizacion[$ambitoColumna[2]]["gid"]=$resgcrt[0]["gid"];
		$parametrizacion[$ambitoColumna[2]]["sid"]=$resgcrt[0]["sid"];
		$parametrizacion[$ambitoColumna[2]]["co_id"]=$ambitoColumna[2];
		$preguntas++;
		
		}
		}
 		}
 		unset($parametrizacion[$preguntas-1]);
		$totalRes=count($resencu);
 		$obj=array();
 		$finalobj=array();
		$contaRes=0;
 		foreach($resencu as $key1=>$nivel1){
		foreach($nivel1 as $key2=>$nivel2){
		foreach($nivel2 as $key3=>$nivel3){
		$tgrupos=count($nivel3);
		$contadorg=0;
		foreach($nivel3 as $key4=>$nivel4){
		$total=0;
		$contador=0;
		foreach($nivel4 as $key5=>$dato){
		$total+=$dato;
		if(is_numeric($dato) ){
		$obj[$key5]=$obj[$key5]+$dato;
		}else{
		$obj[$key5].=$dato.", ";
		}
		
		$contador++;
		}
		$contadorg++;
		//printVar($total/($contador*10),$contador);
		}
		}
		}
		$finalobj[$contaRes]=$obj;			
		$contaRes++;
 		}
		
		$totalRes=count($finalobj);
		
 		$contado=0;
		$totalPreguntas=count($finalobj[$totalRes-1]);
		$obj=NULL;
		foreach($finalobj[$totalRes-1] as $co_id=>$valor){
		if($contado<($totalPreguntas-1)){
		$data=NULL;
		$data->crt_id=$parametrizacion[$co_id]["crt_id"];
		$data->cr_id=$parametrizacion[$co_id]["cr_id"];
		//$data->gid=$parametrizacion[$co_id]["gid"];
		$data->sid=$parametrizacion[$co_id]["sid"];
		$data->co_id=$co_id;
		$data->cal=round($valor/$totalRes);
		$data->total=$totalRes;
		$obj[0][$contado]=$data;
		}else{
		$td=explode(",",$valor);
		unset($td[count($td)-1]);
		$obj[1]=$td;
		}
		$contado++;
 		}
		
 		return $obj;
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