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


<?php echo preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post',array("id"=>"FormConfig")));?>
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
								
									<div style="color:#003366;font-weight:bold; font-size:16px; text-align:center;padding:10px;">Módulo de objetivos y actividades a desarrollar por el colaborador<br>OBJETIVOS DE DESARROLLO <br>Instrucciones</div>
								
 									<table width="100%" border="0" cellpadding="2" cellspacing="0"><tbody><tr><td style="text-align: left;"><br><p>Para plantear las acciones de desarrollo y los objetivos de cumplimiento tenga en cuenta los siguientes pasos:</p><ol>
										<li>
										Establezca las acciones de mejoramiento para los comportamientos seleccionados; estas acciones deben poderse observar y medir
										de alguna manera.
										</li>
										<li>
										Despues de planteadas cada una de las acciones dele guardar para que quede fijada en la base de datos.
										</li>
										<li>
										Si necesita mas casillas de texto para plantear nuevas acciones dele click en el signo mas de color verde que aparece en 
										la parte inferior.
										</li>
										<li>
										Cuando termine de plantear las acciones de desarrollo para cada uno de los comportamientos de desarrollo, plantee los objetivos
										de resultados dando click en el link "Haga click aca para ingresar los objetivos de resultados."
										</li>
										<li>
										Recuerde que estos objetivos se deben plantear en verbos de accion con un resultado numérico, un tiempo o fecha de cumplimiento
										y deben ser cumplibles en el trimestre.
										</li>
										<li>
										Cada vez que fije un objetivo haga click en el boton agregar para que quede en la base de datos y al final haga click en el boton
										terminar para regresar al formulario y plantear las acciones de cumplimiento.
										</li>
										<li>
										Establezca las acciones de cumplimiento para los objetivos planteados; estas acciones deben poderse observar y medir
										de alguna manera.
										</li>
										<li>
										Despues de planteadas cada una de las acciones dele guardar para que quede fijada en la base de datos.
										</li>
										<li>
										Si necesita mas casillas de texto para plantear nuevas acciones dele click en el signo mas de color verde que aparece en 
										la parte inferior.
										</li>
										<li>
										Cuando termine de plantear las acciones para el cumplimiento de cada uno de los objetivos establezca los pesos porcentuales de cada accion en las casillas
										correspondientes.
										</li>
										<li>
										Cuando termine de establecer los pesos porcentuales haga click en el boton terminar de color azul ubicado en la parte inferior del formulario.
										</li>
										<li>
										Despues de dar la opcion terminar aparecera un mensaje de aceptacion de los objetivos y acciones planteados, si esta de acuerdo dele aceptar; sino
										dele cancelar para editar algunas acciones o porcentajes propuestos.
										</li>
										</ol></td></tr></tbody>
									</table>
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
											foreach($desarrollo as $dato){
												array_push($excluir,$dato->idCompetencia);
										?>	 
											<tr style="background-color: #ccccff">
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
																	<textarea  name="actividad<?=$cookie?>[]" value="" cols="40" rows="2"></textarea>
																	<input type="hidden" name="trime" value="1">
																</td>
																<td width="10%" style="text-align:center;">
																	<div class="falta"></div><input type="text" id="PESO_PORCENTUAL550" name="peso<?=$cookie?>[]" maxlength="20" size="5">
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
											<input type="hidden" name="index<?=$cookie?>[]" value="D-<?=$dato->idTrimestre?>-<?=$dato->idComportamiento?>-<?=$dato->idCompetencia?>-<?=$dato->idCriterio?>-" >
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
											foreach($resultados as $dato){
												array_push($excluir,$dato->idCompetencia);
										?>	 
											<tr style="background-color: #ccccff">
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
																	<textarea  name="actividad<?=$cookie?>[]" value="" cols="40" rows="2"></textarea>
																	<input type="hidden" name="trime" value="1">
																</td>
																<td width="10%" style="text-align:center;">
																	<div class="falta"></div><input type="text" id="PESO_PORCENTUAL550" name="peso<?=$cookie?>[]" maxlength="20" size="5">
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
											<input type="hidden" name="index<?=$cookie?>[]" value="R-<?=$dato->idTrimestre?>-<?=$dato->idComportamiento?>-<?=$dato->idCompetencia?>-0-" >
										
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
									<div id="adesarrollar"></div>
									
									<table width="100%" style="border-color:#fff" border="1" cellspacing="1" cellpadding="0">
										<tr>
											<td colspan="2" style="text-align:right;">
												</td>
											<td colspan="2" style="text-align:right;">
												<input type="button"  name="agregar" value="Agregar objetivo a desarrollar">
											</td>
										</tr>
									
									
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
<input type="hidden" name="paramcom" />
</form>
<div style="display:none" id="modales">
	<div id="agob">
 		Objetivo:<br>
		<textarea   name="comportamiento" cols="60" rows="7"></textarea><br>
		<!--select id="idCompetencia" name="idCompetencia">
			<option value="-1" >Seleccione una competencia</option>
			<?php foreach($critsComps as $data){  ?>
				
				
				<option value="<?=$data->cr_id?>"><?=$data->cr_nombre?> </option>
				
			<? } ?>
		</select-->
		<input name="agregarn" type="button" value="Agregar"> 
  	</div>
	
	<div id="nuevoObjetivo">
		<table width="100%" style="border-color:#fff" border="1" cellspacing="1" cellpadding="0">
		<tr style="background-color: #ccccff">
			<td width="10%" style="text-align:center;" class="nombretrimestre">
			</td>
			<td width="20%" style="text-align:center;" class="com">
				 
			</td>
			<td width="70%" style="text-align:center;">
				<table id="objetivosTable" width="100%" height="100%" border="0" cellspacing="0">
					<tbody>
						<tr>
							<td width="10%" style="text-align:center;" class="fecha">
							 </td>
							<td width="42%" style="text-align:center;">
								<textarea class="actividad" name="actividad<?=$cookie?>[]" value="" cols="40" rows="2"></textarea>
								<input type="hidden" name="trime" value="1">
							</td>
							<td width="10%" style="text-align:center;">
								<div class="falta"></div><input type="text"  name="peso<?=$cookie?>[]" maxlength="20" size="5">
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
		<input type="hidden"  class="data" name="index<?=$cookie?>[]" value="" >
		</table>
	</div>
	
	
	
	
	
</div>


  <?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array(), 'post'));?>
  <?php $FORMTEM2= preg_replace('/\n+/', ' ', CHtml::form(array("id"=>"formu"), 'post',array("id"=>"formu")));?>

<script>
	function Valores(objd){
		var Sumatoria=parseFloat(0);
		 
		 
		var objs=jQuery("#FormConfig [name^='peso<?=$cookie?>']");
		jQuery("#FormConfig [name^='peso<?=$cookie?>']").each(function(key){


			var numero=parseFloat(jQuery(this).val())
			if (isNaN(numero)) { 

			}else{ 
				Sumatoria+=numero;
			}  				
		});
		if(Sumatoria>100){
			jQuery(objd).val(0);
			Sumatoria-=jQuery(objd).val();
			alert("la suma de los pesos debe ser  100");
		}
		
		//	console.log(Sumatoria);
		jQuery(".falta").text(Sumatoria+"/100")
		 		
	}
	
	function EventoNumeros(){
 		jQuery("[name^='peso<?=$cookie?>']").keydown(function (e) {
 			if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A
				 (e.keyCode == 65 && e.ctrlKey === true) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
 					Valores(jQuery(this)) 
 					return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
 			}	
		});
	 
 	
		jQuery("[name^='peso<?=$cookie?>']").keyup(function(e) {
		
			Valores(jQuery(this))			
 
 		});	
 	}
	
	function guardarnuevoObjetivo(){
		jQuery("#nuevob [name='agregarn']").click(function(){
			var Texto=jQuery("#nuevob [name='comportamiento']").val();
			/*if(jQuery("#nuevob  #idCompetencia").val()==-1){
				alert("Por favor, seleccione una competencia"); return false;
			}*/
			if(Texto!=""){
			
				jQuery.ajax({
				  method: "POST",
				  dataType:"json",
				  url: "<?=$rbase?>/index.php/admin/objetivos/AjaxAcciones/",
				  data: jQuery("#formu").serialize()+"&trimestre=<?=$trimestre?>"
				})
				  .done(function( data ) { console.log(data);
					if(data.res=="ok"){
						var HTML=jQuery("#nuevoObjetivo").html();
						var obj=jQuery(HTML);
						obj.find(".fecha").html(data.fechaFinTrimestre);
						obj.find(".nombretrimestre").html(data.nombreTrimestre);
						obj.find(".com").html(data.texto);
						var dato="R-"+data.idTrimestre+"-"+data.idComportamiento+"-0-0-";
						obj.find(".data").val(dato);
 						jQuery("#adesarrollar").append(obj.html());
						alert("El objetivo se ha agregado satisfactoriamente");
						jQuery("#nuevob [name='comportamiento']").val("");
						jQuery("#nuevob [name='idCompetencia'] option:eq(0)").attr("selected","selected");
						EventoNumeros();
					}
				});				
			
				
			}else{
					alert("Por favor describa el objetivo");
			}
			
		});
	}
	
	
	function guardarObjetivos(){
		jQuery('[name="Guardar"]').click(function(){
			var objs=jQuery("#FormConfig [name^='peso<?=$cookie?>']");
			var objsActividad=jQuery("#FormConfig [name^='actividad<?=$cookie?>']");
			var conteoNullac=0;
			jQuery.each(objsActividad,function(key){
				var dato=jQuery(objsActividad[key]).val();
				if (dato!="") { 
					
				}else{ 
 					conteoNullac++;
					console.log("ac"+key)
 				} 					
			});
			var valida=true;
			var Sumatoria=0;
			var conteoNullpe=0;
			jQuery.each(objs,function(key){
				var numero=parseFloat(jQuery(objs[key]).val())
				if (isNaN(numero)) { 
					
				}else{ 
 					Sumatoria+=numero;
 				}
				if(jQuery(objs[key]).val()==""){
					conteoNullpe++;
					valida=false;
				}
			});

			if(Sumatoria!=100  ){
				alert("la suma de los pesos debe ser  100");
				valida=false;
				return false
			}					

			 					

			if(conteoNullpe>0 || conteoNullac>0){
			    valida=false;
				alert("Asegurese de llenar todos los campos");return false
			}
			
   			if(valida==true){
				if(confirm('Esta seguro que estos comportamientos tienen la informaciòn correcta?')){
					
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
 		EventoNumeros();
		guardarObjetivos();
		jQuery("[name='agregar']").click(function(){
			var Obj=jQuery("#agob").html();
			 
			 jQuery.colorbox({html:'<div id="nuevob"><?=$FORMTEM2?><input type="hidden" name="nuevoobjetivo" />'+Obj+'</form></div>',width:"40%",height:"270px"});
			 guardarnuevoObjetivo();
			
		})
 	});
	
	
</script>