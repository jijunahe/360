
<style>
	.border{
		border: 1px solid #666;color: #1F497D;"
	}
</style>
<?php 
$edad="No ha definido fecha de nacimiendo";
if($usuario->fechanacimiento!=""){
	$dia=date(j);
	$mes=date(n);
	$ano=date(Y);

	//fecha de nacimiento
	list($a,$m,$d)=explode("-",$usuario->fechanacimiento);
	$dianaz=(int)$d;
	$mesnaz=(int)$m;
	$anonaz=(int)$a;

	//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

	if (($mesnaz == $mes) && ($dianaz > $dia)) {
	$ano=($ano-1); }

	//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

	if ($mesnaz > $mes) {
	$ano=($ano-1);}

	//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

	$edad=($ano-$anonaz);
}
$fechaev="";
if(isset($datosAB[0][0]["fecha"])){
	
	$fechaev=$datosAB[0][0]["fecha"];
	
}else if(isset($estres[0][0]["fecha"])){

	$fechaev=$estres[0][0]["fecha"];
}	
?>
<script>
	jQuery(function(){
		jQuery("[rel='print']").click(function(){
			jQuery(".menubar").hide();
			jQuery(".contentmenu").hide();
			jQuery(".maintitle").hide();
			jQuery(".footer").hide();
			jQuery(this).hide();
			setTimeout(function(){
				window.print();
				jQuery(".menubar").show();
				jQuery(".contentmenu").show();
				jQuery(".maintitle").show();
				jQuery(".footer").show();				
				jQuery("[rel='print']").show();				
				
			},200);
			
			 
		});
		
	})
	</script>
<div id="content">
		<div class="divContentBlue"><h3>Resultado</h3>
			  <div class="divContentWhite">
			<div style="float: right;"><img src="/bateria/img/print.png" style="cursor:pointer" rel="print" /></div>  
		<table width="100%" >
		 
			<tr style="    background-color: #EDEDFB;color:  #1F497D;">
				<td  style="border: 1px solid #666;color:  #1F497D;"   colspan="2"><center><h4><b>DATOS DEL TRABAJADOR</b></h4></center></td>
			</tr>
			<tr  >
				<td style="border: 1px solid #666;color:  #1F497D;">Nombre: <b><?=$usuario->nombres?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">No. Identificaci&oacute;n:<b><?=$usuario->documento?></b></td>
			</tr>
			<tr  style="background-color: #F2F2F2;">
				<td style="border: 1px solid #666;color:  #1F497D;">Cargo: <b><?=$usuario->nom_cargo?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">Departamento o secci&oacute;n: <b><?=$usuario->nom_area?></b></td>
			</tr>
			<tr >
				<td style="border: 1px solid #666;color:  #1F497D;">Edad:<b><?=$edad?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">G&eacute;nero: <b><?=$usuario->genero?></b></td>
			</tr>
			<tr style="background-color: #F2F2F2;">
				<td style="border: 1px solid #666;color:  #1F497D;">Fecha de evaluaci&oacute;n:<b><?=$fechaev?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">Fecha de informe : <b><?=date("Y-m-d")?></b></td>
			</tr>
			<tr style=" color:  #1F497D;">
				<td  style="border: 1px solid #666;color:  #1F497D;"   colspan="2">Nombre de la Empresa: <b><?=$usuario->nom_unidad?></b></td>
			</tr>
		</table>	<br> 
		
		
		<table width="100%" >
		 
			<tr style="    background-color: #EDEDFB;color:  #1F497D;">
				<td  style="border: 1px solid #666;color:  #1F497D;"   colspan="2"><center><h4><b>DATOS DEL EVALUADOR</b></h4></center></td>
			</tr>
			<tr  >
				<td style="border: 1px solid #666;color:  #1F497D;">Nombre: <b><?=$entrevistador->nombres?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">No. Identificaci&oacute;n: <b><?=$entrevistador->documento?></b></td>
			</tr>
			<tr  >
				<td style="border: 1px solid #666;color:  #1F497D;">Profesi&oacute;n: <b><?=$entrevistador->cargo?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">Postgrado: <b><?=$entrevistador->postgrado?></b></td>
			</tr>
			<tr  >
				<td style="border: 1px solid #666;color:  #1F497D;">No. Tarjeta Profesional: <b><?=$entrevistador->tarjetaprofesional?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;">No. Licencia en Salud Ocupacional: <b><?=$entrevistador->licencia?></b></td>
			</tr>
			 
		</table>	<br><br><br>
		
		
<?php 
	
 	
	foreach($datosAB as $encuesta){ 
		
		
?>


<table width="100%" >
 
	<tr style="background-color: #EDEDFB;color:  #1F497D;">
		<td  style="border: 1px solid #666;color:  #1F497D;"   colspan="6"><h4><b><?=$encuesta[0]["encuesta"]?> <?=$encuesta[0]["fecha"]?></b></h4></td>
	</tr>
	<tr style="background-color: #F2F2F2;">
		<td  style="border: 1px solid #666;color:  #1F497D;"   ><b>Dominio</b>
		</td>
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b>Dimensiones</b>
		</td>
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b>Puntaje bruto</b>
		</td>
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b>Factor transformador</b>
		</td> 
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b>puntaje transformado</b>
		</td> 
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b>Nivel de riesgo</b></td> 
 	</tr>
		<? 
		$tbruto=0;
		$tccriterio=0;
		$contador=0;
		$baremost=array();
		$tipo=0;
		foreach($encuesta[1] as $datos){ $totales=count($datos["dimensiones"]);  $contador++; 
			for($i=0;$i<$totales;$i++){
				if($i==0){
		?>
				<tr>
					<td rowspan="<?=$totales?>"  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["nombre"]?></b></td>
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["nombre"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["totalbruto"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["criterio"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["puntajetransformado"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #000;background-color:<?=$datos["dimensiones"][$i]["color"]?>" ><b><?=$datos["dimensiones"][$i]["baremos"]?></b></td> 
				</tr>
			
		<? 		}else{
		?>
				<tr>
 					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["nombre"]?></b>
						</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["totalbruto"]?></b>
					</td>
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["criterio"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$datos["dimensiones"][$i]["puntajetransformado"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #000;background-color:<?=$datos["dimensiones"][$i]["color"]?>" ><b><?=$datos["dimensiones"][$i]["baremos"]?></b></td>
				</tr>		
		
		
		
		<?    }
			}
 			$tbruto+=$datos["bruto"];
			$tccriterio+=$datos["criterio"];
			$tipo=$datos["tipo"];
   			?>
			
			<tr style="    background-color: #EDEDFB;">
				<td  style="border: 1px solid #666;color:  #000;background-color:<?=$datos["color"]?>"   colspan="2"><center><h4><b>Total Dominio</b></h4></center></td>
				<td style="border: 1px solid #666;color:  #000;background-color:<?=$datos["color"]?>" ><b><?=$datos["bruto"]?></b></td>
				<td style="border: 1px solid #666;color:  #000;background-color:<?=$datos["color"]?>" ><b><?=$datos["criterio"]?></b></td>
				<td style="border: 1px solid #666;color:  #000;background-color:<?=$datos["color"]?>" ><b><?=$datos["transformado"]?></b></td>
				<td style="border: 1px solid #666;color:  #000;background-color:<?=$datos["color"]?>" ><b><?=$datos["baremos"]?></b></td>
 			</tr>
	<?	} if( $contador>1){
			$transformado=round((($tbruto/$tccriterio)*100),2);
			if($tipo==1){
				$baremostrab=array(
									array("titulo"=>"Sin Riesgo o Riesgo Despreciable","a"=>0,"b"=>19.7,"color"=>"#81F781"),
									array("titulo"=>"Riesgo Bajo","a"=>19.8,"b"=>25.8,"color"=>"#F3F781"),
									array("titulo"=>"Riesgo Medio","a"=>25.9,"b"=>31.5,"color"=>"#F7FE2E"),
									array("titulo"=>"Riesgo Alto","a"=>31.6,"b"=>38,"color"=>"#FAAC58"),
									array("titulo"=>"Riesgo Muy Alto","a"=>38.1,"b"=>100,"color"=>"#FE2E2E"),
									);
 			}
			if($tipo==2){
				$baremostrab=array(
									array("titulo"=>"Sin Riesgo o Riesgo Despreciable","a"=>0,"b"=>20.6,"color"=>"#81F781"),
									array("titulo"=>"Riesgo Bajo","a"=>20.7,"b"=>26,"color"=>"#F3F781"),
									array("titulo"=>"Riesgo Medio","a"=>26.1,"b"=>31.2,"color"=>"#F7FE2E"),
									array("titulo"=>"Riesgo Alto","a"=>31.3,"b"=>38.7,"color"=>"#FAAC58"),
									array("titulo"=>"Riesgo Muy Alto","a"=>38.8,"b"=>100,"color"=>"#FE2E2E"),
									);
 			}
			 
			$i=0;
			$bandera=false;
			$totales=count($baremostrab);
			$itera=0;
			while($bandera==false){
				
				if($transformado>=$baremostrab[$i]["a"] and $transformado<=$baremostrab[$i]["b"] ){
 					$bandera=true;
					$itera=$i;
				}
				if($i>=$totales and $bandera==false){
					$bandera=true;
					$itera=0;
				}
				$i++;
			} 
			 
		?>
			<tr style="    background-color: #EDEDFB;">
				<td  style="border: 1px solid #666;color:  #1F497D; "   colspan="2"><center><h3><b>TOTAL GENERAL FACTORES DE RIESGO PSICOSOCIAL INTRALABORAL</b></h3></center></td>
				<td style="border: 1px solid #666;color:  #1F497D; " ><b><?=$tbruto?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D; " ><b><?=$tccriterio?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D; " ><b><?=$transformado?></b></td>
				<td style="border: 1px solid #666;color:  #000;background-color:<?=$baremostrab[$itera]["color"]?> " ><b><?=$baremostrab[$itera]["titulo"]?></b></td>
 			</tr>
	<? } ?>
</table><br><br><br>	
<?php } ?>


<?php 
	
 	
	foreach($estres as $encuesta){ 
 	 
		
?>
<table width="100%" >
 
	<tr style="    background-color: #EDEDFB;">
		<td  style="border: 1px solid #666;color:  #1F497D;"   colspan="6"><b><?=$encuesta[0]["encuesta"]?> <?=$encuesta[0]["fecha"]?></b></td>
	</tr>
	<tr style="    background-color: #F2F2F2;">
 		<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][0]["title"]?></b>
		</td> 
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][1]["title"]?></b>
		</td> 
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][2]["title"]?></b>
		</td> 
		<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][3]["title"]?></b></td> 
 	</tr>
		 
				<tr>
 					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][0]["value"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][1]["value"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #1F497D;" ><b><?=$encuesta[1][2]["value"]?></b>
					</td> 
					<td  style="border: 1px solid #666;color:  #000;background-color:<?=$encuesta[1][4]["value"]?>" ><b><?=$encuesta[1][3]["value"]?></b></td> 
				</tr>
			
		
 	
</table><br><br><br>	
<?php } ?>



		</div>
	</div>
</div>
