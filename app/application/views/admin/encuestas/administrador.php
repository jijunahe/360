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
		document.location="/bateria/index.php/admin/survey/sa/deactivate/surveyid/"+id;
  	});
 	jQuery("[rel^='programar_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
 		jQuery("#var").html("<input type='hidden' name='id' id='id' value='"+id+"' />");
		jQuery("#formEditar").submit();
  	});
	 jQuery("[rel^='parametrizar1_'],[rel^='parametrizar2_'],[rel^='parametrizar3_'],[rel^='parametrizar4_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
 		jQuery("#var1").html("<input type='hidden' name='sid' id='id' value='"+id+"' />");
		jQuery("#formP").submit();
  	});

 

 	jQuery("[rel^='clasificar_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
 		jQuery("#var2").html("<input type='hidden' name='sid' id='id' value='"+id+"' />");
		jQuery("#formC").submit();
  	});
 	jQuery("[rel^='baremos_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
 		jQuery("#var3").html("<input type='hidden' name='sid' id='id' value='"+id+"' />");
		jQuery("#formB").submit();
  	});
	jQuery("[rel^='tipo_']").change(function(){
 		var id=jQuery(this).attr("rel").split("_")[1];
 		var tipo=jQuery(this).val();
		tipo=tipo.trim(" ");
		if(tipo!=""){
			var html="<input type='hidden' name='sid' id='id' value='"+id+"' />";
			html+="<input type='hidden' name='tipo' id='tipo' value='"+tipo+"' />";
			html+="<input type='hidden' name='option' id='option' value='addtipo' />";
			jQuery("#vartipo").html(html);
			jQuery("#formT").submit();
		}else{
		
			jQuery.colorbox({html:"<b>Seleccione un tipo válido</b>"});
		}
		
	});
}
	jQuery(function(){
		
		Activa();


	});
</script>


<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Encuestas disponibles <?=$show?>
			  <div class="divContentWhite">
			 <?php echo CHtml::form(array("admin/encuestas"), 'post', array('class'=>'formT', 'id'=>'formT')); ?>
				 <div id="vartipo" style="display:none"></div>
			</form>
			 <?php echo CHtml::form(array("admin/encuestas/parametrizacion"), 'post', array('class'=>'formP', 'id'=>'formP')); ?>
				 <div id="var1" style="display:none"></div>
			</form>
 
			 <?php echo CHtml::form(array("admin/encuestas/clasificar"), 'post', array('class'=>'formC', 'id'=>'formC')); ?>
				 <div id="var2" style="display:none"></div>
			</form>
			 <?php echo CHtml::form(array("admin/encuestas/baremos"), 'post', array('class'=>'formB', 'id'=>'formB')); ?>
				 <div id="var3" style="display:none"></div>
			</form>
			  <?php echo CHtml::form(array("admin/encuestas/programacion"), 'post', array('class'=>'formEditar', 'id'=>'formEditar')); ?>
 			  <input type="hidden"   name='option' value='10' />
			  <input type="hidden"   name='textId'   id='textId' value='' />
			  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
			    <tr>
 				  <td><b>Encuesta</b></td>
 				  <td><b>Programar Encuesta</b></td>
  				</tr>
				<?PHP
				foreach($encuestas as $obj){
					$select="<select rel='tipo_".$obj->surveyls_survey_id."'>";
					$select.="<option value=''>Seleccione un tipo de encuesta</option>";
					foreach($tipos as $value){
						$selected="";
						if($tipoencuesta[$obj->surveyls_survey_id]==$value->id){
							$selected="selected='selected'";
						}
						$select.="<option value='".$value->id."' ".$selected.">".$value->nombre."</option>";
					}
					$select.="</select>";
					$sufijo=$tipoencuesta[$obj->surveyls_survey_id];
					 
   					echo("
					<tr>
 					   
					  <td>".($obj->surveyls_title)."</td>
 					  <td>
					  
						 	<input type='button' value='Programar' rel='programar_".$obj->surveyls_survey_id."' style='width:100%' />

					  </td>
  					</tr>
					");
				}
				 
				?>
			  </table>
			  <div id="var" style="display:none"></div>
			  </form>
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