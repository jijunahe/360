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
 		jQuery("#var").html("<input type='hidden' name='id' id='is' value='"+id+"' 7>");
		jQuery("#formEditar").submit();
  	});
 	jQuery("[rel^='parametrizar_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
 		jQuery("#var1").html("<input type='hidden' name='sid' id='is' value='"+id+"' 7>");
		jQuery("#formP").submit();
  	});
 	jQuery("[name='clacificar']").click(function(){
		var id=jQuery(this).val();
		var obj=jQuery("[name='clac[]']:checked");
		if(obj.size()>0){
			var datar=[];
			jQuery.each(obj,function(k,d){
				datar.push(jQuery(d).val());
			});
			jQuery("#var2").html("<input type='hidden' name='qid' id='qid' value='"+datar.join()+"' /><input type='hidden' name='tipo' id='tipo' value='"+id+"' />");
			jQuery("#formC").submit();
		}else{
			jQuery.colorbox({html:"Por favor, seleccione al menos una pregunta"});
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
			<div class="divContentBlue">
			 <h3>Preguntas <?=$datae->surveyls_title?></h3>
			 <input type="button" value="12345" name="clacificar" style="float:right" />
			 <input type="button" value="54321" name="clacificar" style="float:right" />
			 <input type="button" value="01234" name="clacificar" style="float:right" />
			 <input type="button" value="43210"  name="clacificar"  style="float:right" />
			 <input type="button" value="9630"  name="clacificar"  style="float:right" />
			 <input type="button" value="6420"  name="clacificar"  style="float:right" />
			 <input type="button" value="3210"  name="clacificar"  style="float:right" />
 			  <div class="divContentWhite">
 			 <?php echo CHtml::form(array("admin/encuestas/clasificar"), 'post', array('class'=>'formC', 'id'=>'formC')); ?>
				<input type="hidden"   name='sid' value='<?=$sid?>' />
				<div id="var2" style="display:none"></div>
			</form>
			  <?php echo CHtml::form(array("admin/encuestas/programacion"), 'post', array('class'=>'formEditar', 'id'=>'formEditar')); ?>
 			  <input type="hidden"   name='option' value='10' />
			  <input type="hidden"   name='textId'   id='textId' value='' />
			  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
			    <tr>
				  <td width="40">Item</td>
 				  <td><b>Pregunta</b></td>
 				  <td><b>Clacificación</b></td>
  				</tr>
				<?PHP
				$i=1;
				foreach($preguntas as $obj){
					$select="<select rel='class_".$obj->sid."'>";
 					$ch1="";
					
					$style1="";
 					if($obj->clasif=='0'){
						$ch1="01234";
						$style1="style='background-color:#EDEDB4'";
 					}
					if($obj->clasif=='1'){
						$ch1="43210";
						$style1="style='background-color:#CCCCCC'";
 					}
 
					if($obj->clasif=='2'){
						$ch1="9630";
						$style1="style='background-color:#CCCCCC'";
 					}
					
 					if($obj->clasif=='3'){
						$ch1="6420";
						$style1="style='background-color:#EDEDB4'";
 					}
 
 					if($obj->clasif=='4'){
						$ch1="3210";
						$style1="style='background-color:#FFFFFF'";
 					}
 
 
 					if($obj->clasif=='5'){
						$ch1="12345";
						$style1="style='background-color:#EDEDB4'";
 					}
 
 
 					if($obj->clasif=='6'){
						$ch1="54321";
						$style1="style='background-color:#CCCCCC'";
 					}
 
   					echo("
					<tr ".$style1.">
 					  <td>
 							  <input type='checkbox' name='clac[]' value='".$obj->qid."' />
 					  </td>
					  <td>".($obj->question)."</td>
					  <td><b>".$ch1."</b></td>
  					</tr>
					");
					$i++;
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