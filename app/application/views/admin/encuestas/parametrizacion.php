<? $root=explode("/",$_SERVER["SCRIPT_NAME"]);$root="/".$root[1]."/"; ?>
<link rel="stylesheet" href="<?=$root?>scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=$root?>scripts/admin/colorbox/jquery.colorbox.js"></script>
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
</style>
<script type="text/javascript">
	function confirmarEliminar(mostrar,usuario)
	{
		if (confirm("Se eliminarán todos los datos del usuario incluyendo evaluaciones y reportes ¿Desea confirmar?"))
		{	//document.Eliminar.submit()
			location.href="admUsuariosLista.php?s="+mostrar+" &id="+usuario+"&uActivo=3";
		}  else
		alert("El usuario no se ha eliminado...")
	}
</script>
<script type="text/javascript">
	
	function Activa(){
		jQuery("[rel^='editar_']").click(function(){
			var id=jQuery(this).attr("rel").split("_")[1];
			document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/survey/sa/deactivate/surveyid/"+id;
		});
		jQuery("[rel^='programar_']").click(function(){
			var id=jQuery(this).attr("rel").split("_")[1];
			jQuery("#var").html("<input type='hidden' name='id' id='is' value='"+id+"' 7>");
			jQuery("#formEditar").submit();
		});
		jQuery("[rel^='dimension_']").click(function(){
			var idparam=jQuery(this).attr("rel").split("_")[1];
			dimension(idparam);
 		});
 		
		jQuery("[rel^='elimdom']").click(function(){
 			var id=jQuery(this).attr("rel").split("_")[1];
			var parent=jQuery(this).parent().parent();
			var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/parametrizacion/";
			var idparam=idparam; 
			var pars={"sid":<?php echo $sid;?>,"id":id,"op":"elimdom"};
			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: url,
				data:pars,
				success:function(res){	
 					jQuery.colorbox({html:res[0]});
					jQuery(parent).remove();
 				}
			});
		});		
		
 		var ruta=document.location.search;
		ruta=ruta.split("?")[1];
 		if(ruta!=undefined){
			<?php if($idparam>0){ ?>
			eval(ruta+"(<?php echo $idparam; ?>)");
			<?php } ?>
 		}
 	}
	
	function dimension(idparam){
		
			var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/parametrizacion/";
 			var idparam=idparam; 
  			var pars={"sid":<?php echo $sid;?>,"idparam":idparam,"op":"dimension"};
 			jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: url,
			data:pars,
			success:function(res){
				if(res[1]>0){
					var preg='<div style="clear:both"></div><table style="border: 1px solid #CCCCCC;border-collapse: collapse;font-size: 11px;" border="1">';
					jQuery.each(res[0],function(k,d){
						preg+='<tr><td><input type="checkbox" name="quid[]" value="'+d.qid+'"/></td><td>'+d.question+'</td></tr>';
					});
					preg+='</table>';
				}else{
					var preg='<b>No hay preguntas disponibles</b>';
 				}
				var dim='';
				 
				if(res[3]>0){console.log(res[2]);
					    dim+='<table style="border: 1px solid #CCCCCC;border-collapse: collapse;font-size: 11px;" border="1" width="100%">';
						dim+='<tr>';
						dim+='<td style="text-align: center;"><b>Nombre</b></td>';
						dim+='<td  style="text-align: center;"><b>Criterio de Transformación</b></td>';
						dim+='<td  style="text-align: center;"><b>Criterio Multiplicador</b></td>';
						dim+='<td></td>';
						dim+='</tr>';
					jQuery.each(res[2],function(k,d){
						dim+='<tr>';
						dim+='<td ><input type="text" name="nomdim" value="'+d.nombre+'" /></td>';
						dim+='<td  style="text-align: center;"><input type="text" name="ctrans" value="'+d.transformacion+'" /></td>';
						dim+='<td  style="text-align: center;"><input type="text" name="cmultiplicador" value="'+d.multiplicador+'" /></td>';
						dim+='<td><input type="button" name="verq"  rel="verq_'+d.id+'" value="Ver"/></td>';
						dim+='</tr>';
					});
					dim+='</table>';
				} 
				dim+='<table style="border: 1px solid #CCCCCC;border-collapse: collapse;font-size: 11px;"  width="100%">';
				dim+='<tr>';
				dim+='<td><b>Nombre</b></td>';
				dim+='<td><b>Criterio de Transformación</b></td>';
				dim+='<td><b>Criterio Multiplicador</b></td>';
				dim+='<td></td>';
				dim+='</tr>';
				dim+='<tr>';
				dim+='<td><input type="text" id="nombredim" /></td>';
				dim+='<td><input type="text" id="transformaciondim" /></td>';
				dim+='<td><input type="text" id="multiplicador" /></td>';
				dim+='<td><input type="button" name="guardardim" value="Guardar"/></td>';
				dim+='</tr>';
				dim+='</table>';
				
				
				var htmlr='<center><div style="width:98%;height:98%">';
					htmlr+='<div style="width:25%;height:90%;float:left;overflow-y:scroll;overflow-x:hidden"><div><b>Preguntas</b></div>'+preg+'</div>';
					htmlr+='<div style="width:70%;height:90%;float:left;overflow-y:scroll;overflow-x:hidden;margin-left:30px">'+dim+'<div style="display:none;" id="modpreg"></div></div>';
					htmlr+='</div></center><div style="clear:both"></div>';
				jQuery.colorbox({html:htmlr,width:"90%",height:"90%"});
			}
			});
			jQuery("[name='verq']").click(function(){
				var id=jQuery(this).attr("rel").split("_")[1];
				var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/parametrizacion/";
				var idparam=idparam; 
				var pars={"sid":<?php echo $sid;?>,"id":id,"op":"verpreguntas"};
				jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: url,
				data:pars,
				success:function(res){
					var html='<table style="-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;border:1px solid #CCCCCC" border="1" width="100%">';
 					
					jQuery.each(res,function(k,d){
						/*
						var img ="";
						if(d.tipocal=='0'){
							img ="<img src='<?php echo $imageurl;?>bgre.png' rel='inactiva_"+d.id+"'  alt='' style='cursor:pointer'>";
						}else if(d.tipocal=='1'){
							img ="<img rel='activa_"+d.id+"' src='<?php echo $imageurl;?>bneg.png' alt=''  style='cursor:pointer'>";					
						}*/
						html+='<tr>';
						html+='<td>'+(k+1)+'.'+d.question+'</td>';
						//html+='<td>'+img+'</td>';
						html+='<td><img style="cursor:pointer" src="<? echo $root;?>img/bad.gif" rel="elim_'+d.id+'" /></td>';
						html+='</tr>';
 					});
					 html+='</table>';
					jQuery("#modpreg").html(html);
					jQuery("#modpreg").show();
					
					
				}});
			});				
 			jQuery("[name='guardardim']").click(function(){
				if(jQuery("[name='quid[]']:checked").size()>0){
					var obsel=jQuery("[name='quid[]']:checked");
					var sel=[];
					jQuery.each(obsel,function(k,d){
						sel.push(jQuery(d).val());
					});
					sel=sel.join(",");
			
					if(jQuery("#nombredim").val()!=""){
						var html='<input type="hidden" name="nombre" value="'+jQuery("#nombredim").val()+'" />';
						html+='<input type="hidden" name="transformacion" value="'+jQuery("#transformaciondim").val()+'" />';
						html+='<input type="hidden" name="multiplicador" value="'+jQuery("#multiplicador").val()+'" />';
						html+='<input type="hidden" name="idparam" value="'+idparam+'" />';
						html+='<input type="hidden" name="sel" value="'+sel+'" />';
						jQuery("#formdim").append(html);
						jQuery("#formdim").submit();
					}else{
					
						alert("Por favor dar nombre a la dimensión");
					}
				}else{
					alert("Por favor selecciones preguntas para agregar a la dimensión");
				
				}
				
			});

 	}
	
	
	
	jQuery(function(){
		
		Activa();
		
		
	});
</script>
<div id="content">
	
	<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
	<div class="divContentBlue">
		<h2><b>Parametrización para <? echo $datae->surveyls_title;?>	</b></h2>
		
		<? if($mensaje!=""){ ?><div class="divContentBlue"><div class="divContentWhite"><h3><b> <? echo $mensaje;?></b></h3></div></div> <? }?>			  
		<?php echo CHtml::form(array("admin/encuestas/parametrizacion?dimension"), 'post', array('class'=>'formdim', 'id'=>'formdim')); ?>
			<input type="hidden" value="<?php echo $sid;?>" name="sid">
			<input type="hidden" value="adddim" name="op">
		</form>
		
		<?php echo CHtml::form(array("admin/encuestas/parametrizacion?dominio"), 'post', array('class'=>'formdom', 'id'=>'formdom')); ?>
			<input type="hidden" value="<?php echo $sid;?>" name="sid">
		</form>
		
		<div class="divContentWhite">
			<?php echo CHtml::form(array("admin/encuestas/parametrizacion"), 'post', array('class'=>'formEditar', 'id'=>'formEditar')); ?>
			<input type="hidden"   name='option' value='10' />
			<input type="hidden"   name='textId'   id='textId' value='' />
			<?php if(isset($parametrizacion[0]->id)){ ?>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
					<tr>
						<td><b>Dominio</b></td>
 						<td><b>Criterio de Transformación</b></td>
 						<td><b>Dimensiones</b></td>
 						<td><b></b></td>
					</tr>
					<?PHP
						foreach($parametrizacion as $obj){
							$img = $obj->estado=='1'?"<img src='".$imageurl."bgre.png' rel='inactiva_".$obj->id."'  alt='' style='cursor:pointer'>":"<img rel='activa_".$obj->id."' src='".$imageurl."bneg.png' alt=''  style='cursor:pointer'>";
							
							echo("
							<tr>
							<td>
							".$obj->nombre."
							</td>
							<td>
							".$obj->transformacion."
							</td>
							 
							<td>
							
						 	<input type='button' value='Dimensiones' rel='dimension_".$obj->id."' style='width:100%' />
							
							</td>
 							<td><img style='cursor:pointer' src='".$root."img/bad.gif' rel='elimdom_".$obj->id."' /></td>
							</tr>
							");
						}
						
					?>
				</table>
				<div id="var" style="display:none"></div>
			<?php }else{ echo "<h3><b>No hay registros</b></h3>";} ?>
		</form>
  		<div style="clear:both"></div>
		<?php echo CHtml::form(array("admin/encuestas/parametrizacion/"), 'post', array('class'=>'add', 'id'=>'add')); ?>
		<div style="display:none">
			<input type="hidden" value="<?php echo $sid;?>" name="sid">
			<input type="hidden" value="add" name="op">
		</div>
		<div style="clear:both"></div>
		<h3><b>Agregar</b></h3> 
		<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
			<tbody>
				<tr>
 					<td><b>Nombre</b></td>
 					<td><b>Criterio de transformación</b></td>
					<td></td>
 				</tr>
			</tbody>
			<tr>
 				<td><input type="text" name="nombre" />
				</td>
 				<td><input type="text" name="transformacion" />
				</td>
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