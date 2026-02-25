<?php echo preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post',array("id"=>"Form")));?>
 <div id="content" style="width:1200px;margin:0 auto">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
		<tr>
			<td style="padding:20px;border:1px solid #CCCCCC" align="left">
				<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
						<tr>
							<td>
								<div style="height:10px;">
								</div>
								<div style="height:10px;">
								</div>
								<table width='100%' border='0' cellpadding="0" cellspacing="0">
									<tr>
										<td width="40%">
											Nombre de colaborador: <?=($datosc->nombres.' '.$datosc->apellidos)?><br />
											Cargo:  <?=($datosc->nom_cargo)?><br />
											<?PHP 
												$idJefe = $datosc->idJefeFuncional;
												$correoUsuario = $datosc->email;
												$correoJefe = $datosjefe->email;
												$nombreJefe = $datosjefe->nombres." ".$datosjefe->apellidos;
												$nombreUsuario = $datosc->nombres." ".$datosc->apellidos;
												echo "Jefe: ".($nombreJefe);
											 ?>
										</td>
										<td height="50" width="50" align="center"><a href='javascript:window.print(); void 0;'><img src="<?=$imageurl?>impresora.png" alt=""  onmouseover="this.src='<?=$imageurl?>impresora2.png';"onmouseout="this.src='<?=$imageurl?>impresora.png';" title="Imprimir el reporte"></a></td>
									</tr>
								</table>
								<div class="divContentWhite">
									<div style="color:#003366;font-weight:bold; font-size:16px; text-align:center;padding:10px;">ESTABLECIMIENTO DE OBJETIVOS PARA DESARROLLO<div class="divContentWhite">Instrucciones<table width="100%" border="0" cellpadding="2" cellspacing="0"><tbody><tr><td style="text-align: left;"><br><p style="  text-align: left;">Para plantear sus objetivos de desarrollo y resultados, primero debe seleccionar aquellos comportamientos que en su informe consolidado de 
													resultados de la evaluacion de competencias aparecen como áreas de oportunidad.<br> En el siguiente listado de áreas de oportunidad dele click sobre aquellas
													casillas de los comportamientos que quiere desarrollar en este periodo, solo puede escoger maximo cuatro comportamientos por periodo.
													Cuando termine de seleccionar los cuatro comportamientos que va a trabajar en el periodo dele click en el boton guardar para continuar con el establecimiento
													de los objetivos</p></td></tr></tbody></table></div>
									</div>
									
									<table id="comportamientosTitulo" width="100%" border="0" cellspacing="2" cellpadding="0">
										<tbody><tr style="background-color: #F2F2F2">
											<td width="20%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">COMPETENCIAS</td>
											<td width="80%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">COMPORTAMIENTO A DESARROLLAR</td>
										</tr>
										</tbody>
									</table>
									<?php  //printVar($competencias);exit; ?>
									
									<table id="comportamientosCuerpo" width="100%" style="  border-spacing: 2px;  border-collapse: separate;" border="0" cellspacing="2" cellpadding="10">
										<?php $total=count($competencias); 
											for($i=0;$i<$total;$i++){
										?>
										<tr>
											<td width="20%" style="background-color: #F2F2F2">
											<?=$competencias[$i][0]?>
											</td>

											<td width="100%" style="text-align:center;">
												<ol>
													<table id="competenciasTable" width="100%" border="0" cellspacing="2" cellpadding="0">
														<tbody>
															
														<?php 
															$totalC=count($competencias[$i][1]); 
															$Data=$competencias[$i][1]; 
 															for($j=1;$j<=$totalC;$j++){
																$color="";
																if($j%2==0){
																	$color=' style="background-color:#F2F2F2" ';
																}
 																list($texto,$id)=explode("||",$Data[$j]);
														?>															
															
															<tr <?=$color?>>
																<td width="80%" style="text-align:justify;">
																	<li>
 																		<?=$texto?>
																	</li>
																</td>
																<td width="20%" style="text-align:center;">
																	<input type="checkbox"  name="fijar[]" value="<?=$id?>||<?=$competencias[$i][2]?>">
																		Fijar<br>
																</td>
															</tr>
															
														<?php } ?>
  														</tbody>
													</table>
												</ol>
											</td>
										</tr>
										<?php } ?>
										
									</table>
 								</div>
 							</td>
						</tr>
				</table>
				<table id="comportamientoAgregar" width="100%" border="0" cellspacing="2" cellpadding="10"><tbody><tr><td colspan="2"><input type="hidden" name="trime" value="1">

				<input type="button"  name="Guardar" value="Guardar">
				</td></tr></tbody>
				</table>
			
			</td>
		</tr>
	</table>
</div>
</form>
  <?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post'));?>

<script>
	jQuery(function(){
		jQuery("[name^='fijar']").click(function(){
			var obj=jQuery(this);
			var total=jQuery("[name^='fijar']:checked").size();
			if(total>4){
				alert("No se pueden elegir más de 4 casillas a la vez");
				return false;
			}
  			
		})
		jQuery('[name="Guardar"]').click(function(){
			var total=jQuery("[name^='fijar']:checked").size();
			if(total>0){
				if(confirm('Esta seguro que estos son los comportamientos a fijar en este periodo?')){
					
					jQuery.ajax({
					  method: "POST",
					  url: "<?=$rbase?>/index.php/admin/objetivos/AjaxAcciones/",
					  data: jQuery("#Form").serialize()+"&trimestre=<?=$trimestre?>"
					})
					  .done(function( data ) { console.log(data);
						if(data=="OK"){
 							var OBJ=jQuery('<?=$FORMTEM?><input type="hidden" name="trimestre" value="<?=$trimestre?>" ></form>');
 							var ruta="<?=$rbase?>index.php/admin/objetivos/trimestreFuncional/"; 
							OBJ.attr("action",ruta);
							OBJ.submit();							
 						}
					});							
 				}
			}else{
				alert("Por favor, seleecione al menos un comportamiento a desarrollar");
				return false;
 			}
			
		})
		
	});
	
	
</script>