<link rel="stylesheet" href="/bateria/scripts/admin/colorbox/example1/colorbox.css" />
<script src="/bateria/scripts/admin/colorbox/jquery.colorbox.js"></script>

<style type="text/css"> 
	#content-box{
	width:940px;
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
.add{
    background-color:#EDEDFB;	
 }
</style>
<script>
$(function() {
	$( "#fechaini" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
	$( "#fechafin" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
	$( ".fechaformat" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
	
	jQuery("#addp").click(function(){
 		evePoblacion();

 	});
	jQuery("[id^='agregar_']").click(function(){
		var id=jQuery(this).attr("id").split("_")[1];
 		evePoblacion("id",id,"usprogramados");
  	});
	jQuery("[id^='poblacion_']").click(function(){
		var id=jQuery(this).attr("id").split("_")[1];
 		evePoblacion("id",id,"usprogramados","poblacion");
  	});
 	jQuery("[id^='resuelto_']").click(function(){
		var id=jQuery(this).attr("id").split("_")[1];
 		evePoblacion("id",id,"usprogramados","resuelto");
  	});
 	jQuery("[id^='restante_']").click(function(){
		var id=jQuery(this).attr("id").split("_")[1];
 		evePoblacion("id",id,"usprogramados","restante");
  	});
 	jQuery("[id^='guardar_']").click(function(){
		var id=jQuery(this).attr("id").split("_")[1];
 		evePoblacion("id",id,"usprogramados","guardar",jQuery("#poblacion").val());
  	});
 	jQuery("[id^='eliminar_']").click(function(){
		var id=jQuery(this).attr("id").split("_")[1];
 		evePoblacion("id",id,"usprogramados","eliminar",jQuery("#poblacion").val());
  	});
 	$( "#fechaini,#fechafin" ).change(function(){
		var test1=jQuery("#fechaini").val().split("-");
		var test2=$( "#fechafin" ).val().split("-");
		var fechaInicial = new Date(test1[0], test1[1], test1[2]), 
		valorFechai = fechaInicial.valueOf(),
		fechaFinal = new Date(test2[0], test2[1], test2[2]),
		valorFechaf = fechaFinal.valueOf();
		diferencia=valorFechaf-valorFechai;
 		if(diferencia<0){
			alert("La fecha final debe ser mayor que la fecha inicial");
			jQuery(this).val("");
		}
 	});
	
 	$( "[name^='fechaini_'],[name^='fechafin_" ).change(function(){
		var idf=jQuery(this).attr("name").split("_")[1]
		
		var fini=jQuery("[name='fechaini_"+idf+"']").val();
		var ffin=jQuery( "[name='fechafin_"+idf+"']" ).val();
		
		var test1=fini.split("-");
		var test2=ffin.split("-");
		
		var fechaInicial = new Date(test1[0], test1[1], test1[2]), 
		valorFechai = fechaInicial.valueOf(),
		fechaFinal = new Date(test2[0], test2[1], test2[2]),
		valorFechaf = fechaFinal.valueOf();
		diferencia=valorFechaf-valorFechai;
 		if(diferencia<0){
			alert("La fecha final debe ser mayor que la fecha inicial");
			jQuery(this).val("");
		}else{
 			var url="/bateria/index.php/admin/encuestas/programacion/";
			var pars = { op : "acfecha",id:idf,fechaini:fini,fechafin:ffin};
 			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: true,
				url: url,
				data:pars,
				success:function(res){}
			});
 			
		}
 	});
	
	
	
	
});

function evePoblacion(){
		var url="/bateria/index.php/admin/encuestas/programacion/";
		var pars = { op : "uss"};
		var modal=true;
		var t3=false;
 		if(arguments[0]!=undefined){
			var datof=arguments[1];
			var caseop=arguments[2];
			var innerif="";
			var poblar="";
			
			if(arguments[3]!=undefined){
				innerif=',innerif:"'+arguments[3]+'"';
				t3=true;
 			}
			if(arguments[4]!=undefined){
				poblar=',poblar:"'+arguments[4]+'"';
				modal=false;
 			}
 			eval('pars={ op : "'+caseop+'",'+arguments[0]+':"'+datof+'"'+innerif+poblar+'}');
 		}else{
			t3=false;
		}
		
		var pobtest=jQuery("#poblacion").val().split(",");
		
		jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: url,
			data:pars,
			success:function(res){
 				if(modal==true && res.usuarios.length>0){
					var select="Filtrar por Área:<select id='area'>";
					jQuery.each(res.areas,function(key,dato){
						select+="<option value='"+dato.id+"'>";
							select+=dato.nombre;
						select+="</option>";
					});
					select+="</select>  Documento o Nombre <input type='text' name='dato'/><input type='button' rel='buspob' value='Buscar' />";
					var html=select+"<br><center><h5><b>Por favor, de las siguientes personas seleccione una o más para realizar la encuesta</b></h5><br><table cellpadding='0' cellspacing='0' border='1' width='100%'>";
						html+="<tr>";
							//html+="<td><input type='checkbox' name='todo' /></td>";
 							if(t3==false){html+="<td></td>";}
 							html+="<td><b>Documento</b></td>";
							html+="<td><b>Nombres</b></td>";
							html+="<td><b>Area</b></td>";
						html+="</tr>";
					jQuery.each(res.usuarios,function(key,dato){
						var classt="";
						var add="";
						if(pobtest.indexOf(dato.uid)>=0){
							classt="add";
							add="checked='checked'";
						}
						
							if(t3==false){
								html+="<tr  style='cursor:pointer' class='"+classt+"'>";
								html+="<td><input type='checkbox' name='pob[]' value='"+dato.uid+"' "+add+"/></td>";
							}else{
								html+="<tr  style='cursor:pointer' rel='resultado_"+dato.uid+"' class='"+classt+"'>";
							}
							html+="<td>"+dato.documento+"</td>";
							html+="<td>"+dato.nombres+"</td>";
							html+="<td>"+dato.area+"</td>";
						html+="</tr>";
					});
					if(t3==false){html+="</table></center><input type='button' rel='agregar_poblacion' value='Agregar'/>";}
					jQuery.colorbox({html:html,width:"70%", height:"70%", scroll:"true" }); 
					jQuery("[name*='pob']").bind("click",function(){ 
						if(jQuery(this).is(":checked")){
							jQuery(this).parent().parent().addClass("add");
						}else{
							jQuery(this).parent().parent().removeClass();
						}
					});
				
				}else{ 
				    if(res.usuarios==""){
						res="No hay datos";
 					}
 					jQuery.colorbox({html:res}); 
 					jQuery("#cboxClose,#cboxOverlay").click(function(){
 						jQuery.colorbox.close();
						setTimeout(function(){location.reload();},200);
					});
				}
 			}
		});	
		
		
		jQuery("#area").change(function(){
 			evePoblacion("area",jQuery(this).val(),"uss");
 		});
 
		jQuery("[rel='buspob']").click(function(){
 			evePoblacion("dato",jQuery("[name='dato']").val(),"uss");
  		});	
	
		jQuery("[rel='agregar_poblacion'],#cboxClose,#cboxOverlay").click(function(){
			var pob=[];
			var probar=jQuery("#poblacion").val().split(",");
			
			jQuery("[name='pob[]']:checked").each(function(key,dato){ 
				//if(probar.indexOf(jQuery(dato).val())<0){
					pob.push(jQuery(dato).val());
				//}
			});
			jQuery("#poblacion").val(pob.join(","));			
			
			
			jQuery.colorbox.close();
   		});	
	
		jQuery("[name='todo']").click(function(){
			if(jQuery(this).is(":checked")){
				jQuery("[name='pob[]']").each(function(key,dato){ 
					 jQuery(dato).attr("checked","checked");
					 jQuery(dato).parent().parent().addClass("add");
				});
			}else{
				jQuery("[name='pob[]']").each(function(key,dato){
					var id=jQuery(dato).val();
					var parent=jQuery(dato).parent();
 					 jQuery(dato).parent().parent().removeClass("add");
					 jQuery(dato).remove();
					 jQuery(parent).html("<input type='checkbox' name='pob[]' value='"+id+"'/>");
				});
			}
    	});
		jQuery("[rel^='resultado_']").click(function(){
			var id=jQuery(this).attr("rel").split("_")[1];
			jQuery("#res").html("<input type='hidden' name='idus' value='"+id+"' />");
			jQuery("#formResu").submit();
		});
		
 }
 
</script>
 <?php echo CHtml::form(array("admin/usuarios/resultado/"), 'post', array('class'=>'formResu', 'id'=>'formResu')); ?>
	<div id="res" style="display:none"></div>
 </form>
  <div id="content">
  	<div class="divContentBlue">
		<h3><b>Historico de <? echo $datae->surveyls_title;?>	</b></h3>
		
		<? if($mensaje!=""){ ?><div class="divContentBlue"><div class="divContentWhite"><h3><b> <? echo $mensaje;?></b></h3></div></div> <? }?>			  
		<div class="divContentWhite">
 		 <?php echo CHtml::form(array("admin/programar/"), 'post', array('class'=>'view', 'id'=>'formActivo')); ?>
				<div style="display:none" >
 					<input type="hidden" value="<?php echo $sid;?>" name="sid">
				</div> 			  
 				<?php if(isset($enc[0]->id)){ ?>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
					<tbody>
					<tr>
						<td width="40"><b>Item</b></td>
						<td><b>Fecha Inicio</b></td>
						<td><b>Fecha Fin</b></td>
						<td><b>Creador</b></td>
						<td><b>Empresa</b></td>
						<td><b>Población</b></td>
						<td><b>Resueltos</b></td>
						<td><b>Restantes</b></td>
 						<td><b>Descripción</b></td>
 						<td><b>Agregar población</b></td>
 						<td><b>Guardar</b></td>
						<td><b>Eliminar</b></td>
 					</tr>
					</tbody>
					<?php 
					$i=0;
 					foreach($enc as $data){ 
						$encmod = new CDbCriteria;
						$encmod->condition = 'id='.$data->id_unidad;
						$enc = EvalUnidades::model()->find($encmod);
						
						$mus = new CDbCriteria;
						$mus->condition = 'uid='.$data->iduscrea;
						$uscre = User::model()->find($mus);
						
						 
						
						?>
					<tr>
						<td width="40"><? echo $data->id;?></td>
						<td><input type="text" value="<?=$data->fechaini?>" class="fechaformat" name="fechaini_<? echo $data->id;?>"  id="fechaini_<? echo $data->id;?>" /></td>
						<td><input type="text" value="<?=$data->fechafin?>" class="fechaformat" name="fechafin_<? echo $data->id;?>"  id="fechafin_<? echo $data->id;?>" /></td>
  						<td><b><? echo $uscre->full_name;?></b></td>
  						<td><b><? echo $enc->nombre;?></b></td>
  						<td><input type="button" id="poblacion_<? echo $data->id;?>" value="<? echo $indicador[$i]["encuestados"];?> ver"/></td>
 						<td><input type="button" id="resuelto_<? echo $data->id;?>" value="<? echo $indicador[$i]["resuelto"];?> ver"/></td>
 						<td><input type="button" id="restante_<? echo $data->id;?>" value="<? echo $indicador[$i]["restante"];?> ver"/></td>
 						<td><? echo $data->descripcion;?></td>
 						<td><input type="button" value="Agregar" id="agregar_<? echo $data->id;?>" /></td>
 						<td><input type="button" value="Guardar" id="guardar_<? echo $data->id;?>" /></td>
					<td><?php if($indicador[$i]["resuelto"]==0){ ?><input type="button" value="Eliminar" id="eliminar_<? echo $data->id;?>"/><?php }?></td>
 					</tr>
					<?php $i++; } ?>
 				</table>
				<?php }else{ echo "<h3><b>No hay registros</b></h3>";} ?>
 			</form>
			<div style="clear:both"></div>
			<?php echo CHtml::form(array("admin/encuestas/programacion/"), 'post', array('class'=>'add', 'id'=>'add')); ?>
				<div style="display:none">
 					<input type="hidden" value="<?php echo $sid;?>" name="sid">
					<input type="hidden" value="add" name="op">
				</div>
			<div style="clear:both"></div>
			<h3><b>Agregar</b></h3> 
  			<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
				<tbody>
					<tr>
 						<td><b>Fecha Inicio</b></td>
						<td><b>Fecha Fin</b></td>
 						<td><b>Dependencia</b></td>
 						<td><b>Descripción</b></td>
 						<td><b>Agregar población</b></td>
 						<td><b>Guardar</b></td>
 					</tr>
				</tbody>
					<tr>
 						<td><input type="text" name="fechaini"  id="fechaini" /></td>
						<td><input type="text" name="fechafin"  id="fechafin" /></td>
						<td><b><select name="dependencia">
							<?php  foreach($areas as $datoar){  ?>
							<option value="<? echo $datoar["id"];?>"><? echo $datoar["nombre"];?></option>
							<?php }?>
							</select>
							</b>
						</td>
 						<td><input type="text" name="descripcion" /></td>
 						<td><input type="button" id="addp" value="Agregar Población"/></td>
 						<td><input type="submit" id="guardar" value="Guardar"/></td>
 					</tr>
			</table>
			
			<div style="clear:both"></div>
			<div style="display:none">
				<input type="hidden" id="poblacion" name="poblacion" />
			</div>
 			</form>
		</div>

	</div>
</div>