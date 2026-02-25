<script>
jQuery(function(){


	jQuery("[rel^='accion_']").click(function(){
		var TEXT=jQuery(this).attr("rel").split("_");
		
		
		jQuery("[name='textAccion']").val(TEXT[1]);	
		
		
		var action="<?=$urlbase?>index.php/admin/estructura/sa/"+TEXT[1];
		jQuery("#formForm").attr("action",action);
 		if(jQuery(this).attr("id")>0){
		var IDCOn=jQuery(this).attr("id");
			jQuery("[name='textId']").val(jQuery(this).attr("id"));	

 			var action="<?=$urlbase?>index.php/admin/estructura/selecAreasConsulta";
 			jQuery.getJSON(action,{id:IDCOn}).done(function(data){
 					jQuery.each( data, function( key, val ) {
 						jQuery("#"+key).val(val);
						 
					});
 			 });
			
		}
		
		jQuery("[id^='b_']").hide();	
		jQuery("[id='b_"+TEXT[1]+"']").show();
		if(TEXT[1]=="insertAreas"){
			jQuery("input[id^='text']").val("");
			jQuery("#selectActiva").val(1);
 		}

	});


	jQuery("[id^='b_']").click(function(){
	
	 
		jQuery("#formForm").submit();
	 
	});
	jQuery("[rel^='elimina_']").click(function(){
		var TEXT=jQuery(this).attr("rel").split("_");
		var PADRE=jQuery(this).parent().parent();
		var dato=TEXT[1];
		if (confirm("Al eliminar esta área, se eliminarán tambien los cargos asociados. ¿Desea continuar?"))
		{	//document.Eliminar.submit()
           // location.href="admAreas.php?elim=1 & id="+dato+"";
			
			
			var action="<?=$urlbase?>index.php/admin/estructura/eliminaArea";
			jQuery.getJSON(action,{id:dato}).done(function(data){
					jQuery.each( data, function( key, val ) {
					console.log(val);
 						 if(val=="OK"){
						 
							PADRE.remove();
							alert("El area ha sido eliminada");
						 
						 }
					});
			 });			
			
			
			
			
        }  	
	
	});

});
function confirmarEliminar(dato)
	{

	}


</script>


<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
 
		<tr>
		<td>
		
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Areas Creadas
			  <div class="divContentWhite">
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
                  <tr>
				    <td align="center" width="20"><a href="javascript:;" rel="accion_insertAreas" style="text-decoration:none;"><img src="<?=$imageurl?>add.gif" width="20" height="20" border="0" /><br />
				      Crear</a></td>
				    <td width="50">ITEM</td>
                    <td>AREA O PROCESO </td>
 					<td>Empresa</td>
                    <td align="center" width="50">A/I</td>
					<td align="center"></td>
                  </tr>
				  	<?PHP
 					for($i=0;$i<count($cunive);$i++){
						$dato = $cunive[$i];
						$datoAI = "A";
						if($dato->activa == 0){
							$datoAI = "I";
						}
						 
						$criteria = new CDbCriteria;
						$criteria->condition ="id=".$dato->idunidad;						
 						$unidadt= EvalUnidades::model()->find($criteria);
   						echo('<tr>'.
							 '<td align="center" >'.
								 '<img src="'.$imageurl.'edit.gif" width="20" height="20" rel="accion_updateAreas" id="'.$dato->id.'"   style="cursor:pointer;" /></td>'.
							 '<td>'.($i+1).'</td>'.
							 '<td style="text-align:left" id="nombre:'.$dato->id.'">'. ($dato->nombre).'</td>'.
 							 '<td style="text-align:left" id="idunidad:'.$dato->id.'">'. ($unidadt->nombre).'</td>'.
							 '<td align="center" id="activo:'.$dato->id.'">'.$datoAI.'</td>'.
							 '<td align="center"><input type="image"src="'.$imageurl.'bad.gif" rel="elimina_'.$dato->id.'"  value="Eliminar"></td>'.
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
			<div class="divContentBlue">Registrar áreas o dependencias  
			  <div class="divContentWhite">
			  <?php echo CHtml::form(array("admin/estructura/Areas"), 'post', array('class'=>'formularioEstructura', 'id'=>'formForm')); ?>
 			  <input type="hidden" name="op" id="op" value="insertAreas" />
			  <input type="hidden" name="textId" id="textId" value="" />
			  <table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
				  <td>Area  o dependencia:</td>
				  <td><input type="text" id="textNom" name="textNom" style="width:400px;" maxlength="200" /></td>
				</tr>
 				<tr>
				  <td>Empresa:</td>
				  <td><select id="textIdunidad" name="textIdunidad" style="width:500px;" maxlength="300" >
					  <? $unidades= EvalUnidades::model()->findAll();
					  foreach( $unidades as $unidad){ ?>
						  <option value="<?=$unidad->id?>"><?=$unidad->nombre?></option>
						  
						<?  } ?>
					  </select>
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
			  <input type="button" id="b_insertAreas" value="Agregar" rel="b_insert"  />
			  <input type="button" id="b_updateAreas" value="Editar"  rel="b_update"   style="display:none;" />
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