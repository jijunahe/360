<?=json_encode($datosArray)?>
	<script type="text/javascript">
		var dats = <?=json_encode($datosArray)?>;
		var chart;
		jQuery(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					type: 'column'
				},
				title: {
					text: 'Porcentaje cumplimiento a objetivos'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: [
                    'Primer Periodo',
                    'Segundo Periodo',
                    'Tercer Periodo',
                    'Cuarto Periodo',
					]
				},
				yAxis: {
					min: 0, max: 100,
					title: {
						text: 'Porcentaje (%)'
					}
				},
				colors:["#0070C0","#C00000","#4F6228","#E46E0A"],
				legend: {
					//                layout: 'vertical',
					//                backgroundColor: '#FFFFFF',
					//                align: 'left',
					//                verticalAlign: 'top',
					//                x: 100,
					//                y: 70,
					//                floating: true,
					//                shadow: true
					enabled: false 
				},
				credits:{
					enabled: false
				},
				tooltip: {
					formatter: function() {
						return ''+ this.y +' %';
					}
				},
				plotOptions: {
					column: {
						dataLabels:{
							enabled: true
						},
						pointPadding: 0.2,
						borderWidth: 0
					}                
				},
                series: [{name: 'Porcentaje trimestral', data: dats}]
			});
		});
	</script>
	
	
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
                                            
                                            Nombre de colaborador: <?= ($nombreUsuario) ?> <br/>
                                            Cargo: <?= ($nombreCargo) ?> <br/>
                                            Jefe Funcional: <?= ($nombreJefe) ?> <br/>
										</td>
									</tr>
 										
										<tr><td style="background-color:#F2F2F2;padding:10px">								
											
											<div style="float:left;width:60%">									
												<div id="container" style="width:100%; height: 300px; margin: 0 auto"></div>									
											</div>
											<div style="float:left;width:36%;margin-left:1%;background-color:#FFF;">
												<table width="100%" border="0" cellpadding="2" cellspacing="1">
													<tr style="background-color: #F2F2F2">
														<td width="16%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
															Trimestres
														</td>
														<td width="16%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
															Fechas Trimestres
														</td>
														
														<td width="32%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
															Cumplimiento Objetivos Funcionales
														</td>
														<td width="16%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
															Total actividades fijadas
														</td>
														<td width="16%" class="text" style="color:#1F497D;font-weight:bold;text-align: center;">
															Cumplimiento Obtenido
														</td>
													</tr>
													<?php 
														$key=0;
														foreach($datosResumen as $dato){ 
															$color="#F2F2F2";
															if($key%2==0){$color="#fff";}
															$key++;
															
														?>
														<tr style="background-color:<?=$color?>">
															
															<td width="16%" style="font-size: 11px;text-align: center;"><b><?=$dato->nombreTrimestre?></b>
															</td>
															<td width="16%" style="font-size: 11px;text-align: center;"><?=$dato->periodoTrmiestre?>
															</td>
															
															<td width="32%" style="font-size: 11px;text-align: center;">
															</td>
															<td width="16%" style="font-size: 11px;text-align: center;"><?=$dato->totalCompetencias?>
															</td>
															<td width="16%" style="font-size: 11px;text-align: center;"><?=$dato->totalCumplimiento?>%
															</td>
															
														</tr>
													<?php }$promedio=1; if(count($datosResumen)>0){$promedio=count($datosResumen);} ?>
													<tr>
														<td colspan="4" style="color: #006699;">
															RESULTADO CONSOLIDADO ANUAL, CUMPLIMIENTO OBJETIVOS <?=($totalCumplido/$promedio)?>%
														</td>
														<td width="16%" style="color: #006699;">
															
														</td>
													</tr>
												</table>
											</div>	
											
											<div style="float:left;width:100%;">
 												Seleccione un Periodo: <select name="trimestre" id="trimestre" style="border: 1px; border-style: solid; border-color:gray; font-size: 12px;">
													<option >Por favor seleccione un periodo.
													</option>
 													<?
														foreach($rTrimestre as $dato2) { 
 															?>
															<option value="<?=$dato2->idTrimestre?>">
																<?=$dato2->nombreTrimestre?>
															</option>
															<?
 														}
													?>
												</select>			
 											</div>
  											<div style="float:left;width:100%; background-color:#fff" id="resseguimiento">
 											</div>
  											<div style="float:left;width:100%; background-color:#fff" id="log">
 											</div>
  										</td></tr>								
 								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
        <div>Este modulo ha sido elaborado con tecnolog&iacute;a de Talentracking&reg; Prohibida su reproducci&oacute;n total o parcial. info@talentracking.com</div>
	</div>
	<?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array(), 'post'));?>

<script>
	function Guardar(){
	
		jQuery("[name='terminarSeguimientoBTN']").click(function(){
			var periodo=jQuery(this).val();
			jQuery.ajax({
			method: "POST",
			url: "<?=$rbase?>/index.php/admin/objetivos/AjaxAcciones/",
			data:jQuery("#FormConfig").serialize()
			})
			.done(function( data ) {
				 
						if(data=="OK"){
							var OBJ=jQuery('<?=$FORMTEM?><input type="hidden" name="trimestre" value="<?=$trimestre?>" ></form>');
							var ruta="<?=$rbase?>index.php/admin/objetivos/seguimiento/"; 
							OBJ.attr("action",ruta);
							OBJ.submit();							
						}
 				});
			
		})

	
	
	}
	jQuery(function(){
		
		jQuery("#trimestre").change(function(){
			var periodo=jQuery(this).val();
			jQuery.ajax({
			method: "POST",
			url: "<?=$rbase?>/index.php/admin/objetivos/AjaxAcciones/",
			data: { "trimestre": periodo, geac: 1 }
			})
			.done(function( data ) {
			jQuery("#resseguimiento").html(data);
 			Guardar();
			EventoNumeros();
			});
			
		})
		
	});
	
	function Valores(objd){
		var Sumatoria=parseFloat(0);
		 
		 
		var objs=jQuery("#FormConfig [name^='seguimientoText_']");
		jQuery("#FormConfig [name^='seguimientoText_']").each(function(key){


			var numero=parseFloat(jQuery(this).val())
			if (isNaN(numero)) { 

			}else{ 
				Sumatoria+=numero;
			}  				
		});
		
 		var porcentajeAsignado=jQuery(objd).attr("name").split("_");
		
 console.log(jQuery(objd).val()+" "+porcentajeAsignado[2]);
		if(parseFloat(jQuery(objd).val())>parseFloat(porcentajeAsignado[2])){
			jQuery(objd).val(0);
			Sumatoria-=parseFloat(jQuery(objd).val());
			alert("El valor ingresado no puede ser mayor al porcentaje asignado");
		}
		
		if(Sumatoria>100){
			jQuery(objd).val(0);
			Sumatoria-=parseFloat(jQuery(objd).val());
			alert("la suma de los pesos debe ser  100");
		}
		
		//	console.log(Sumatoria);
		jQuery(".falta").text(Sumatoria+"/100")
		 		
	}
	
	function EventoNumeros(){
 		jQuery("[name^='seguimientoText_']").keydown(function (e) {
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
	 
 	
		jQuery("[name^='seguimientoText_']").keyup(function(e) {
		
			Valores(jQuery(this));			
 
 		});	
 	}
</script>