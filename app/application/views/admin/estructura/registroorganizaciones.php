<?
	$htmlModulos='<ul>';
	foreach($modulos as $data){
		$htmlModulos.='<li><label><input type="checkbox" name="modulo" value="'.$data->id.'" rel="'.$data->proyecto.'" />'.$data->proyecto.'</label></li>';
 	}
	$htmlModulos.='</ul>';
?>
<script>
jQuery(function(){


	jQuery("[rel^='accion_']").click(function(){
		var option=jQuery(this).attr("rel").split("_")[1];
		switch(option){
			case "update":
				var id=jQuery(this).attr("id").split("update_")[1];
				var jsonupdate=JSON.parse(jQuery("#json_"+id).val());
				if(jQuery(".formularioEstructura").find("[name='Organizacion[id]']").size()==0){
					jQuery(".formularioEstructura").append('<input type="hidden" name="Organizacion[id]" />');
				}
				jQuery.each(jsonupdate,function(k,d){
 					if(jQuery(".formularioEstructura").find("[name='Organizacion["+k+"]']").size()>0){
 						jQuery(".formularioEstructura").find("[name='Organizacion["+k+"]']").val(d);
						
					}
				});
				jQuery(".formularioEstructura").find("#option").val(option);
				jQuery(".formularioEstructura").find("[rel^='b_']").hide();
				jQuery(".formularioEstructura").find("[rel='b_update']").show();
				jQuery("#cont-modules").html(jQuery("#servi_"+id).clone().html());
				jQuery("#titulo").html("<b>Editar Organización</b>");
				jQuery("[rel='mod-cerrar']").click(function(){
				jQuery(this).parent().remove();
				});

			break;
			case "create":
				jQuery(".formularioEstructura").find("#option").val(option);
				jQuery(".formularioEstructura").find("[name^='Organizacion[']").val("");
				jQuery(".formularioEstructura").find("[name='Organizacion[id]']").remove();
				jQuery(".formularioEstructura").find("[rel^='b_']").hide();
				jQuery(".formularioEstructura").find("[rel='b_create']").show();
				jQuery("#titulo").html("<b>Nueva Organización</b>");
				jQuery("#cont-modules").html("");

			break;
			case "delete":
				if(confirm("Esta seguro de realizar esta acción?")){
				var id=jQuery(this).attr("id").split("delete_")[1];
					jQuery(".eliminar").find("[name='Organizacion[id]']").val(id);
					jQuery(".eliminar").submit();
				}
			break;
			
		}
	});


	jQuery("[id^='b_']").click(function(){
 		jQuery("#formForm").submit();
 	});
	jQuery("#servicio").click(function(){
		var html='<div class="divContentBlue"><div class="divContentWhite"><b>Nombre:</b><input type="text" name="nombremodulo" /><br><b>Seleccione almenos un modulo</b></br><?=$htmlModulos?></br><input type="button" value="Guardar" name="guardarservicio"/></div></div>';
		jQuery.colorbox({html:html});
		jQuery("[name='guardarservicio']").click(function(){
			var modules=jQuery("[name='modulo']:checked");
			var valida=true;
			if(modules.length==0){
				alert("Por favor seleccione al menos un modulo");
				valida=false;
			}
			if((jQuery("[name='nombremodulo']").val()).trim("")==""){
				alert("Por favor escriba el nombre del servicio");
				valida=false;
			}
			if(valida==true){
				var html='<div class="servicios-add" style="float:left;margin-left:10px;width:140px;height:140px;border: 2px solid #EDEDFB;padding:10px">';
				var id=jQuery(".servicios-add").size();
				html+='<input type="image" src="<?=Yii::app()->baseUrl?>/img/bad.gif" rel="mod-cerrar" style="float:right" /></br>';
				html+='<center><b><span style="color:#1F497D" >'+(jQuery("[name='nombremodulo']").val()).trim("")+'</span></b></center></br>';
				html+='<label><input type="checkbox" name="module['+id+'][demo]" value="1" /><b>Demo</b></label></br>';
				html+='<input type="hidden" name="module['+id+'][nombre]" value="'+(jQuery("[name='nombremodulo']").val()).trim("")+'"/>';
				html+='<div id="m'+id+'" style="overflow:hidden;overflow-y:scroll;">';
 				jQuery.each(modules,function(k,d){
					var obj=jQuery(d);
					html+='<input type="hidden" name="module['+id+'][module]['+k+']" value="'+obj.val()+'" />';
					html+='<b>'+obj.attr("rel")+'</b></br>';
				});
				html+='</div><div id="clear" style="clear:both"></div>';
				html+='</div>';
				jQuery("#cont-modules").append(html);
				jQuery.colorbox.close();
				jQuery("[rel='mod-cerrar']").click(function(){
					jQuery(this).parent().remove();
				});
				//cont-modules
 			}
			
		});
	});


})
</script>
<?php echo CHtml::form(array("admin/estructuraorg/actionsorg/"), 'post', array('class'=>'eliminar', 'id'=>'formEliminar')); ?>
	<input type="hidden" name="option" value="delete" />
	<input type="hidden" name="Organizacion[id]" value="-1" />
</form>
<div id="content" style="position:relative">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
 
		<tr>
		<td>
		
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue"><b>Organizaciones creadas</b>
			  <div class="divContentWhite">
			    <table width="100%"  style="border: 1px solid #EDEDFB" cellspacing="0" cellpadding="2" id="tableData">
                 <? if($model!=NULL){ ?>
				 <tr  style="border: 1px solid #EDEDFB;background-color: #EDEDFB">
				  
				    <td align="center" width="20"><a href="javascript:;" rel="accion_create" style="text-decoration:none;"><img src="<?=Yii::app()->baseUrl?>/img/add.gif" width="20" height="20" border="0" /><br />
				      Crear</a></td>
				 
				    <td  >ITEM</td>
                    <td>CODIGO </td>
                    <td>NOMBRE </td>
                    <td>ORGANIGRAMA </td>
                     <td align="center" >Estado</td>
                    <td align="center"  ></td>
					
                  </tr>
				   <? } ?>
				  	<?PHP
					$contador=0;
 					foreach($model as $dato){
 						foreach($dato as $key=>$value){
							$json[$key]=$value;
						}
   						$datoAI =$dato->estado;
						
						$color="#FAFAFF";
						if($contador%2==0){
							$color="#fff";
						}
						$contador++;
						
						
						$aData=array();
						$criteria = new CDbCriteria;
						$criteria->condition ='idorganizacion='.$dato->id;
						$servicios=Servicio::model()->findAll($criteria);
						$dviserv='<div id="servi_'.$dato->id.'" style="display:none">';
						$contador=0;
						foreach($servicios as $servicio){
							$dviserv.='<div class="servicios-add" style="float:left;margin-left:10px;width:140px;border: 2px solid #EDEDFB;padding:10px">';
							$id=$servicio->id;
							$contador++;
							$dviserv.='<image  src="'.Yii::app()->baseUrl.'/img/bad.gif" rel="mod-cerrar" style="float:right;cursor:pointer" /></br>';
							$dviserv.='<center><b><span style="color:#1F497D" >'.$servicio->nombre.'</span></b></center></br>';
							$checked='';
							if((int)$servicio->demo==1){$checked=' checked="checked"';}
							
							$dviserv.='<label><input type="checkbox" name="module['.$id.'][demo]" value="1" '.$checked.' /><b>Demo</b></label></br>';
 							$dviserv.='<input type="hidden" name="module['.$id.'][nombre]" value="'.$servicio->nombre.'"/>';
							$dviserv.='<div style="overflow:hidden;overflow-y:scroll;">';
 							$modulos=explode(",",$servicio->jmodulos);
							foreach($modulos as $k=>$modulo){
 								$rm=Modulo::model()->findByPk($modulo);
								$dviserv.='<input type="hidden" name="module['.$servicio->id.'][module]['.$k.']" value="'.$rm->id.'" />';
								$dviserv.='<b>'.$rm->proyecto.'</b></br>';
 							}
							$dviserv.='</div>';
							$dviserv.='</div>';
				
						}
						$dviserv.='</div>';
						
  						echo('<tr style="border: 1px solid #EDEDFB;background-color: '.$color.'">'.
							 '<td align="center" >'.
								 '<img src="'.Yii::app()->baseUrl.'/img/edit.gif"   rel="accion_update" id="update_'.$dato->id.'"   style="cursor:pointer;" /></td>'.
							 '<td>'); ?>
							 <?=$dviserv?>
							 <input type="hidden" id="json_<?=$dato->id?>" value='<?=json_encode($json)?>' />
							<? 
							echo (($dato->id).'</td>'.
							 '<td style="text-align:left" id="codigo:'.$dato->id.'"  >'. ($dato->codigo).'</td>'.
							 '<td style="text-align:left" id="nombre:'.$dato->id.'">'. ($dato->nombre).'</td>'.
							 '<td style="text-align:left" id="nombre:'.$dato->id.'"><a href="'.YII::app()->baseUrl.'/index.php/admin/estructuraorg/organigrama/?id='.$dato->id.'" />ver</a></td>'.
   							 '<td align="center" id="estado:'.$dato->id.'">'.$datoAI.'</td>'.
							 '<td align="center" id="elimina:'.$dato->id.'"><input type="image" src="'.Yii::app()->baseUrl.'/img/bad.gif"  rel="accion_delete"  id="delete_'.$dato->id.'"  value="Eliminar"></td>'.
							 '</tr>');
					}
					 
					?>
                </table>
			  </div>
			</div>
		</td>
		</tr>
		<tr>
		<td height="5"></td>
		</tr>
		<tr>
		<td id="addUpdate">
			<div class="divContentBlue"><div id="titulo"><b>Nueva Organización</b></div>
			  <div class="divContentWhite"> 
			   <? if($modulos!=NULL){ ?>
			  	<b>Agregar servicio:</b><a id="servicio" href="javascript:;"style="text-decoration:none;"><img src="<?=Yii::app()->baseUrl?>/img/add.gif" width="20" height="20" border="0"></a>		
				 <? } ?>
			  <?php echo CHtml::form(array("admin/estructuraorg/actionsorg"), 'post', array('class'=>'formularioEstructura', 'id'=>'formForm')); ?>
 			  <input type="hidden" name="option" id="option" value="create" />
 			  <table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
				  <td>Nombre:</td>
				  <td><input type="text" id="nombre" name="Organizacion[nombre]" style="width:400px;" maxlength="200" />
 					  <input type="hidden" id="codigo" name="Organizacion[codigo]" value="" />
					  </td>
				</tr>
			    <tr>
				  <td>Nit:</td>
				  <td><input type="text" id="nombre" name="Organizacion[nit]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Dirección:</td>
				  <td><input type="text" id="nombre" name="Organizacion[direccion]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Ciudad:</td>
				  <td><input type="text" id="nombre" name="Organizacion[ciudad]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Teléfono:</td>
				  <td><input type="text" id="nombre" name="Organizacion[telefono]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>FAX:</td>
				  <td><input type="text" id="nombre" name="Organizacion[fax]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Representante legal:</td>
				  <td><input type="text" id="nombre" name="Organizacion[representantelegal]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Documento identidad representante legal:</td>
				  <td><input type="text" id="nombre" name="Organizacion[docidentidadrep]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Nombre de Contacto:</td>
				  <td><input type="text" id="nombre" name="Organizacion[nombrecontacto]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Documento identidad de Contacto:</td>
				  <td><input type="text" id="nombre" name="Organizacion[docidentidadcontacto]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>e-mail contacto:</td>
				  <td><input type="text" id="nombre" name="Organizacion[emailcontacto]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Actividad económica:</td>
				  <td><input type="text" id="nombre" name="Organizacion[actividadeconomica]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
			    <tr>
				  <td>Nodos de reporte:</td>
				  <td><input type="text" id="nodosreporte" name="Organizacion[nodosreporte]" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
				  <? if($model!=NULL){ ?>
				<tr>
				  <td>Activo:</td>
				  <td>
				  	  <select name="Organizacion[estado]" id="estado">
					  <option value="activo">Activa</option>
					  <option value="inactivo">Inactiva</option>
					  </select>
				  </td>
				</tr> <? }else{?>
				<input type="hidden" name="Organizacion[estado]" value="activo" />
				<?} ?>
				<tr><td colspan="2"><div id="cont-modules"></div><br><br></td>
				</tr>
			  </table>
  			  <div style="clear:both"></div>
			  <input type="button" id="b_create" value="Agregar" rel="b_create"  />
			    <? if($model!=NULL){ ?>
			  <input type="button" id="b_update" value="Editar"  rel="b_update"   style="display:none;" />
			    <? } ?>
			  </form>
			  </div>
			</div>    
		</td>
		</tr>
		<tr>
		<td>
			
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
	
</div>