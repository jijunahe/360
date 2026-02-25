<style>
	ol{counter-reset: item;
	display: block;
	list-style-type: decimal;
	-webkit-margin-before: 1em;
	-webkit-margin-after: 1em;
	-webkit-margin-start: 0px;
	-webkit-margin-end: 0px;
	-webkit-padding-start: 40px;
	
	}
	ol li{
	font: 14px/21px Arial, Verdana;
	list-style: none;
	*list-style:decimal; /* IE7 e IE6*/
	padding:4px 8px;
	display: list-item;
	text-align: -webkit-match-parent;
	}
	ol li:before {
	display: inline-block;
	content: counter(item) ". ";
	counter-increment: item;
	font: bold 16px Arial, Verdana;
	padding: 0 4px;
	margin: 0 4px;
	}
	ol li ol li:before{
	font: bold 14px Arial, Verdana;
	padding: 0 2px;
	}
	
	
	#content-box{
	width:1200px;
	}
	#tableContent{
    border:1px solid #CCCCCC;
    border-collapse:collapse;
	font-size:11px;
	}
	#tableContent th {
    border:1px solid #CCCCCC;
    font-size:11px;
	}
	
	#tableContent td {
    border:1px solid #CCCCCC;
    font-size:11px;
	}
</style>


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
 								<div style="color:#003366;font-weight:bold; font-size:16px; text-align:center;padding:10px;">Módulo de objetivos y actividades a desarrollar por el colaborador<br>OBJETIVOS DE DESARROLLO </div>
 								<div style="clear:both"></div>		
								<table id="actividadTitulosTable" width="100%" border="0" cellspacing="0" cellpadding="0">
									<tbody><tr style="background-color: #F2F2F2">
										<td width="10%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Trimestre</td>
										<td width="20%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Objetivos-Metas a cumplir</td>
										<td width="11%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Fecha fin</td>
										<td width="49%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Descripción detallada de la actividad.</td>
										<td width="10%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Peso porcentual</td>
										
									</tr></tbody>
								</table>											
								<div style="color:#ff0000;font-weight:bold; font-size:14px; text-align:center;padding:10px;"> </div>		
								<table id="actividadContenidoTable" width="100%" style="border-color:#fff" border="1" cellspacing="1" cellpadding="0">
									<tbody>
										<?php
											$cookie = Yii::app()->request->cookies['YII_CSRF_TOKEN']->value;
											//printVar($cookie);
											$excluir=array();
											$contador=0;	
											foreach($desarrollo as $dato){
												array_push($excluir,$dato->idCompetencia);
												$color='';
												if($contador%2==0){
													$color='style="background-color: #ccccff"';
												}
												$contador++;												
											?>	 
											<tr <?=$color?>>
												<td width="10%" style="text-align:center;">
												<?=$dato->nombreTimestre?></td>
												<td width="20%" style="text-align:center;">
													<?=$dato->textoComportamiento?>
												</td>
												<td width="70%" style="text-align:center;">
													<table id="objetivosTable" width="100%" height="100%" border="0" cellspacing="0">
														<tbody>
															<tr>
																<td width="10%" style="text-align:center;">
																<?=$dato->fechaFinTrimestre?></td>
																<td width="42%" style="text-align:center;">
																	<?=$dato->textoActividad?>
																</td>
																<td width="10%" style="text-align:center;">
																	<?=$dato->porcentaje?>%
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="text-align:right;">
												</td>
												<td colspan="2" style="text-align:right;">
													<!--input type="submit" name="GrabarActividades" value="Grabar"-->
												</td>
											</tr>
										<?php } ?>	 
									</tbody>
								</table>										
							</div>	
 							<div class="divContentWhite">
								<div style="color:#003366;font-weight:bold; font-size:16px; text-align:center;padding:10px;">OBJETIVOS DE RESULTADOS</div>
								
								<div style="clear:both"></div>		
								<table id="actividadTitulosTable" width="100%" border="0" cellspacing="0" cellpadding="0">
									<tbody><tr style="background-color: #F2F2F2">
										<td width="10%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Trimestre</td>
										<td width="20%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Objetivos-Metas a cumplir</td>
										<td width="11%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Fecha fin</td>
										<td width="49%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Descripción detallada de la actividad.</td>
										<td width="10%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">Peso porcentual</td>
										
									</tr></tbody>
								</table>											
								<div style="color:#ff0000;font-weight:bold; font-size:14px; text-align:center;padding:10px;"> </div>		
								<table id="actividadContenidoTable2" width="100%" style="border-color:#fff" border="1" cellspacing="1" cellpadding="0">
									<tbody >
										<?php
											$cookie = Yii::app()->request->cookies['YII_CSRF_TOKEN']->value;
											//printVar($cookie);
											$contador=0;
											foreach($resultados as $dato){
												array_push($excluir,$dato->idCompetencia);
												$color='';
												if($contador%2==0){
													$color='style="background-color: #ccccff"';
												}
												$contador++;
											?>	 
											<tr <?=$color?>>
												<td width="10%" style="text-align:center;">
												<?=$dato->nombreTimestre?></td>
												<td width="20%" style="text-align:center;">
													<?=$dato->textoComportamiento?>
												</td>
												<td width="70%" style="text-align:center;">
													<table id="objetivosTable" width="100%" height="100%" border="0" cellspacing="0">
														<tbody>
															<tr>
																<td width="10%" style="text-align:center;">
																<?=$dato->fechaFinTrimestre?></td>
																<td width="42%" style="text-align:center;">
																	<?=$dato->textoActividad?>
																</td>
																<td width="10%" style="text-align:center;">
																	<?=$dato->porcentaje?>%
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="text-align:right;">
												</td>
												<td colspan="2" style="text-align:right;">
													<!--input type="submit" name="GrabarActividades" value="Grabar"-->
												</td>
											</tr>
										<?php } ?>
 										<tr>
											<td colspan="2" style="text-align:right;">
											</td>
											<td colspan="2" style="text-align:right;">
											</td>
										</tr>										
									</tbody>
								</table>
								<div style="clear:both"></div>
							</div>								
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<div style="clear:both"></div>
	<?php if($retroalimentacion[0]->idRetroalimentacion>0){}else{?>
		<?php echo preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post',array("id"=>"FormConfig")));?>
	<?php } ?>
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
							
							<div class="divContentWhite">
								Instrucciones<table width="100%" border="0" cellpadding="2" cellspacing="0">
									<tbody>
										<tr>
											<td style="text-align: left;">
												<br>
												<p>
													En esta etapa su jefe le debera entregar una retroalimentacion sobre los resultados de la evaluacion de competencias
													y sobre el avance que usted ha tenido en el cumplimiento de sus objetivos.<br>
													Para esto lea las instrucciones de los cuatro componentes de la
													retroalimentacion (continuar, iniciar, parar y retroalimentacion de colaborador a jefe.) Cuando haya diligenciado todas las casillas
													dele la opcion terminar del boton azul para que esta informacion quede fijada.<br>
													Se recomienda que vaya realizando guardados 
												provisionales dando click en el boton grabar para que su informacion no se pierda.</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
 							<div class="divContentWhite">
								<table id="continuarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
									<tbody>
										<tr>
											<td width="20%" class="text" style="background-color: #c8c890; text-align: center;">
												<b>CONTINUAR</b>
											</td>
											<td width="80%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
												<table id="continuarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
													<tbody>
														<tr style="background-color: #F2F2F2">
 															<td>
																Reconozca los objetivos, metas, actividades o tareas en las que el colaborador ha obtenido 
																buenos resultados, agradezcale e indique cómo esto aporta valor al cumpliemiento de 
																los objetivos organizacionales.
															</td>
														</tr>
														<tr>
															<td>
																<?php if($retroalimentacion[0]->idRetroalimentacion>0){
																	echo $objetivos[0]->textoObjetivo;
																}else{ ?>
																<textarea id="continuarText" name="continuarText<?=$cookie?>" value="" cols="107" rows="5"></textarea>
																<?php } ?>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>							 
 							<div class="divContentWhite">
								<table id="iniciarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
									<tbody>
										<tr>
											<td width="20%" class="text" style="background-color: #f1f14d; text-align: center;">
											<b>INICIAR</b></td>
											<td width="80%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
												<table id="continuarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
													<tbody>
														<tr style="background-color: #F2F2F2">
															<td>
															Retroalimente cuáles objetivos, metas, actividades o tareas el colaborador no esta cumpliendo,expliquele para qué es necesaria su implementación y el impacto que esto tendra en elcumplimiento de los objetivos Organizacionales.</td>
														</tr>
														<tr>
															<td>
																<?php if($retroalimentacion[0]->idRetroalimentacion>0){
																	echo $objetivos[1]->textoObjetivo;
																}else{ ?>
																<textarea id="iniciarText" name="iniciarText<?=$cookie?>" value="" cols="107" rows="5"></textarea>
																<?php } ?>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
  							<div class="divContentWhite">
								<table id="pararForm" width="100%" border="0" cellspacing="2" cellpadding="0">
 									<tbody>
										<tr>
 											<td width="20%" class="text" style="background-color: #f93b1e; text-align: center;color:#fff">
 												<b>PARAR</b>
											</td>
 											<td width="80%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
 												<table id="continuarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
 													<tbody>
														<tr style="background-color: #F2F2F2">
 															<td colspan="2">
 																Retroalimente actitudes, acciones, métodos de trabajo que no estan funcionando
																para el cumplimiento de los objetivos, metas o actividades establecidas: Acuerde 
																nuevas maneras de actuar que van a reemplazar las que no estan funcionando.
															</td>
														</tr>
 														<tr style="background-color: #F2F2F2">
 															<td style="text-align: center;">
 																Actitudes - Accciones - Métodos de trabajo que no estan funcionando
															</td>
 															<td style="text-align: center;">
 																Actitudes - Accciones - Métodos de trabajo que van a reemplazar a los que no estan funcionando
															</td>
														</tr>
 														<tr>
 															<td style="text-align: center;">
																<?php if($retroalimentacion[0]->idRetroalimentacion>0){
																	echo $actitud[0]->textoActitud;
																}else{ ?>
  																<textarea id="pararCol1Text" name="pararCol1Text<?=$cookie?>" value="" cols="52" rows="5"></textarea>
																<?php } ?>
															</td>
 															<td style="text-align: center;">
																<?php if($retroalimentacion[0]->idRetroalimentacion>0){
																	echo $actitud[0]->textoReemplazo;
																}else{ ?>
 																<textarea id="pararCol2Text" name="pararCol2Text<?=$cookie?>" value="" cols="52" rows="5"></textarea>
																<?php } ?>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<div class="divContentWhite">
								<table id="retroalimentarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
									<tbody>
										<tr>
											<td width="20%" class="text" style="background-color: #91b9b2; text-align: center;">
												<b>RETROALIMENTACIÓN COLABORADOR A JEFE    </b>               
											</td>
											<td width="80%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
												<table id="continuarForm" width="100%" border="0" cellspacing="2" cellpadding="0">
													<tbody>
														<tr style="background-color: #F2F2F2">
															<td colspan="2">
															Obtenga retroalimentación del entrevistado sobre su estilo de gestión y                                liderazgo (Fortalezas y Áreas de oportunidad)                            </td>
														</tr>
														<tr style="background-color: #F2F2F2">
															<td style="text-align: center;">
															Fortalezas                            </td>
															<td style="text-align: center;">
															Áreas de oportunidad                            </td>
														</tr>
														<tr>
															<td style="text-align: center;">
																<?php if($retroalimentacion[0]->idRetroalimentacion>0){
																	echo $jefe[0]->textoGestion;
																}else{ ?>
																
																<textarea id="retFortalezaText" name="retFortalezaText<?=$cookie?>" value="" cols="52" rows="5"></textarea>
																<?php  } ?>
															</td>
															<td style="text-align: center;">
																<?php if($retroalimentacion[0]->idRetroalimentacion>0){
																	echo $jefe[0]->textoAreaOportunidad;
																}else{ ?>
 																<textarea id="retOportunidadText" name="retOportunidadText<?=$cookie?>" value="" cols="52" rows="5"></textarea>
																<?php  } ?>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<?php if($retroalimentacion[0]->idRetroalimentacion>0){}else{?>
											
											<tr>
												<td colspan="2" style="text-align: center;">
													<input type="button" id="terminar"  value="Terminar">
												</td>
											</tr>
										<?php  } ?>
									</tbody>
								</table>
							</div>
 							<?php if(!isset($reporteobjetivo->idUsuario) and $retroalimentacion[0]->idRetroalimentacion>0){?>
								<div class="divContentWhite">
 									<div style="color:#003366;font-weight:bold; font-size:13px; text-align:left;padding:10px;">
										Estamos de 
										acuerdo con los objetivos, metas, acciones y porcentajes establecidos; así como los acuerdos de mejoramiento establecidos 
									y la retroalimentación entregada.</div>
									<table id="aceptarAcuerdoTable" width="100%" border="0" cellspacing="2" cellpadding="0">
										<tbody>
											<tr>
												<td width="40%"  style="text-align:justify; font-size:13px;color:#003366;">
													<div style="color:#003366;font-weight:bold; font-size:13px; text-align:left;padding:10px;">
														Si es así 
													marque la siguiente casilla de confirmación y escriba los correos del colaborador y del jefe; los cuales son campos obligatorios para poder enviar la imagen de los objetivos y la retroalimentación entregada.</div>
												</td>
												<td width="5%" style="text-align:justify;">
													<input type="checkbox"   name="acepto" value="acepto">
													<br>
												</td>
												<td width="45%" style="text-align:justify;">
													<div style="color:#003366;font-weight:bold; font-size:13px; text-align:left;padding:10px;">
														correo colaborador:<input type="text" name="correoUsuario<?=$cookie?>" value="<?=$datosc->email?>">
														<br>
														correo Jefe:<input type="text" name="correoJefe<?=$cookie?>" value="<?=$datosjefe->email?>">
														<br>
													</div>
												</td>
												<td width="10%" style="text-align:justify;">
													<input type="button" name="enviarBtn" value="Enviar" >
													<input type="hidden" name="notificar" value="1">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							<?php  } ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<input type="hidden" name="retroalimentar">
	<?php if($retroalimentacion[0]->idRetroalimentacion>0){}else{?>
	</form>
<?php } ?>
</div>
<input type="hidden" name="paramcom" />

<div style="display:none" id="modales">
	
	
	
</div>


<?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array(), 'post'));?>
<?php $FORMTEM2= preg_replace('/\n+/', ' ', CHtml::form(array("id"=>"formu"), 'post',array("id"=>"formu")));?>

<script>
	<?php if(!isset($reporteobjetivo->idUsuario) and $retroalimentacion[0]->idRetroalimentacion>0){?> 
		function validarEmail( email ) {
			expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if ( !expr.test(email) ){
			alert("Error: La dirección de correo " + email + " es incorrecta.");return false;
			}else{return true;}
		}
		jQuery(function(){
			jQuery("[name='enviarBtn']").click(function(){
				var checked=jQuery("[name='acepto']").is(":checked");
				if(checked){
					if(jQuery("[name='correoUsuario<?=$cookie?>']").val()==""){}else{
						if(!validarEmail( jQuery("[name='correoUsuario<?=$cookie?>']").val())){return false}
					}
						
					if(jQuery("[name='correoJefe<?=$cookie?>']").val()==""){}else{
						if(!validarEmail( jQuery("[name='correoJefe<?=$cookie?>']").val())){return false}
					}
					 
					jQuery.ajax({
						method: "POST",
						url: "<?=$rbase?>/index.php/admin/objetivos/AjaxAcciones/",
						data: {correoUsuario<?=$cookie?>:jQuery("[name='correoUsuario<?=$cookie?>']").val(),correoJefe<?=$cookie?>:jQuery("[name='correoJefe<?=$cookie?>']").val(),trimestre:"<?=$trimestre?>",notificar:1}
					})
					.done(function( data ) {  
						if(data=="OK"){
							var OBJ=jQuery('<?=$FORMTEM?><input type="hidden" name="trimestre" value="<?=$trimestre?>" ></form>');
							var ruta="<?=$rbase?>index.php/admin/objetivos/trimestreFuncional/"; 
							OBJ.attr("action",ruta);
							OBJ.submit();							
						}
					});					
					
				}else{
					alert("Debe aceptar los términos y condiciones");
				}
			});
			
			
		});
	<?php } ?>
	<?php if($retroalimentacion[0]->idRetroalimentacion>0){}else{?>
		
		function guardar(){
			jQuery('#terminar').click(function(){
				
				var valida=true;
				if(jQuery("[name='continuarText<?=$cookie?>']").val()==""){
					alert("Por favor asegurese de llenar todos los campos");
					return false
				}					
				
				
				if(jQuery("[name='iniciarText<?=$cookie?>']").val()==""){
					alert("Por favor asegurese de llenar todos los campos");
					return false
				}					
				
				if(jQuery("[name='pararCol1Text<?=$cookie?>']").val()==""){
					alert("Por favor asegurese de llenar todos los campos");
					return false
				}					
				
				if(jQuery("[name='pararCol2Text<?=$cookie?>']").val()==""){
					alert("Por favor asegurese de llenar todos los campos");
					return false
				}					
				
				
				if(jQuery("[name='retFortalezaText<?=$cookie?>']").val()==""){
					alert("Por favor asegurese de llenar todos los campos");
					return false
				}	
				
				if(jQuery("[name='retOportunidadText<?=$cookie?>']").val()==""){
					alert("Por favor asegurese de llenar todos los campos");
					return false
				}					
				
				
				if(valida==true){
					if(confirm('Esta seguro de la informacion escrita en la retroalimentacion realizada?')){
						
						jQuery.ajax({
							method: "POST",
							url: "<?=$rbase?>/index.php/admin/objetivos/AjaxAcciones/",
							data: jQuery("#FormConfig").serialize()+"&trimestre=<?=$trimestre?>"
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
					alert("Por favor, asegurese de llenar bien el formulario");
					return false;
				} 
				
				});		
			}
			jQuery(function(){
				
				
				guardar();
			});
		<?php } ?>
		
		
		
		
	</script>	