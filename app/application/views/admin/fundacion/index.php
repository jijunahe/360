<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){ 
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/encuestalibre";
 ?>
<div id="content">
   	<div class="divContentBlue">
		<h3>Fundación</h3>
 		<div class="divContentWhite">
			<div class="divContentBlue rcv"  >
				<div class="divContentWhite">
 					Encuesta
					<div style="clear:both"></div>
				<table width="100%"  style="border: 1px solid #EDEDFB" cellspacing="0" cellpadding="2" id="tableData">
                  <tr  style="border: 1px solid #EDEDFB;background-color: #EDEDFB">
				    <td align="center" width="20"><a href="javascript:;" rel="accion_create" style="text-decoration:none;"><img src="<?=Yii::app()->baseUrl?>/img/add.gif" width="20" height="20" border="0" /><br />
				      Crear</a>
					 </td>
				    <td  >ITEM</td>
                     <td>NOMBRE </td>
                     <td>URL </td>
                    <td>fecha de inicio </td>
                    <td>fecha de finalización</td>
                    <td align="center"  ></td>
                  </tr>
				  	<?PHP
					$contador=0;
 					foreach($hseqdisp as $dato){
 						foreach($dato as $key=>$value){
							$json[$key]=$value;
						}
   						$datoAI =$dato->estado;
						
						$color="#FAFAFF";
						if($contador%2==0){
							$color="#fff";
						}
						$contador++;
 						
  						echo('<tr style="border: 1px solid #EDEDFB;background-color: '.$color.'">'.
							 '<td align="center" >'.
								 '<img src="'.Yii::app()->baseUrl.'/img/edit.gif"   rel="accion_update" id="update_'.$dato->id.'"   style="cursor:pointer;" /></td>'.
							 '<td>'); ?>
							  <input type="hidden" id="json_<?=$dato->id?>" value='<?=json_encode($json)?>' />
 							<? 
							echo (($dato->id).'</td>'.
 							 '<td style="text-align:left" id="nombre:'.$dato->id.'">'. ($dato->nombre).'</td>'.
 							 '<td style="text-align:left" id="token:'.$dato->id.'">'.$urldir.'?token='.($dato->token).'</a></td>'.
							 '<td style="text-align:left" id="fechaini:'.$dato->id.'">'.$dato->fechainicio.'</td>'.
   							 '<td align="center" id="fechafin:'.$dato->id.'">'.$dato->fechafin.'</td>'.
							 '<td align="center" id="elimina:'.$dato->id.'"><input type="image" src="'.Yii::app()->baseUrl.'/img/bad.gif"  rel="accion_delete"  id="delete_'.$dato->id.'"  value="Eliminar"></td>'.
							 '</tr>');
					}
					 
					?>
                </table>					
		<?php echo CHtml::form(array("admin/fundacion/action"), 'post', array('class'=>'eliminar', 'id'=>'eliminar')); ?>
			<input type="hidden" id="id" name="Fundacion[id]" />
			<input type="hidden" id="option" name="option" value="eliminar"/>
 		</form>	
		<div id="addUpdate">
			<div class="divContentBlue"><div id="titulo"><b>Nuevo</b></div>
			  <div class="divContentWhite"> 
 			  <?php echo CHtml::form(array("admin/fundacion/action"), 'post', array('class'=>'formularioEstructura', 'id'=>'formForm')); ?>
 			  <input type="hidden" name="option" id="option" value="create" />
 			  <table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
				  <td>Nombre:</td>
				  <td><input type="text" id="nombre" name="Fundacion[nombre]" style="width:400px;" maxlength="200" />
 					  <input type="hidden" id="codigo" name="Fundacion[codigo]" value="" />
					  </td>
				</tr>
			    <tr>
					
					<td>Organizacion:</td>
				  <td> 
						<?
						echo '<select name="Fundacion[idorg]" style="width:90%;"><option value="-1">Seleccione una empresa</option>';
						foreach($organizaciones as $datae){
							$che="";
							if($datae->id==$usuario->idorgmenuserv){
								$che=' selected="selected" ';
							}							
							
 							echo '<option value="'.$datae->id.'" '. $che.' />'.$datae->nombre.'</option>';
							$contar++;
						}							
						echo '</select>';
						?>					  
					  </td>
				</tr>				
			    <tr>
				  <td>Fecha de inicio:</td>
				  <td><input type="text" id="fechainicio" name="Fundacion[fechainicio]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
				 
			    <tr>
				  <td>Fecha de finalización:</td>
				  <td><input type="text" id="fechafin" name="Fundacion[fechafin]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
				 
 				<tr><td colspan="2"><div id="cont-modules"></div><br><br></td>
				</tr>
			  </table>
  			  <div style="clear:both"></div>
			  <input type="button" id="b_create" value="Agregar" rel="b_create"  />
			  <input type="button" id="b_update" value="Editar"  rel="b_update"   style="display:none;" />
			  </form>
			  </div>
			</div>    
		</div>					
					
					
					
					
					
					
  				</div>
			</div>
			 
			<div style="clear:both"></div>
		</div>
 	</div>
	<div style="clear:both"></div>			 
</div>
<script>
	jQuery(function(){
		$( "#fechainicio" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
		$( "#fechafin" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
		$( ".fechaformat" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
	
		$( "#fechainicio,#fechafin" ).change(function(){
			var test1=jQuery("#fechainicio").val().split("-");
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
		
		
		
		
		
		
		
		
		
	jQuery("[rel^='accion_']").click(function(){
		var option=jQuery(this).attr("rel").split("_")[1];
		switch(option){
			case "update":
				var id=jQuery(this).attr("id").split("update_")[1];
				var jsonupdate=JSON.parse(jQuery("#json_"+id).val());
				if(jQuery(".formularioEstructura").find("[name='Fundacion[id]']").size()==0){
					jQuery(".formularioEstructura").append('<input type="hidden" name="Fundacion[id]" />');
				}
				jQuery.each(jsonupdate,function(k,d){
 					if(jQuery(".formularioEstructura").find("[name='Fundacion["+k+"]']").size()>0){
 						jQuery(".formularioEstructura").find("[name='Fundacion["+k+"]']").val(d);
						
					}
				});
				jQuery(".formularioEstructura").find("#option").val(option);
				jQuery(".formularioEstructura").find("[rel^='b_']").hide();
				jQuery(".formularioEstructura").find("[rel='b_update']").show();
				jQuery("#cont-modules").html(jQuery("#servi_"+id).clone().html());
				jQuery("#titulo").html("<b>Editar Parámetros</b>");
				jQuery("[rel='mod-cerrar']").click(function(){
				jQuery(this).parent().remove();
				});

			break;
			case "create":
				jQuery(".formularioEstructura").find("#option").val(option);
				jQuery(".formularioEstructura").find("[name^='Fundacion[']").val("");
				jQuery(".formularioEstructura").find("[name='Fundacion[id]']").remove();
				jQuery(".formularioEstructura").find("[rel^='b_']").hide();
				jQuery(".formularioEstructura").find("[rel='b_create']").show();
				jQuery("#titulo").html("<b>Nuevo HSEQ</b>");
				jQuery("#cont-modules").html("");

			break;
			case "delete":
				if(confirm("Esta seguro de realizar esta acción?")){
				var id=jQuery(this).attr("id").split("delete_")[1];
					jQuery(".eliminar").find("[name='Fundacion[id]']").val(id);
					jQuery(".eliminar").submit();
				}
			break;
			
		}
	});		
 		jQuery("[id^='b_']").click(function(){
			if(jQuery("#nombre").val()!="" && $( "#fechainicio").val()!="" && $("#fechafin" ).val()!=""){
				jQuery("#formForm").submit();
			}else{
				alert("Los datos están incompletos, por favor revisar");
			}
		});		
		
		
		
		
	});
</script>
