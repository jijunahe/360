<? $root=explode("/",$_SERVER["SCRIPT_NAME"]);$root="/".$root[1]."/"; ?>
<link rel="stylesheet" href="<?=$root?>scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=$root?>scripts/admin/colorbox/jquery.colorbox.js"></script>
<script>
	jQuery(function(){
		$( "#fechaini" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
		$( "#fechafin" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
		$( ".fechaformat" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
	
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
		
		jQuery("[name='empresafiltro']").change(function(){
			var valor=jQuery(this).val();
			jQuery("[name='filtro']").val(valor);
			jQuery("#filtro").submit();
 			
		})
	
 	
		jQuery("[id^='poblacion_']").click(function(){
			var id=jQuery(this).attr("id").split("_")[1];
			addpoblacion("id",id,"usprogramados","poblacion");
		});
	
		jQuery("[id^='restante_']").click(function(){
			var id=jQuery(this).attr("id").split("_")[1];
			addpoblacion("id",id,"usprogramados","restante");
		});
		jQuery("[id^='resuelto_']").click(function(){
			var id=jQuery(this).attr("id").split("_")[1];
			var idbateria=jQuery(this).attr("id").split("_")[2];
			addpoblacion("id",id,"usprogramados","resuelto",idbateria);
		});	
		jQuery("[rel^='elienc_']").click(function(){
			var id=jQuery(this).attr("rel").split("_");
			var html='<input type="hidden" name="idbateria" value="'+id[2]+'" />';
			 html+='<input type="hidden" name="idprogramacion" value="'+id[1]+'" />';
			 html+='<input type="hidden" name="op" value="eliminarencp" />';
			 jQuery("#delenc").html(html);
			 jQuery("#elenc").submit();
  		});
		
		jQuery("[rel^='elibat_']").click(function(){
			var id=jQuery(this).attr("rel").split("_");
			if(confirm("¿Esta seguro de borrar esta batería?")){	
				var html='<input type="hidden" name="idbateria" value="'+id[1]+'" />';
				 html+='<input type="hidden" name="op" value="eliminarbateria" />';
				 jQuery("#delenc").html(html);
				 jQuery("#elenc").submit();
			}
  		});
		
		jQuery("[rel^='addp_']").click(function(){
			var id=jQuery(this).attr("rel").split("_");
 			addpoblacion(id[1],id[2]);
 		});
		
		jQuery("[rel^='addenp_']").click(function(){
			var id=jQuery(this).attr("rel").split("_");
			addencuesta(id[1],id[2]);
 		});
		
		jQuery("#guardar").click(function(){
			var nombre=jQuery("#nombre").val();
 			var valida=true;
   			if(nombre.trim(" ")==""){
				jQuery.colorbox({html:"<h3><b>Escriba el nombre dela batería</b></h3>"});
				valida=false;
 			}			
 			if(jQuery("[name='empresa']").val()<0){
				jQuery.colorbox({html:"<h3><b>Por favor seleccione una empresa</b></h3>"});
				valida=false;
			}	
 			if(valida==true){
				jQuery("#add").submit();
			}
 		});
		jQuery("#addpr").click(function(){
			addpoblacion();
 		});
		
		jQuery("#adde").click(function(){
			addencuesta();
 		});
		
	});
$.expr[':'].icontains = function(obj, index, meta, stack){
return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
};
function buscador(){
	jQuery("[rel='buspob']").click(function(){
		var datobus=jQuery("[name='dato']").val();
		var objsnoms=jQuery(".nombresr");
		var objsced=jQuery(".cedulasr");
		
		jQuery('[class*="ittems"]').hide();
  		jQuery.each(objsnoms,function(key,data){
			
			var datonom= jQuery(data).text();
			var datoced= jQuery(objsced[key]).text();
			console.log(data);
  			if(jQuery(data).find(":icontains('"+datobus.trim(" ")+"')").text()!="" || jQuery(objsced[key]).find(":icontains('"+datobus.trim(" ")+"')").text()!="" ){
				jQuery(data).parent().show();
 			} 
 		});
	});
	jQuery("[rel='refrescar']").click(function(){jQuery('[class*="ittems"]').show();});

}	

function addpoblacion(){ 
	
	var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/bateria/";
	var modal=true;
	var t3=false;
	var objdata={"op":"us"};
	var idbateria=false;
	//console.log(arguments);
	if(arguments[0]!=undefined){
		idbateria=arguments[0];
		objdata={"op":"us","idbateria":arguments[0],"id_unidad":arguments[1]};
 		if(arguments[3]!=undefined){
			var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/programacion/";
 			t3=true;
			var idbateria="";
			if(arguments[4]!=undefined){
				idbateria=arguments[4];
			}
 			eval('objdata={ op : "'+arguments[2]+'",'+arguments[0]+':"'+arguments[1]+'",innerif:"'+arguments[3]+'"}');
		}
 	}
	//console.log(objdata);
   	var pobtest=jQuery("#poblacion").val().split(",");
	jQuery.ajax({ 
	type: "POST",
	dataType: "json",
	async: false,
	url: url,
	data:objdata,
	success:function(res){
 	
		var select="";
		 
		select+="</select>  Documento o Nombre <input type='text' name='dato'/><input type='button' rel='buspob' value='Buscar' /><input type='button' rel='refrescar' value='refrescar' />";
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
					html+="<tr  style='cursor:pointer' class='"+classt+" ittems'>";
					html+="<td><input type='checkbox' name='pob[]' value='"+dato.uid+"' "+add+"/></td>";
				}else{
					html+="<tr  style='cursor:pointer' rel='resultado_"+dato.uid+"_"+idbateria+"' class='"+classt+" ittems'>";
				}
				html+="<td class='cedulasr'><spam >"+dato.documento+"</spam></td>";
				html+="<td class='nombresr'><spam >"+dato.nombres+"</spam></td>";
				html+="<td>"+dato.area+"</td>";
			html+="</tr>";
		});
		if(t3==false && idbateria==false){html+="</table></center><input type='button' rel='agregar_poblacion' value='Agregar'/>";}
		if(idbateria>0){html+="</table></center><input type='button' rel='agregar_maspob' value='Agregar'/>";}
		jQuery.colorbox({html:html,width:"70%", height:"70%", scroll:"true" }); 
		jQuery("[name*='pob']").bind("click",function(){ 
			if(jQuery(this).is(":checked")){
				jQuery(this).parent().parent().addClass("add");
			}else{
				jQuery(this).parent().parent().removeClass();
			}
		});
		buscador();
		jQuery("[rel^='agregar_maspob']").click(function(){
			var pob=[];
			jQuery("[name='pob[]']:checked").each(function(key,dato){ 
 					pob.push(jQuery(dato).val());
 			});
			jQuery("#poblacion").val(pob.join(","));	
			var poblar=jQuery("#poblacion").val();
			if(poblar.trim(" ")!=""){
				var html="<input type='hidden' value='"+idbateria+"' name='idbateria' />";
				html+="<input type='hidden' value='pobmas' name='op' />";
				html+="<input type='hidden' value='"+jQuery("#poblacion").val()+"' name='poblacion' />";
				jQuery("#pobad").html(html);
				jQuery("#addp").submit();
			}else{
 				alert("Por favor seleccione población");
			}
 		});
		
		jQuery("[rel='agregar_poblacion']").click(function(){
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
		
			}	
	});
	
	jQuery("[rel^='resultado_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
		var idbateria=jQuery(this).attr("rel").split("_")[2];
		jQuery("#res").html("<input type='hidden' name='idus' value='"+id+"' /><input type='hidden' name='idbateria' value='"+idbateria+"' />");
		jQuery("#formResu").submit();
	});
	
 }
 	
	

<? if($perfil==1 or $perfil==3 or $oRecord->uid==1) {?>	
function addencuesta(){

	var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/bateria/";
	var modal=true;
	var t3=false;
	var objdata={"op":"encuestas","empresa":jQuery("[name='empresa']").val()};
	var idbateria=false;
	if(arguments[0]!=undefined){
		idbateria=arguments[0];
		objdata={"op":"encuestas","idbateria":arguments[0],"empresa":arguments[1]};
	}
	console.log(objdata);
	if(jQuery("[name='empresa']").val()>0 || arguments[0]!=undefined){
		var pobtest=jQuery("#encuestas").val().split(",");
		jQuery.ajax({ 
		type: "POST",
		dataType: "json",
		async: false,
		url: url,
		data:objdata,
		success:function(res){
		
			 var html="<table cellpadding='0' cellspacing='0' border='1' width='100%'>";
				html+="<tr>";
					//html+="<td><input type='checkbox' name='todo' /></td>";
					html+="<td></td>";
					html+="<td><b>Encuesta</b></td>";
					html+="<td><b>fecha inicial</b></td>";
					html+="<td><b>Fecha final</b></td>";
					html+="<td><b>Descripcion</b></td>";
				html+="</tr>";
			jQuery.each(res,function(key,dato){
				var classt="";
				var add="";
				if(pobtest.indexOf(dato.id)>=0){
					classt="add";
					add="checked='checked'";
				}
				
					
					html+="<tr  style='cursor:pointer' class='"+classt+"'>";
					html+="<td><input type='checkbox' name='enc[]' value='"+dato.id+"' "+add+"/></td>";
					 
					html+="<td>"+dato.encuesta+"</td>";
					html+="<td>"+dato.fechaini+"</td>";
					html+="<td>"+dato.fechafin+"</td>";
					html+="<td>"+dato.descripcion+"</td>";
				html+="</tr>";
			});
			if(t3==false && idbateria==false){html+="</table></center><input type='button' rel='agregar_encuestas' value='Agregar'/>";}
			if(idbateria>0){html+="</table></center><input type='button' rel='agregar_masencuestas' value='Agregar'/>";}
			
			jQuery.colorbox({html:html,width:"70%", height:"70%", scroll:"true" }); 
			jQuery("[name*='enc']").bind("click",function(){ 
				if(jQuery(this).is(":checked")){
					jQuery(this).parent().parent().addClass("add");
				}else{
					jQuery(this).parent().parent().removeClass();
				}
			});		
			
			jQuery("[rel='agregar_masencuestas']").click(function(){
				var pob=[];
				jQuery("[name='enc[]']:checked").each(function(key,dato){ 
						pob.push(jQuery(dato).val());
				});
				jQuery("#encuestas").val(pob.join(","));	
				var poblar=jQuery("#encuestas").val();
				if(poblar.trim(" ")!=""){
					var html="<input type='hidden' value='"+idbateria+"' name='idbateria' />";
					html+="<input type='hidden' value='addencp' name='op' />";
					html+="<input type='hidden' value='"+jQuery("#encuestas").val()+"' name='encuestas' />";
					jQuery("#masenc").html(html);
					jQuery("#addmasenc").submit();
				}else{
					alert("Por favor seleccione encuestas");
				}			 
				 
			});	
			jQuery("[rel='agregar_encuestas']").click(function(){
				var pob=[];
				var probar=jQuery("#encuestas").val().split(",");
				
				jQuery("[name='enc[]']:checked").each(function(key,dato){ 
					//if(probar.indexOf(jQuery(dato).val())<0){
						pob.push(jQuery(dato).val());
					//}
				});
				jQuery("#encuestas").val(pob.join(","));			
 				
				jQuery.colorbox.close();
			});	
			
				}	
		});
	}else{
 		jQuery.colorbox({html:"<h3><b>Por favor seleccione una empresa</b></h3>"});
 	}
 }
 
<? }else if($perfil==4){?>
jQuery(function(){
	jQuery("[rel^='elibat_']").remove();
	jQuery("[rel^='addp_']").remove();
	jQuery("[rel^='addenp_']").remove();
	jQuery("[rel^='elienc_']").remove();
	
	
})

<? } ?>
</script>
<div id="content">
		<div class="divContentBlue"><h3>Bater&iacute;a</h3>
			 <div class="divContentWhite">
<select name="empresafiltro" >
<option value='-1'>Filtrar por empresa</option>
<?  
foreach($unidades as $empresas){
echo "<option value='".$empresas['id']."'>".$empresas['nombre']."</option>";
}

?>
</select>				
<?php echo CHtml::form(array("admin/encuestas/bateria/"), 'post', array('class'=>'filtro', 'id'=>'filtro')); ?>
	<input type="hidden" name="filtro" />
</form>				
				
<?php 
	
	foreach($encprogrmas as $key=>$valores){
 		 

?>
				
<table width="100%" >
		 
	<tr style="background-color: #EDEDFB;color:  #1F497D;">
		<td  style="border: 1px solid #666;color:  #1F497D;"   colspan="8">
 			<div style="float:left">
			<b>NOMBRE BATER&Iacute;A: <?=strtoupper ($bateria[$key]->nombre)?></b> <br> 
			<b>EMPRESA: <?=strtoupper ($bateria[$key]->empresa)?></b><br>
			<b>CREADOR: <?=strtoupper ($bateria[$key]->creador)?></b><br>
			<b>FECHA CREACIÓN: <?=strtoupper ($bateria[$key]->fcreacion)?></b>
			</div>
 			
			<div style="float:right;margin-left: 20px;">
				<input type="button" value="Agregar encuestas programadas"  rel="addenp_<?=$bateria[$key]->id?>_<?=$bateria[$key]->id_unidad?>" />
 			</div>
			<div style="float:right;margin-left: 20px;">
				<input type="button" value="Agregar Población"  rel="addp_<?=$bateria[$key]->id?>_<?=$bateria[$key]->id_unidad?>" />
 			</div>
			<div style="float:right;">
				<input type="button" value="Eliminar bater&iacute;a"  rel="elibat_<?=$bateria[$key]->id?>_<?=$bateria[$key]->id_unidad?>" />
 			</div>
		</td>
	</tr>
	<tr style="background-color:#F2F2F2">
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Encuesta</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Descripci&oacute;n</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Poblaci&oacute;n agregada</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Personas que ya resolvieron la encuesta</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Personas que faltan en resolver la encuesta</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Fecha inicio de encuesta</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b>Fecha Fin de la encuesta</b></td>
		<td style="border: 1px solid #666;color:  #1F497D;"><b></b></td>
	</tr>
	
	
	<?php
	
		 
			foreach($valores as $proe){ 
				if(isset($proe["encuesta"])){
		?>
			<tr>
				<td style="border: 1px solid #666;color:  #1F497D;"><b><?=$proe["encuesta"]?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><b><?=$proe["descripcion"]?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><input type="button" id="poblacion_<?=$proe["id"]?>" value="<? echo $proe["indicadores"]["encuestados"];?> ver"/></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><input type="button" id="resuelto_<?=$proe["id"]?>_<?=$bateria[$key]->id?>" value="<? echo $proe["indicadores"]["resuelto"];?> ver"/></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><input type="button" id="restante_<?=$proe["id"]?>" value="<? echo $proe["indicadores"]["restante"];?> ver"/></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><b>Fecha inicio: <?=$proe["fechaini"]?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><b>Fecha Fin: <?=$proe["fechafin"]?></b></td>
				<td style="border: 1px solid #666;color:  #1F497D;"><b><input type="button" value="Eliminar"  rel="elienc_<?=$proe["id"]?>_<?=$bateria[$key]->id?>" /></b></td>
			</tr>
			<?php }
			}
		 
	?>
</table><br>				
				
<?php } ?><br><br>
 <?php echo CHtml::form(array("admin/usuarios/resultado/"), 'post', array('class'=>'formResu', 'id'=>'formResu')); ?>
	<div id="res" style="display:none"></div>
 </form>
<?php echo CHtml::form(array("admin/encuestas/bateria/"), 'post', array('class'=>'elenc', 'id'=>'elenc')); ?>
	<div id="delenc" style="display:none"></div>
</form>
<?php echo CHtml::form(array("admin/encuestas/bateria/"), 'post', array('class'=>'addp', 'id'=>'addp')); ?>
	<div id="pobad" style="display:none"></div>
</form>
<?php echo CHtml::form(array("admin/encuestas/bateria/"), 'post', array('class'=>'addmasenc', 'id'=>'addmasenc')); ?>
	<div id="masenc" style="display:none"></div>
</form>


<?php echo CHtml::form(array("admin/encuestas/bateria/"), 'post', array('class'=>'add', 'id'=>'add')); ?>
				<div style="display:none">
  					<input type="hidden" value="<?php echo $sid;?>" name="sid">
					<input type="hidden" value="add" name="op">
				</div>
			<? if($perfil==1 or $perfil==3  or $oRecord->uid==1) {?>	
			<div style="clear:both"></div>
			<h3><b>Agregar</b></h3> 
  			<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
				<tbody>
					<tr>
  						<td><b>Fecha inicio</b></td>
  						<td><b>Fecha fin</b></td>
  						<td><b>Nombre</b></td>
  						<td><b>Empresa</b></td>
  						<td><b></b></td>
  						<td><b></b></td>
  						<td><b>Resefrescar</b></td>
  						<td><b>Guardar</b></td>
 					</tr>
				</tbody>
					<tr>
 						<td><input type="text" name="fechaini"  id="fechaini" /></td>
 						<td><input type="text" name="fechafin"  id="fechafin" /></td>
 						<td><input type="text" name="nombre"  id="nombre" /></td>
 						<td>
							<select name="empresa" >
								<option value='-1'>Seleccione una empresa</option>
						<?  
							foreach($unidades as $empresas){
								echo "<option value='".$empresas['id']."'>".$empresas['nombre']."</option>";
							}
							
							?>
							</select>
						</td>
   						<td><input type="button" id="addpr" value="Agregar Población"/></td>
  						<td><input type="button" id="adde" value="Agregar encuestas programadas"/></td>
 						<td><input type="button" id="ref" value="Refrescar" onclick="document.location='<?=$_SERVER["SCRIPT_NAME"]?>index.php/admin/encuestas/bateria'"/></td>
 						<td><input type="button" id="guardar" value="Guardar"/></td>
 					</tr>
			</table>
			<? } ?>
			<div style="clear:both"></div>
			<div style="display:none">
				<input type="hidden" id="poblacion" name="poblacion" />
				<input type="hidden" id="encuestas" name="encuestas" />
			</div>
 			</form>

 			</div>		
		</div>		
</div>