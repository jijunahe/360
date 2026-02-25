<?php
 
error_reporting(E_ALL);
ini_set('display_errors', '0');
require_once __DIR__ . '/../vendor/autoload.php';
$raiz="ADVANCE/";
$raiz="LOW/";
if(isset($_REQUEST["del"])){
	$test=explode(".pdf",$_REQUEST["del"]);
	 
	unlink($test[0].".pdf");
		echo 'envoltorio('.json_encode(array($test[0].".pdf")).')';

	exit;
}
function convertir($srt){
	$array=array("Ã³"=>"&oacute;","Ã±"=>"&ntilde;","Ã¡"=>"&aacute;","Ã©"=>"&eacute;","Ã­">="&iacute;");
	foreach($array as $k=>$d){
		$srt=str_replace($k,$d,$srt);
	}
	return ($srt);
}

try {
	 
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
	
    $mpdf =new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fuentes',
    ]),
    'fontdata' => $fontData + [
        'roboto' => [
            'R' => 'OpenSans-Light.ttf',
            'I' => 'OpenSans-LightItalic.ttf',
        ]
    ],
    'default_font' => 'roboto',
	//'defaultPageNumStyle'=>'1',
	'mode' => 'utf-8', 
   // 'format' => [190, 236], 
   // 'format' => [215.9, 279.4] 
    'format' => [215.9, 300.4] 
   // 'orientation' => 'Letter' 
]);
	
	
	
    setlocale(LC_ALL, "es_CO.UTF-8");
	shell_exec("wget 'https://talentracking.com".$_REQUEST["base"]."tmp/json/".$_REQUEST["json"]."'");
	
	
	
	$fichero = fopen ($_REQUEST["json"], "r");
	if (!$fichero) {
		echo "<p>Imposible abrir el fichero remoto. ".$_REQUEST["json"]."\n";
		exit;
	}
	$row=array();
	while (!feof ($fichero)) {
		$linea = fgets ($fichero, 1024);
		/* Esto solo funciona si el título y sus etiquetas están en una línea */
		array_push($row,$linea);
	}
	fclose($fichero);	
	
 	
	if(count($row)>0){
		$row=json_decode(join("",$row));
		foreach($row as $k=>$d){
			$_REQUEST[$k]=$d;
		}
		
	}	
	unlink ($_REQUEST["json"]);
	//sleep(3);
	 
	$data["usuario"]=json_decode(base64_decode($_REQUEST["us"]));
	$data["proyecto"]=json_decode(base64_decode($_REQUEST["p"]));
	$data["report"]=json_decode(base64_decode($_REQUEST["report"]));
	 /* echo "<pre>";
	  print_r($data["report"]->preguntasxcompetencias->{'2ET46'});
	 echo "</pre>";
	 
	 exit; */
	$meses=array(
	"1"=>"Enero",
	"2"=>"Febrero",
	"3"=>"Marzo",
	"4"=>"Abril",
	"5"=>"Mayo",
	"6"=>"Juni",
	"7"=>"Juli",
	"8"=>"Agosto",
	"9"=>"Septiembre",
	"10"=>"Octubre",
	"11"=>"Noviembre",
	"12"=>"Diciembre",
	);
	 
	
	$data["fecha"]=(string) ($meses[(int)date("m")])." ".date("d")." de ".date("Y");

	//echo "<pre>";print_r($data["report"]->competencias);echo "</pre>";exit;
	//$mpdf->WriteHTML($html);
	$hojas=9;
	$pagina=0;
 	for($i=1;$i<=$hojas;$i++){  
		if($i==1){  
			$html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px;height:737px;float:left;margin-right:304px !important;">';

		
			$para=strtoupper($data["usuario"]->nombres);
			if($data["report"]->participante!=""){
				$para=strtoupper($data["report"]->participante);
			}	
		//	 echo "<pre>";print_r($data);echo "</pre>";
			 
			
			 
			$html.='<br><div style="background:#fff;z-index:9999999;margin-top:415px;font-size:20px;width:440px;text-align:right">'.$para.'</div>';
			$html.='<br><div style="background:#fff;z-index:9999999;margin-top:30px;font-size:20px;width:440px;text-align:right">'.strtoupper($data["proyecto"]->nombre).'</div>';
			$html.='<br><div style="background:#fff;z-index:9999999;margin-top:35px;font-size:20px;width:440px;text-align:right">'.($data["fecha"]).'</div>';
		
			$html.='</div>';
			$html.='</body></html>';
		/*	echo $html;
			
			 exit;*/
			$html = utf8_encode($html);
			  /*
			echo "<pre>";
			print_r(($data["report"]));
			echo "</pre>";
			echo $html;exit;
			 */
			
			$mpdf->AddPage();$mpdf->WriteHTML($html);
			 
			 
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 
			$mpdf->Image('var:pag'.$i, 0, 22, 212, 273.3, 'jpg', '', true, false);
		
		}
		
		
		
		  
		if($i==2){ 
			$html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px;height:737px;float:left;margin-right:304px !important;">';

		//echo "<pre>";print_r($data["report"]);echo "</pre>";exit;	    	
			 
			$html.='<br>';
			$html.='<br>';
			 
			$html.='<div style=" z-index:9999999;margin-top:660px;font-size:20px;width:750px;text-align:right"><center>';
			$html.='<table  cellspacing=0 style="margin-left:70px;border-collapse: collapse;border:none"   >';
			$html.='<tbody >';
			$html.='<tr>';
			$html.='<td  >';
			$html.='</td>';
			$html.='<td  >';
			$html.='</td>';
			$html.='<td  >';
			$html.='</td>';
			$html.='<td  >';
			$html.='</td>';
			$html.='<td  >';
			$html.='</td>';
 			$html.='</tr>';
 			$html.='<tr><td>';
			 $html.='<table  style="border-collapse: collapse;border:#D8D8D8 1px solid">';
			foreach(json_decode($data["report"]->escalas->jsondesccriptor) as $k=>$d){
				
				
				$html.='<tr style="border-collapse: collapse;border:#D8D8D8 1px solid">';
				$html.='<td style="width:200px;height:40px;font-size:14px;border-collapse: collapse;border:#D8D8D8 1px solid;padding-left:10px">';
				$html.=  convertir($data["report"]->rel[$k]->nombre);
				$html.='</td>';
				$html.='<td style="width:40px;height:40px;font-size:14px;background-color:#F2F2F2;color:#000;text-align:center;border-collapse: collapse;border:#D8D8D8 1px solid">';
				$html.=' '.$data["report"]->rel[$k]->total.'</td>';
				$html.='</tr>';	
			}	
			$html.='</table>';
			$html.='</td>';
			
			$html.='<td style="width:50px;height:40px;border-collapse: collapse;border:none;border-left:#fff 1px solid;border-right:#fff 1px solid;border-top:none;border-bottom:none">';
			$html.='</td>';
			
				
			$html.='<td>';
			 $html.='<table  style="border-collapse: collapse;border:#D8D8D8 1px solid">';
			foreach(json_decode($data["report"]->escalas->jsondesccriptor) as $k=>$d){
				$html.='<tr style="border-collapse: collapse;border:#D8D8D8 1px solid">';
				$html.='<td style="width:40px;height:40px;font-size:14px;background-color:#F2F2F2;color:#000;text-align:center;border-collapse: collapse;border:#D8D8D8 1px solid">'.($k+1);
				$html.='</td>';
				$html.='<td style="width:200px;height:40px;font-size:14px;border-collapse: collapse;border:#D8D8D8 1px solid;padding-left:10px">'.$d;
				$html.='</td>';
 				$html.='</tr>';	
			}	
			$html.='</table>';
 			$html.='</td>'; 
			 
			
			$html.='</tbody> '; 
			$html.='</table>';
			$html.='</center>'; 
			$html.='</div>'; 
 			$html.='</div>';
			$html.='</body></html>';
			$html = utf8_encode($html);


			// Double-side document - mirror margins
		 

			// Set a simple Footer including the page number
			//$mpdf->setFooter('{PAGENO}');
			

		//	$mpdf->AddPage();
			$mpdf->AddPage('','','','','on');
			$mpdf->WriteHTML($html);
 			 
		 
			$footer='<div style="z-index:999;margin-top:-52px;text-align:right;font-family: roboto !important;font-size:14px;font-style:normal !important">pág ';
			$footer.=$i;
			$footer.='</div>';
			$mpdf->SetHTMLFooter($footer);  

			  
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 //212, 273.3
			$mpdf->Image('var:pag'.$i, 0, 0, 212, 290.3, 'jpg', '', true, false);

	 	
		}
		if($i==3){
			// echo "<pre>"; print_r($data["report"]);exit;  
			$html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px;height:737px;float:left;margin-right:304px !important;">';
 			$html.='<br>';
			$html.='<br>';
			 
			$html.='<div style=" z-index:9999999;margin-top:100px;font-size:20px;width:800px;">';
				$html.='<table  >';
				$html.='<tr>';
				$html.='<td   style="text-align:right;height:30px;padding-right:20px"><b>Competencias</b></td>';
				$html.='<td style="width:40px;border-right:none;color:'.$color.';text-align:right"><b> ';	 
				$html.='DIF</b> </td>';	 
				$html.='<td></td></tr>';
				foreach($data["report"]->competencias as $k=>$comp){
					 
				$html.='<tr>';
				$html.='<td   style="text-align:right;height:20px;padding-right:20px">';
					//$html.='<div style="z-index:9999;width:350px;height:60px;float:right;text-align:right">';
					$html.= utf8_decode($comp->competencia);
					//$html.='</div>';
				$html.='</td>';	 
				$comp->dif=($comp->dif*$data["report"]->rango)/100;
				$color="green";
				if($comp->dif<0 or $comp->dif==0 ){
					$color="red";
				}
				$html.='<td style="width:40px;border-right:none;color:'.$color.';float:right"><b> '.number_format($comp->dif,2);	 
				$html.='</b> </td>';	 
				$html.='<td  >';	 
					$html.='<div style="z-index:8888;width:300px;height:20px;float:left;">';
						$w=(($comp->tauto*350)/100)+1;  
						$comp->tauto=($comp->tauto*$data["report"]->rango)/100;						
						$html.='<table style="width:'.$w.'px;height:20px;">'; 
						$html.='<tr >'; 
						$html.='<td style="background-color:#8A0808;text-align:right;color:#fff"><strong style="color:#fff">';
						$html.=number_format($comp->tauto,2);  
						$html.='</strong></td>';
						$html.='</tr>';
						$html.='</table>';
						//$data["report"]->pxcom->{$comp->keyid}=$comp->totros;
						$w=(((($data["report"]->pxcom->{$comp->keyid}*100)/$data["report"]->rango)*350)/100)+1;
						
						//$data["report"]->pxcom->{$comp->keyid}=($data["report"]->pxcom->{$comp->keyid}*$data["report"]->rango)/100;
						$comp->totros=$data["report"]->pxcom->{$comp->keyid};
						$html.='<table style="width:'.$w.'px;height:20px;">'; 
						$html.='<tr >'; 
						$html.='<td style="background-color:#084B8A;text-align:right;color:#fff"><strong  style="color:#fff">';
						$html.=number_format($data["report"]->pxcom->{$comp->keyid},2);  
						$html.='</strong></td>';
						$html.='</tr>';
						$html.='</table>';
						 
					$html.='</div>';    
				$html.='</td>  ';
				$html.='</tr>  ';
				$html.='<tr>';
					$html.='<td>  ';
					$html.='</td>  '; 
					$html.='<td style="height:5px;border-right:none">  ';
					$html.='</td>  ';
					$html.='<td>  ';
					$html.='</td>  ';
				$html.='</tr>';
					 
				}
			$html.='<tr>';
				$html.='<td   style="text-align:left;height:30px"><b> </b></td>';
				$html.='<td style="width:40px;border-right:none;color:'.$color.';float:right"><b> ';	 
				$html.=' </b> </td>';	 
				$html.='<td>';
				 
				$incremento=number_format(($data["report"]->rango/10),1);
				//$wb=((0.5*300)/$data["report"]->rango)*1.45; 
				$wb=46.5; 
				$html.='<table style="width:300px;height:15px;border-collapse: collapse;border:#000 1px solid;border-bottom:none">';
				$html.='<tr>';
				for($ii=1;$ii<=$data["report"]->rango;$ii=$ii+0.5){
					$html.='<td style="width:'.$wb.'px;border-collapse: collapse;border:#000 1px solid;border-bottom:none">';  
					$html.='</td>'; 
				}
				$html.='</tr>';
				$html.='</table>';
				$html.='<table style="width:300px;border-collapse: collapse;border:none">';
 				$html.='<tr>';
				for($ii=1;$ii<=$data["report"]->rango;$ii=$ii+0.5){
					$html.='<td style="width:'.$wb.'px;border-collapse: collapse;border:none">'.number_format($ii,2);  
					$html.='</td>'; 
				}
				$html.='</tr>';
				
				$html.='</table>';
				$html.='</td></tr>';

			$html.='</table>';
			
			$html.='</br>';
			$html.='</br>';
			
			
			$html.='<table style="width:400px;border-collapse: collapse;border:none;margin-left:200px">';
			 $html.='<tr>';			
			$html.='<td style="background-color:#8A0808;width:25px;height:25px"></td>';
			$html.='<td>Mis resultados</td>';
			$html.='<td style="width:60px;height:25px"></td>';
						
			$html.='<td style="background-color:#084B8A;width:25px;height:25px"></td>';
			$html.='<td>Resultados del proyecto</td>';
			  $html.='</tr>';	
			 
			$html.='</table>';  
						
			
			
			$html.='</div>';
			$html.='</body></html>';  
			$html = utf8_encode($html);

			$mpdf->AddPage();$mpdf->WriteHTML($html);
			 
			 
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 
			$mpdf->Image('var:pag'.$i, 0, 0, 212, 290.3, 'jpg', '', true, false);
			$footer='<div style="z-index:999;margin-top:-52px;text-align:right;font-family: roboto !important;font-size:14px;font-style:normal !important">pág ';
			$footer.=$i;
			$footer.='</div>';
			$mpdf->SetHTMLFooter($footer);  


		} 
		if($i==4){
			$html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px;height:737px;float:left;margin-right:304px !important;">';

			$html.='<br>';
			 
			$html.='<div style=" z-index:9999999;margin-top:170px;font-size:12px;width:800px;">';
				$html.='<table cellspacing=0  width="750" style="border-collapse: collapse;">'; 
				$html.='<tr>';
				$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid; font-size:12px;text-align:center;height:25px" ><span>#Preg';
				$html.='</span></td>';
				$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;text-align:center; font-size:12px;text-align:center;height:25px" ><span>Competencia';
				$html.='</span></td>';
				$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;text-align:center; font-size:12px;text-align:center;height:25px" ><span>Definici&oacute;n';
				$html.='</span></td>';
				$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;text-align:center; font-size:12px;text-align:center;height:25px" ><span>Si mismo';
				$html.='</span></td>';
				$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;text-align:center; font-size:12px;height:25px" ><span>Otros';
				$html.='</span></td>';
				foreach($data["report"]->competencias as $k=>$comp){
					if($k<=15){
					$html.='<tr>';
					$html.='<td style="background-color:#fff;border-collapse: collapse;border:#D8D8D8 1px solid; font-size:12px;padding:7px;height:25px" ><span>'.$comp->tpreg;
					$html.='</span></td>';
					$html.='<td style="background-color:#fff;border-collapse: collapse;border:#D8D8D8 1px solid; font-size:12px;padding:7px;font-family:\'Roboto Ligth\'" ><span>'.utf8_decode($comp->competencia);
					$html.='</span></td>';
					$html.='<td style="background-color:#fff;border-collapse: collapse;border:#D8D8D8 1px solid; font-size:14px;padding:7px;font-family:\'Roboto Ligth\'" >'.utf8_decode($comp->descripcion);
					$html.='</td>';
					$comp->simismo=($comp->simismo* $data["report"]->rango)/100;
					$html.='<td style="background-color:#fff;border-collapse: collapse;border:#D8D8D8 1px solid;text-align:center;padding:7px;font-size:12px;" ><span>'.number_format($comp->simismo,2);
					$html.='</span></td>';
					/*
					Gris $D3D2D1
					Azul A9BCF5
					verde A9F5BC
					naranj F5D0A9
					rojo F78181
					*/
					 
					$tot=number_format($comp->tauto,1);
					$color="#F78181";
					if($tot<3.1){
						$color="#F78181";
					}
					if($tot>=3.1 and $tot<3.49){
						$color="#F5D0A9";
					}
					if($tot>=3.49 and $tot<3.89){
						$color="#D3D2D1";
					}
					if($tot>=3.89 and $tot<4.3){
						$color="#A9F5BC";
					}
					if($tot>=4.3){
						$color="#A9BCF5";
					}  
					  
					$html.='<td style="background-color:'.$color.';border-collapse: collapse;border:#D8D8D8 1px solid;text-align:center;padding:7px;font-size:12px;" ><span>'.number_format($comp->tauto,2);  
					$html.='</span></td>';	
					}					
					
				}
				
				$html.='</tr>';
				$html.='</table>';
			
			$html.='</div>';
			$html.='</div>';
			$html.='</body></html> ';

			$html = utf8_encode($html);

			$mpdf->AddPage();
			$mpdf->WriteHTML($html);
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 
			$mpdf->Image('var:pag'.$i, 0, 0,212, 290.3, 'jpg', '', true, false);
			$footer='<div style="z-index:999;margin-top:-52px;text-align:right;font-family: roboto !important;font-size:14px;font-style:normal !important">pág ';
			$footer.=$i;
			$footer.='</div>';
			$mpdf->SetHTMLFooter($footer);  
 
		}
		

		if($i==5){
			
			 // echo "<pre>";print_r($data["report"]->competencias );echo "</pre>";exit; 
			$tCom=count($data["report"]->competencias);
			 
			$numpre=1;
			//$contador=1;
 			foreach($data["report"]->competencias as $index=>$dataA){
				$html='<html><body style="font-family: roboto" >';
				$html.='<div style="background:#fff;width:740px;height:737px;float:left;margin-right:304px !important; ">';
				 
				$html.=' <br><div style=" z-index:9999999; font-size:20px;width:800px;">';
				 if($index==0){
				$html.='<div style=" font-size:26px;font-family:roboto"><span style="color:#f0ad4e;float:left; font-size:26px;font-family:roboto"> Sección III. </span> Resultados por competencias</div> ';
				 
 			} 
				$html.='<table cellspacing=0     style="border-collapse: collapse;">';
				$html.='<tr>'; 

				$calificacion=$dataA->tauto;
				$html.='<td width="250">';
					$html.='<table width="250"  style="border-collapse: collapse;">';
					$html.='<tr>';
					$color="#F78181";
					if($calificacion<3.1){
					$color="#F78181";
					}
					if($calificacion>=3.1 and $calificacion<3.49){
					$color="#F5D0A9";
					}
					if($calificacion>=3.49 and $calificacion<3.89){
					$color="#BDBDBD";
					}
					if($calificacion>=3.89 and $calificacion<4.3){
					$color="#A9F5BC";
					}
					if($calificacion>=4.3){
					$color="#A9BCF5";
					}
					$html.='<td style="padding:10px;height:40px;background-color:'.$color.';color:#000; text-align:center;font-size:16px;border-collapse: collapse;border:#D8D8D8 1px solid;font-family:\'Roboto Ligth\'">';
					$html.="<span>".number_format($calificacion,2)."</span>";
					$html.='</td>';
					$html.='</tr>';
					$html.='<tr>';
					$html.='<td style="text-align:center;border-collapse: collapse;border:#D8D8D8 1px solid;height:40px;padding:10px;font-family:\'Roboto Ligth\'" ><span>'.convertir($dataA->competencia);
					$html.='</span></td>';
					$html.='</tr>';
					$html.='</table>';
				$html.='</td>';
				$html.='<td width="2">';
				
				$html.='</td>';
				$html.='<td  >';
				
				$html.='</td>';
				$html.='</tr>';
				
				$html.='<tr>';
					$html.='<td style="width:255px">';
					$html.='</td>';
					$html.='<td>';
					$html.='</td>';
					$html.='<td>';    
						$html.='<table cellspacing=0    style="border-collapse: collapse;">';
						$html.='<tr>';
							$html.='<td width="120" style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;color:#000;text-align:center"> <span>Puntaje</span>';
							$html.='</td>';
							$html.='<td  width="70" style="background-color:#F78181;border-collapse: collapse;border:#D8D8D8 1px solid;color:#000;text-align:center;font-size:13px"> 3.1 ';
							$html.='</td>';
							$html.='<td  width="70" style="background-color:#F5D0A9;border-collapse: collapse;border:#D8D8D8 1px solid;color:#000;text-align:center;font-size:13px"> 3.1 - 3.49 ';
							$html.='</td>';
							$html.='<td  width="70" style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;color:#000;text-align:center;font-size:13px"> 3.49 - 3.89 ';
							$html.='</td>';
							$html.='<td  width="70" style="background-color:#A9F5BC;border-collapse: collapse;border:#D8D8D8 1px solid;color:#000;text-align:center;font-size:13px"> 3.89 - 4.3 ';
							$html.='</td>';
							$html.='<td  width="70" style="background-color:#A9BCF5;border-collapse: collapse;border:#D8D8D8 1px solid;color:#000;text-align:center;font-size:13px"> 4.3+ ';
							$html.='</td>';
						$html.='</tr>';
						$html.='</table>';
					$html.='</td>';
				$html.='</tr>';
				
			
			
				foreach($data["report"]->preguntasxcompetencias->{$dataA->keyid} as  $datac){ 
					 $datac->promedio=number_format( $datac->promedio,2);
					$html.='<tr>'; 
					
						$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;padding:15px;font-family:\'Roboto Ligth\';width:250px"><span>'.$numpre.". ".convertir($datac->enunciado);
						$html.='</span></td>';
						$html.='<td style="border-collapse: collapse;border:#D8D8D8 0px solid">';
						$html.='</td>';
						$html.='<td style="border-collapse: collapse;border:none">';
							$html.='<table  style="border-collapse: collapse">';
							$html.='<tr>';
								$html.='<td  width="120"   >';
									$html.='<table border=0 style="border-collapse:collapse;width:150px;">';
									$promedio=0;
									$totalr=count($datac->respuesta)-1;
									 foreach($datac->respuesta as $relaciones=>$varc){
										$html.='<tr>';
										$html.='<td style="text-align:right;border-collapse: collapse;border:#D8D8D8 1px solid; height:25px;padding-right:10px;font-family:\'Roboto Ligth\';">';
										$html.='<span style="font-size:14px;">'.$relaciones.'</span></td>';
									 $html.='</tr>';
									 }
										$html.='<tr>';
										$html.='<td style="text-align:right;border-collapse: collapse;border:#D8D8D8 1px solid; height:25px">';
										$html.='<span style="font-size:14px;margin-right:10px;"><span>Promedio</span></span></td>';
										$html.='</tr>';
									 $html.='</table>';
								$html.='</td>';
								
								$html.='<td  width="70"   >';
								
									$html.='<table style="width:69px;border-collapse: collapse;">';
									 foreach($datac->respuesta as $relaciones=>$varc){  
										$html.='<tr>';
										if($varc<3.1){
											$html.='<td style="background-color:#F78181;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
											$html.= number_format($varc,2).' </td>';
											
										}else{
											$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;height:25px;width:48px;color:#fff;height:25px">0000';
											$html.='</td>';
										}
									 $html.='</tr>';
									 }
									 $html.='<tr>';
									
									 if($datac->promedio<3.1){
										$html.='<td style="background-color:#F78181;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
										$html.=  $datac->promedio .' </td>';
									 }else{ 
										$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;color:#fff;height:25px">0000';
										$html.='</td>';
									 }
									 $html.='</tr>';
									 $html.='</table>';								
								
								
								$html.='</td>';
								$html.='<td  width="70" >';
								
									$html.='<table  style="width:69px;border-collapse: collapse;">';
									 foreach($datac->respuesta as $relaciones=>$varc){
										$html.='<tr>';
										if($varc>=3.1 and $varc<3.49 ){
											$html.='<td style="background-color:#F5D0A9;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
											$html.= number_format($varc,2).' </td>';
											
										}else{
											$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;height:25px;width:48px;color:#fff;height:25px">0000';
											$html.='</td>';
										}
									 $html.='</tr>';
									 }
									 $html.='<tr>';
									 if($datac->promedio>=3.1 and $datac->promedio<3.49){
										$html.='<td style="background-color:#F5D0A9;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
										$html.=  ($datac->promedio ).' </td>';
									 }else{ 
										$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;color:#fff;height:25px">0000';
										$html.='</td>';
									 }
									 $html.='</tr>';
									 $html.='</table>';								
								
								$html.='</td>';
								$html.='<td  width="70"  >';
								
									$html.='<table  style="width:69px;border-collapse: collapse;" >';
									 foreach($datac->respuesta as $relaciones=>$varc){
										$html.='<tr>';
										if($varc>=3.49 and $varc<3.89 ){
											$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
											$html.= number_format($varc,2).' </td>';
											
										}else{
											$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;height:25px;width:48px;color:#fff;height:25px">0000';
											$html.='</td>';
										}
									 $html.='</tr>';
									 }
									 $html.='<tr>';
									 if($datac->promedio>=3.49 and $datac->promedio<3.89){
										$html.='<td style="background-color:#D3D2D1;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
										$html.=  ($datac->promedio ).' </td>';
									 }else{ 
										$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;width:48px;color:#fff;height:25px">0000';
										$html.='</td>';
									 }
									  
									 $html.='</tr>';
									 $html.='</table>';								
								
								$html.='</td>';
								$html.='<td  width="70"  >';
								
									$html.='<table  style="width:69px;border-collapse: collapse;" >';
									 foreach($datac->respuesta as $relaciones=>$varc){
										$html.='<tr>';
										if($varc>=3.89 and $varc<4.3 ){
											$html.='<td style="background-color:#A9F5BC;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
											$html.=  number_format($varc,2).' </td>';
											
										}else{
											$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;height:25px;width:48px;color:#fff;height:25px">0000';
											$html.='</td>';
										}
									 $html.='</tr>';
									 }
									 $html.='<tr>';
									 if($datac->promedio>=3.89 and $datac->promedio<4.3){
										$html.='<td style="background-color:#A9F5BC;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
										$html.=  ($datac->promedio ).' </td>';
									 }else{ 
										$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;color:#fff;height:25px">0000';
										$html.='</td>';
									 }
									  
									 $html.='</tr>';
									 $html.='</table>';								
								
								$html.='</td>';
								$html.='<td  width="70" >';
								
									$html.='<table  style="width:69px;border-collapse: collapse;" >';
									 foreach($datac->respuesta as $relaciones=>$varc){
										$html.='<tr>';
										if($varc>=4.3 ){
											$html.='<td style="background-color:#A9BCF5;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
											$html.=  number_format($varc,2).' </td>';
											
										}else{
											$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;height:25px;width:48px;color:#fff;height:25px">0000';
											$html.='</td>';
										}
									 $html.='</tr>';
									 }
									 $html.='<tr>';   
									  if($datac->promedio>4.3){
										$html.='<td style="background-color:#A9BCF5;border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;text-align:center;height:25px">';
										$html.=  ($datac->promedio ).' </td>';
									 }else{ 
										$html.='<td style="border-collapse: collapse;border:#D8D8D8 1px solid;width:48px;color:#fff;height:25px">0000';
										$html.='</td>';
									 }
									 $html.='</tr>';
									 $html.='</table>';								
								
								$html.='</td>';
							$html.='</tr>';
							$html.='</table>';
						$html.='</td>';
						
					$html.='</tr>';
					$numpre++;
				}	

				$html.='</table>';
				$html.='</div>';			 
					 
					//$mpdf->AddPage();$mpdf->WriteHTML($html);   
				
				$html.='</div>';
				$html.='</body></html>  ';
				
				$mpdf->mirrorMargins = 0;

				$mpdf->SetDisplayMode('fullpage');
				$mpdf->setFooter('{PAGENO}');
				// $mpdf->AddPage( ); 
				$mpdf->WriteHTML($html);	   
				$mpdf->WriteHTML('<pagebreak type="NEXT-ODD" pagenumstyle="1" />');
 				
				$i++;    
 			}
			
			 
 			
			$i=5;

		}
		if($i==6){
			 $html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px; float:left;margin-right:304px !important;">';

			$html.='<br><div style=" z-index:9999999;margin-top:170px;font-size:20px;width:800px;">';
				$html.='<table cellspacing=0  width="750" style="border-collapse: collapse;">';
				
				$html.='<tr>';
				$html.='<td width="20" style="background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>P</span></td>';
				if($data["report"]->participante==""){
				$html.='<td width="20"  style="background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>A</span></td>';
				}
				$html.='<td width="20"  style="background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>R</span></td>';
				$html.='<td width="690"  style=" background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>Comportamiento (Competencia)</span></td>';
 				$html.='</tr>';
							
			 
				$contador=0;
				foreach($data["report"]->comportamientos->rup as $keyid=>$calificacion){
					if(!is_numeric($keyid) and $contador<10){
					$html.='<tr>';
					$data["report"]->comportamientos->pup->{$keyid}=number_format((($data["report"]->comportamientos->pup->{$keyid}*$data["report"]->rango)/100),2);
					$data["report"]->comportamientos->aup->{$keyid}=number_format((($data["report"]->comportamientos->aup->{$keyid}*$data["report"]->rango)/100),2);
					$html.='<td width="20" style="height:63px;background-color:#fff;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$html.='<span>'.$data["report"]->comportamientos->pup->{$keyid}.'</span></td>';
					if($data["report"]->participante==""){
 					$html.='<td width="20"  style="height:63px;background-color:#fff;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$html.='<span>'.$data["report"]->comportamientos->aup->{$keyid}.'</span></td>';
					}
					$color="#";
					$calificacion=number_format((($calificacion*$data["report"]->rango)/100),2);
					if($calificacion<3.1){$color="#F78181";}
					if($calificacion>=3.1 and $calificacion<3.49 ){$color="#F5D0A9";}
					if($calificacion>=3.49 and $calificacion<3.89 ){$color="#D3D2D1";}
					if($calificacion>=3.89 and $calificacion<4.3 ){$color="#A9F5BC";}
					if($calificacion>=4.3 ){$color="#F78181";}
					
					$html.='<td width="20"  style="height:63px;background-color:'.$color.';color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$html.='<span>'.$calificacion.'</span></td>';
					$html.='<td width="690"  style="background-color:#fff;color:#000;text-align:left;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$html.=''.utf8_decode($data["report"]->comportamientos->rupd->{$keyid}->enunciado).' ('.utf8_decode($data["report"]->comportamientos->rupd->{$keyid}->competencia).') </td>';
					$html.='</tr>';					
					$contador++;
					}
				
				
				}
 				
				$html.='</table>';
			$html.='</div>';
						$html.='</div>';
			$html.='</body></html>';

			$html = utf8_encode($html);

			$mpdf->AddPage();$mpdf->WriteHTML($html);
			 
			 
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 
			$mpdf->Image('var:pag'.$i, 0, 0, 212, 290.3, 'jpg', '', true, false);
			$footer='<div style="z-index:999;margin-top:-52px;text-align:right;font-family: roboto !important;font-size:14px;font-style:normal !important">pág ';
			$footer.=$i;
			$footer.='</div>';
			$mpdf->SetHTMLFooter($footer);  

		}		
		if($i==7){
			 $html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px; float:left;margin-right:304px !important;">';

			
			$html.='<br><div style=" z-index:9999999;margin-top:165px;font-size:14px;width:800px;;border-collapse: collapse;">';
				$html.='<table cellspacing=0  width="750">';
				
				$html.='<tr>';
				$html.='<td width="20" style="height:40px;background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>P</span></td>';
				if($data["report"]->participante==""){
 				$html.='<td width="20"  style="height:40px;background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>A</span></td>';
				}
				$html.='<td width="20"  style="height:40px;background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>R</span></td>';
				$html.='<td width="690"  style="height:40px;background-color:#D3D2D1;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
				$html.='<span>Comportamiento (Competencia)</span></td>';
 				$html.='</tr>';
							
			 
			//Azul A9BCF5
			//verde A9F5BC
			//Gris $D3D2D1
			//naranj F5D0A9
			//rojo F78181
			/*
			echo "<pre>";
			 print_r($data["report"]->comportamientos);
			 echo "</pre>";exit;
			 */
				$contador=0;
				foreach($data["report"]->comportamientos->rdw as $keyid=>$calificacion){
					if(!is_numeric($keyid) and $contador<10){
					$html.='<tr>';
					$html.='<td width="20" style="height:63px;background-color:#fff;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$data["report"]->comportamientos->pup->{$keyid}=number_format((($data["report"]->comportamientos->pup->{$keyid}*$data["report"]->rango)/100),2);
					$html.='<span>'.$data["report"]->comportamientos->pup->{$keyid}.'</span></td>';
					if($data["report"]->participante==""){
					$html.='<td width="20"  style="height:63px;background-color:#fff;color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$data["report"]->comportamientos->aup->{$keyid}=number_format((($data["report"]->comportamientos->aup->{$keyid}*$data["report"]->rango)/100),2);
					$html.='<span>'.$data["report"]->comportamientos->aup->{$keyid}.'</span></td>';
					}
					$color="#";
					$calificacion=number_format((($calificacion*$data["report"]->rango)/100),2);
						if($calificacion<3.1){
						$color="#F78181";
						}
						if($calificacion>=3.1 and $calificacion<3.49){
						$color="#F5D0A9";
						}
						if($calificacion>=3.49 and $calificacion<3.89){
						$color="#BDBDBD";
						}
						if($calificacion>=3.89 and $calificacion<4.3){
						$color="#A9F5BC";
						}
						if($calificacion>=4.3){
						$color="#A9BCF5";
						}
					$html.='<td width="20"  style="height:63px;background-color:'.$color.';color:#000;text-align:center;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$html.='<span>'.$calificacion.'</span></td>';
					$html.='<td width="690"  style="background-color:#fff;color:#000;text-align:left;font-size:14px;border:#D8D8D8 1px solid;border-collapse: collapse;padding:10px;font-family:\'Roboto Ligth\';">';
					$html.=''.utf8_decode($data["report"]->comportamientos->rupd->{$keyid}->enunciado).' ('.utf8_decode($data["report"]->comportamientos->rupd->{$keyid}->competencia).')</td>';
					$html.='</tr>';					
					$contador++;
					}
				
				
				}
 				
				$html.='</table>';
			$html.='</div>';
						$html.='</div>';
			$html.='</body></html>';

			 $html = utf8_encode($html);

			$mpdf->AddPage();$mpdf->WriteHTML($html);
			 
			 
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 
			$mpdf->Image('var:pag'.$i, 0, 0,  212, 290.3, 'jpg', '', true, false);
			$footer='<div style="z-index:999;margin-top:-52px;text-align:right;font-family: roboto !important;font-size:14px;font-style:normal !important">pág ';
			$footer.=$i;
			$footer.='</div>';
			$mpdf->SetHTMLFooter($footer);  



		}
		if($i==8){
			 $html='<html><body style="font-family: roboto" >';
			$html.='<div style="background:#fff;width:740px; float:left;margin-right:304px !important;border-collapse: collapse;">';

			$html.='<br><div style=" z-index:9999999;margin-top:100px;font-size:14px;width:800px;border-collapse: collapse;">';
				$html.='<table cellspacing=0  width="750">';
				
				foreach($data["report"]->ra as $pregunta=>$respuestas){
 					$html.='<tr>';
					$html.='<td style="font-size:14px;border-collapse: collapse;"><span style="font-size:14px;font-family:\'Roboto Ligth\'">'.utf8_decode($pregunta)."</span>";
						$html.='<br><table cellspacing=0  width="750">';
						$html.='<tr><td  style="height:30px"></td></tr>';
						$ids=1;
						foreach($respuestas as $respuesta){
							$html.='<tr>';
							$html.='<td style="font-size:14px;height:25px;font-family:\'Roboto Ligth\'"><span>'.$ids.'. </span>'.utf8_decode($respuesta).'<br>';
							$html.='</td>';
							$html.='</tr>';
							$ids++;
						}
						$html.='</table >'; 
					$html.='</td>';
					$html.='</tr>';
					
				}
				$html.='</table >';  
			$html.='</div>';
			$html.='</body></html>'; 
				
			$html = utf8_encode($html);   

			$mpdf->AddPage();$mpdf->WriteHTML($html);
			 
			 
			$mpdf->imageVars['pag'.$i] = file_get_contents('LOW/360-'.$i.'.jpg');	
			 
			$mpdf->Image('var:pag'.$i, 0, 0, 212, 290.3, 'jpg', '', true, false);
			$footer='<div style="z-index:999;margin-top:-52px;text-align:right;font-family: roboto !important;font-size:14px;font-style:normal !important">pág ';
			$footer.=$i;
			$footer.='</div>';
			$mpdf->SetHTMLFooter($footer);  



		}	   			
					

		

		 
 
 
 //echo $html;
	}	
 //exit; 
    //$mpdf->Output();
	$npmbreReporte="reporte ".date("Y-m-d H:i:s").".pdf";
    $mpdf->Output($npmbreReporte,"F" );   
	//header('Content-type: application/json');    
	echo 'envoltorio('.json_encode(array($npmbreReporte)).')';
	//sleep('30');
	//unlink($npmbreReporte);
	exit;
} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}    
