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
	jQuery("input[id^='dominio_'],input[id^='dimension_']").click(function(){console.log(222222);
		var id=jQuery(this).attr("id").split("_")[1];
		var nombre=jQuery(this).attr("id").split("_")[0];
		var srrd=jQuery("[name='"+nombre+"_"+id+"_srrd']").val();
		srrd=srrd.trim(" ");
		var rb=jQuery("[name='"+nombre+"_"+id+"_rb']").val();
		rb=rb.trim(" ");
		var rm=jQuery("[name='"+nombre+"_"+id+"_rm']").val();
		rm=rm.trim(" ");
		var ra=jQuery("[name='"+nombre+"_"+id+"_ra']").val();
		ra=ra.trim(" ");
		var rma=jQuery("[name='"+nombre+"_"+id+"_rma']").val();
		rma=rma.trim(" ");
		if(srrd!="" || rb!="" || rm!="" || ra!="" || rma!=""){	
			var html="<input type='hidden' name='id' id='id' value='"+id+"' />";
			html+="<input type='hidden' name='sid'  value='<?php echo $sid;?>' />";
			html+="<input type='hidden' name='srrd'  value='"+srrd+"' />";
			html+="<input type='hidden' name='rb'  value='"+rb+"' />";
			html+="<input type='hidden' name='rm'  value='"+rm+"' />";
			html+="<input type='hidden' name='ra'  value='"+ra+"' />";
			html+="<input type='hidden' name='rma'  value='"+rma+"' />";
			html+="<input type='hidden' name='op'  value='"+nombre+"add' />";
			jQuery("#"+nombre+"var").html(html);
			jQuery("#"+nombre+"form").submit();
		}else{
			jQuery.colorbox({html:"<b><h3>Por favor llene todos los campos</h3></b>"});
		
		}
			
	});
 });

 
</script>
	<?php echo CHtml::form(array("admin/encuestas/baremos"), 'post', array('class'=>'dominioform', 'id'=>'dominioform')); ?>
		<div id="dominiovar"></div>
	</form>
	<?php echo CHtml::form(array("admin/encuestas/baremos"), 'post', array('class'=>'dimensionform', 'id'=>'dimensionform')); ?>
		<div id="dimensionvar"></div>
 	</form>
   <div id="content">
  	<div class="divContentBlue">
		<h2><b>Baremos para <? echo $datae->surveyls_title;?>	</b></h2>
		
		<? if($mensaje!=""){ ?><div class="divContentBlue"><div class="divContentWhite"><h3><b> <? echo $mensaje;?></b></h3></div></div> <? }?>			  
		<div class="divContentWhite">
  				
				<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
					<tr><td><b><h3>Dominios</h3></b></td></tr> 
					<tr>
 						<td>
 							<?php if(isset($rdom[0]["id"])){ ?>
							<table width="100%">
								<tr>
									<td><b>Nombre</b></td>
									<td><b>Sin Riesgo o Riesgo Despreciable</b></td>
									<td><b>Riesgo Bajo</b></td>
									<td><b>Riesgo Medio</b></td>
									<td><b>Riesgo Alto</b></td>
									<td><b>Riesgo Muy Alto</b></td>
									<td></td>
								<tr>
 								<?php foreach($rdom as $valores){ ?>
								<tr>
									<td><b><?=$valores["nombre"]?></b></td>
									<td><b><input type="text" name="dominio_<?=$valores["id"]?>_srrd" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["srrd"];} ?> ></b></td>
									<td><b><input type="text" name="dominio_<?=$valores["id"]?>_rb" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["rb"];} ?>></b></td>
									<td><b><input type="text" name="dominio_<?=$valores["id"]?>_rm" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["rm"];} ?>></b></td>
									<td><b><input type="text" name="dominio_<?=$valores["id"]?>_ra" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["ra"];} ?>></b></td>
									<td><b><input type="text" name="dominio_<?=$valores["id"]?>_rma" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["rma"];} ?>></b></td>
									<td>
										<input type="button" id="dominio_<?=$valores["id"]?>" value="Guardar" class="ui-button ui-widget ui-state-default ui-corner-all limebutton" role="button" aria-disabled="false">
									</td>
								<tr>								
 								<?php }?>								
 							</table>							
 							<?php }else{ echo "<h3><b>No se han configurado dominios</b></h3>";} ?>
						</td>
						</tr>
						<tr><td><b><h3>Dimensiones</h3></b></td></tr> 
 						<tr>
						<td>
							<?php if(isset($rd[0]["id"])){ ?>
							
							<table width="100%">
								<tr>
									<td><b>Nombre</b></td>
									<td><b>Sin Riesgo o Riesgo Despreciable</b></td>
									<td><b>Riesgo Bajo</b></td>
									<td><b>Riesgo Medio</b></td>
									<td><b>Riesgo Alto</b></td>
									<td><b>Riesgo Muy Alto</b></td>
									<td></td>
								<tr>
 								<?php foreach($rd as $valores){ ?>
								<tr>
									<td><b><?=$valores["nombre"]?></b></td>
									<td><b><input type="text" name="dimension_<?=$valores["codigo"]?>_srrd" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["srrd"];} ?> ></b></td>
									<td><b><input type="text" name="dimension_<?=$valores["codigo"]?>_rb" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["rb"];} ?>></b></td>
									<td><b><input type="text" name="dimension_<?=$valores["codigo"]?>_rm" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["rm"];} ?>></b></td>
									<td><b><input type="text" name="dimension_<?=$valores["codigo"]?>_ra" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["ra"];} ?>></b></td>
									<td><b><input type="text" name="dimension_<?=$valores["codigo"]?>_rma" <? if(isset($valores["baremos"]["id"])){echo 'value='.$valores["baremos"]["rma"];} ?>></b></td>
									<td>
										<input type="button" id="dimension_<?=$valores["codigo"]?>" value="Guardar" class="ui-button ui-widget ui-state-default ui-corner-all limebutton" role="button" aria-disabled="false">
									</td>
								<tr>								
 								<?php }?>								
 							</table>							
 							<?php }else{ echo "<h3><b>No se han configurado dimensiones</b></h3>";} ?>
						</td>
						</tr>
  				</table>
				
 			
			
			
			
			<div style="clear:both"></div>
			 
			
			
 		</div>

	</div>
</div>