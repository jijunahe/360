
 
<div id="content" >
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
 
		<tr>
		<td>
			
		</td>
		</tr>
		<tr>
		<td height="5"></td>
		</tr>
		<tr>
		<td>
		<div class="divContentBlue">Seleccione un periodo - Por defecto se muestran los datos del periodo actual
			  <div class="divContentWhite">
 				<select name="per" id="sel_periodo"  style="border: 1px; border-style: solid; border-color:gray; font-size: 12px;">
					<option value=""  >
						Seleccione un periodo
					</option>					
					
					<?PHP
					
 					for($j=0;$j<count($perlas);$j++){
					$dato2 = $perlas[$j];
					 
					 
					?>					
				   <option value="<?PHP echo($dato2->id);?>" <?PHP if($dato2->id==$perid){echo('SELECTED');}?> >
						<?PHP echo($dato2->nombre)." (".$dato2->fini." ".$dato2->ffin.")";?>
					</option>
					 
					<?PHP					
					}					
					?>
					
											
				</select>
 			  </div>
		</div>	  
			<div class="divContentBlue">Evaluaciones Realizadas: <?php echo($realfalt->totalReal)?>   --   Evaluaciones Por Realizar: <?php echo($realfalt->totalFalt)?>
			  <div class="divContentWhite">
			  <table id="hor-minimalist-b" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                  <td class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Evaluado</td>
				  <td class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Relación</td>
                  <td class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Evaluador</td>
				  <td class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Comportamientos</td>
				  <td class="text" style="color:#1F497D;font-weight:bold;text-align: center;">RepComparativa</td>
                  <td class="text" style="color:#1F497D;font-weight:bold;text-align: center;">RepConsolidada</td>
                  
				  
                </tr>
				<?PHP
				$relacion = NULL;
				$evaluado = NULL;
				$evaluador = '';
				$fila = '';
				$filaeval = '';
				$filatr = '';
				$evafla = true;
				$imr = '<img border="0" src="'.$imageurl.'bred.png" title="NO Evaluacion"/>';
				$ime = '<img border="0" src="'.$imageurl.'bgre.png" title="Evaluacion" />';
				$imn = '<img border="0" src="'.$imageurl.'bneg.png" title="No Evalua al Jefe" />';
				$ima='';
				for($i=0;$i<count($listaa);$i++){
					$dato = $listaa[$i];
					$fila = '';
					$filaeval = '';
					$reval = 0;// saber si lo evaluaron
					$tab1 = '';
					$tab2 = '';
					$report = $dato->reporte;
					$criterios = $dato->criterios;
					$totaleva = count($report);
					$totalcri = count($criterios);
					if($evafla){
						$filatr = '<tr style="background-color: #F2F2F2;">';
					}else{
						$filatr = '<tr>';
					}
					//echo($ime);
					if($dato->autoevalusu == 0){	
						$fila = $filatr.'<td valign="middle" style="text-align:left;" ">'.$imr.''.utf8_decode($dato->nombre).'</td>';
					 }else{
						$fila = $filatr.'<td valign="middle" style="text-align:left;" ">'.$ime.''.utf8_decode($dato->nombre).'</td>';
					 }
					if($totaleva!=0){
					$tab1 = $tab1.'<td colspan="2" style="text-align:center;"><table style="width: 100%;">';
					//$tab2 = $tab2.'<td style="text-align:center;"><table style="width: 100%;">';
						for($j=0;$j<count($report);$j++){
							$dator = $report[$j];
							if($dator->lehicieroneval == 1){
								$reval=1;
								$ima=$ime;
							}else if($dator->realevalJefe == 1 && $dator->tipo == 3){
									$reval=1;
									$ima=$ime;
								}else{
									$ima=$imr;
								 
							}
							if($dator->evalua!=-1 && $dator->evalua==0){
								$ima = $imn;//para no mostrar los que no evaluan a su jefe
							}else{
								$tab1 = $tab1.'<tr><td style="text-align:center; width: 170px;">'.$dator->rel2.' </td><td style="text-align:left; width: 270px;">'.$ima.''.utf8_decode($dator->nombGen).'</td></tr>';
							}
							//$tab2 = $tab2.'<tr><td style="text-align:left;">'.$ima.''.utf8_decode($dator->nombGen).'</td></tr>';
							
					    }
						$tab1 = $tab1.'</table></td>';
						//$tab2 = $tab2.'</table></td>';
						$fila = $fila.$tab1;
						//$fila = $fila.$tab2;
					}else{
						$reval=0;
						$fila = $fila.'<td style="text-align:center;">-</td>'.
								'<td style="text-align:center;">-</td>';
					}
					
					$fila = $fila.'<td style="text-align:center; font-size: 9px;" >';
					if($totalcri!=0){
						for($k=0;$k<count($criterios);$k++){
							$datok = $criterios[$k];
							$fila = $fila.$datok->tipocriterio.'<br />';
					    }
					}else{
						$fila = $fila.' Sin Evaluar ';
					}
					$fila = $fila.'</td>';
					if(($dato->autoevalusu == 0 && $reval == 0) || $totalcri == 0){
					$fila = $fila.'<td><b style="color:red;">x</b></td>'.
							 '<td><b style="color:red;">x</b></td>'.
						     '</tr>';
					 }else{
						$fila = $fila.'<td><a href="javascript:;"  rel="repcom_'.$dato->id.'_'.$perid.'">repComp</a></td>'.
						'<td><a  href="javascript:;"   rel="repcon_'.$dato->id.'_'.$perid.'" >repCons</a></td>'.
						'</tr>';
					 }
					$fila = $fila.$filaeval;
					echo($fila);
					if($evafla){
						$evafla = false;
					}else{
						$evafla = true;
					}
				}
				?>
              </table> 
			</div>  
			</div>    
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</div>
  <?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post',array("target"=>"_blank")));?>

  <?php $FORMTEM2= preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post'));?>

 <script>

jQuery(function(){
	jQuery("[rel^='repcon_'],[rel^='repcom_']").click(function(){
 		var id=jQuery(this).attr("rel").split("_");
 		var OBJ=jQuery('<?=$FORMTEM?><input type="hidden" name="id" value="'+id[1]+'" ><input type="hidden" name="periodo" value="'+id[2]+'" ></form>');
	//	var OBJ=jQuery("<form method='post' action='<?=$rutasurvey?>"+suid+"' target='_blank' ><input type='hidden' name='idEncuestado' value='"+id[1]+"' ></form> ");
		var ruta="<?=$rbase?>index.php/admin/reportes/CompetenciasConsolidada/"; 
		console.log(id[0])
		if(id[0]=="repcom"){
 			ruta="<?=$rbase?>index.php/admin/reportes/CompetenciasComparativa/"; 
		}
		OBJ.attr("action",ruta);
		OBJ.submit();
 	});
	
	jQuery("#sel_periodo").change(function(){
 		var valor=jQuery(this).val();
 		var OBJ=jQuery('<?=$FORMTEM2?><input type="hidden" name="per" value="'+valor+'" ></form>');
	//	var OBJ=jQuery("<form method='post' action='<?=$rutasurvey?>"+suid+"' target='_blank' ><input type='hidden' name='idEncuestado' value='"+id[1]+"' ></form> ");
		var ruta="<?=$rbase?>index.php/admin/reportes/"; 
 		OBJ.attr("action",ruta);
		OBJ.submit();
 	})	
});
</script>