<script>
jQuery(function(){


	jQuery("[rel^='accion_']").click(function(){
		var TEXT=jQuery(this).attr("rel").split("_");
		var valida =true;
		
		if(TEXT[1]=="eliminar"){
			if(confirm("Al eliminar esta unidad, eliminará también las áreas asociadas y los cargos existentes. ¿Desea continuar?")){
 				var IDCOn=jQuery(this).attr("id");
 				jQuery("#formEliminar [name='textId']").val(IDCOn);
				jQuery("#formEliminar").submit();
 			}
 			valida =false;
		}
 		if(valida==true){
			jQuery("[name='textAccion']").val(TEXT[1]);	
			
			
			var action="<?=$_SERVER["SCRIPT_NAME"]?>/admin/estructura/";
			if(jQuery(this).attr("id")>0){
			var IDCOn=jQuery(this).attr("id");
				jQuery("[name='textId']").val(jQuery(this).attr("id"));	
 				var action="<?=$_SERVER["SCRIPT_NAME"]?>/admin/estructura/selecUnidadesActivasConsulta";
				jQuery.getJSON(action,{id:IDCOn}).done(function(data){
						jQuery.each( data, function( key, val ) {
							jQuery("#"+key).val(val);
							 
						});
				});
				
			}
			
			jQuery("[id^='b_']").hide();	
			jQuery("[id='b_"+TEXT[1]+"']").show();
			if(TEXT[1]=="insert"){
				jQuery("input[id^='text']").val("");
				jQuery("#selectActiva").val(1);
			}
		}

	});


	jQuery("[id^='b_']").click(function(){
	
	 
		jQuery("#formForm").submit();
	 
	});

})
</script>
<?php echo CHtml::form(array("admin/estructura/Unidades/"), 'post', array('class'=>'eliminar', 'id'=>'formEliminar')); ?>
	<input type="hidden" name="textAccion" value="eliminar" />
	<input type="hidden" name="textId" value="-1" />
</form>
<div id="content" style="position: relative;">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
 
		<tr>
		<td>
		
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Empresas creadas
			  <div class="divContentWhite">
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
                  <tr>
				    <td align="center" width="20"><a href="javascript:;" rel="accion_insert" style="text-decoration:none;"><img src="<?=$imageurl?>add.gif" width="20" height="20" border="0" /><br />
				      Crear</a></td>
				    <td width="50">ITEM</td>
                    <td>NOMBRE </td>
                      <td align="center" width="50">A/I</td>
                    <td align="center" width="50"></td>
                  </tr>
				  	<?PHP
 					for($i=0;$i<count($cunive);$i++){
						$dato = $cunive[$i];
						$datoAI = "A";
						if($dato->activa == 0){
							$datoAI = "I";
						}
 						echo('<tr>'.
							 '<td align="center" >'.
								 '<img src="'.$imageurl.'edit.gif" width="20" height="20" rel="accion_update" id="'.$dato->id.'"   style="cursor:pointer;" /></td>'.
							 '<td>'. ($dato->id).'</td>'.
							 '<td style="text-align:left" id="nombre:'.$dato->id.'">'. ($dato->nombre).'</td>'.
   							 '<td align="center" id="activo:'.$dato->id.'">'.$datoAI.'</td>'.
							 '<td align="center" id="elimina:'.$dato->id.'"><input type="image" src="'.$imageurl.'bad.gif"  rel="accion_eliminar"  id="'.$dato->id.'"  value="Eliminar"></td>'.
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
			<div class="divContentBlue">Registrar Empresas  
			  <div class="divContentWhite"> 
			  <?php echo CHtml::form(array("admin/estructura/Unidades/"), 'post', array('class'=>'formularioEstructura', 'id'=>'formForm')); ?>
 			  <input type="hidden" name="textAccion" id="textAccion" value="insert" />
			  <input type="hidden" name="textId" id="textId" value="" />
			  <table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
				  <td>Nombre:</td>
				  <td><input type="text" id="textNom" name="textNom" style="width:400px;" maxlength="200" />
					  <input type="hidden" id="textEmp" name="textEmp" value="EMP"/>
					  <input type="hidden" id="textCod" name="textCod" value="COD" />
					  </td>
				</tr>
			    <tr>
				  <td>Nodos de reporte:</td>
				  <td><input type="text" id="nodosreporte" name="nodosreporte" style="width:400px;" maxlength="200" />
 					  </td>
				</tr>
				 
				<tr>
				  <td>Activo:</td>
				  <td>
				  	  <select name="selectActiva" id="selectActiva">
					  <option value="1">Activa</option>
					  <option value="0">Inactiva</option>
					  </select>
				  </td>
				</tr>
			  </table>
			  <input type="button" id="b_insert" value="Agregar" rel="b_create"  />
			  <input type="button" id="b_update" value="Editar"  rel="b_update"   style="display:none;" />
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