<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/encuestalibre";
 ?>
  <style>
 #addUpdate{
	position:absolute;
	width:100%;
	display:none;
	margin-top:40px;
  }
  #modal{
	width:30%;
	background-color:#2E75B5 !important;
  }
  #titulo{
	color:#fff;
  }
  
  
@media (max-width: 900px) {
  #modal{
	width:50%;
   }
}  
@media (max-width: 600px) {
  #modal{
	width:70%;
   }
}   

@media (max-width: 500px) {
  #modal{
	width:95%;
   }
}   
  
 </style>
 
 <div id="addUpdate" >
	<center>
		<div class="divContentBlue" id="modal"><div id="titulo"><b>Nuevo</b></div>
		  <div class="divContentWhite"> 
		  <?php echo CHtml::form(array("admin/felicidad/action"), 'post', array('class'=>'formularioEstructura', 'id'=>'formForm')); ?>
		  <input type="hidden" name="option" id="option" value="create" />
		  <table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
			  <td>Nombre:</td>
			  <td><input type="text" id="nombre" name="Felicidad[nombre]" style="width:95%;" maxlength="200" />
				  <input type="hidden" id="codigo" name="Felicidad[codigo]" value="" />
				  </td>
			</tr>
			<tr>
			  <td>Fecha de inicio:</td>
			  <td><input type="text" id="fechainicio" name="Felicidad[fechainicio]" style="width:95%;" maxlength="200" />
				  </td>
			</tr>
			 
			<tr>
			  <td>Fecha de finalización:</td>
			  <td><input type="text" id="fechafin" name="Felicidad[fechafin]" style="width:95%;" maxlength="200" />
				  </td>
			</tr>
			 
			<tr><td colspan="2"><div id="cont-modules"></div><br><br></td>
			</tr>
		  </table>
		  <div style="clear:both"></div>
		  <input type="button" id="b_create" value="Agregar" rel="b_create"  />
		  <input type="button" id="b_update" value="Editar"  rel="b_update"   style="display:none;" />
		  <input type="button" id="cancelar" value="Cancelar"  rel="cancelar"   />
		  </form>
		  </div>
		</div>  
	</center>
</div>
  
 
<div id="content">
   	<div class="divContentBlue">
		<h3>Encuesta de Felicidad</h3>
 		<div class="divContentWhite">
  					<div style="clear:both"></div>
					<a href="javascript:;" rel="accion_create" style="text-decoration:none;"><img src="<?=Yii::app()->baseUrl?>/img/add.gif" width="20" height="20" border="0" /><br />
				      Crear</a>
				<table width="100%"  style="border: 1px solid #EDEDFB" cellspacing="0" cellpadding="2" id="tableData">
                  <tr  style="border: 1px solid #EDEDFB;background-color: #EDEDFB">
				     
                     <td>URL </td>
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
 						
  						echo('<tr style="border: 1px solid #EDEDFB;background-color: '.$color.'">'
 							); ?>
 							<? 
							echo (
 							
 							 '<td style="text-align:left" id="token:'.$dato->id.'" >');
							 ?>
							 
							 <input type="hidden" id="json_<?=$dato->id?>" value='<?=json_encode($json)?>' />
 							<?php 
							echo ('<div style="border: 3px solid #ededfb;border-radius: 8px;padding: 5px;">'.
 							 
								'<div style="float:right;width:50px" ><div style="float:left" id="editar:'.$dato->id.'"><img src="'.Yii::app()->baseUrl.'/img/edit.gif"   rel="accion_update" id="update_'.$dato->id.'"   style="cursor:pointer;" /></div>'.
							 	'<div style="float:left" id="elimina:'.$dato->id.'"><input type="image" src="'.Yii::app()->baseUrl.'/img/bad.gif"  rel="accion_delete"  id="delete_'.$dato->id.'"  value="Eliminar"></div></div>'. 
 							 
							  '<div style="text-align:left" id="nombre:'.$dato->id.'"><b>Nombre:</b>'. ($dato->nombre).
 							 '</div>'.
							 
							'<input type="text" style="width:60%" value="'. $urldir.'?token='.($dato->token).'" rel="copiar_'.$dato->id.'" /><input type="button" value="copiar" id="cp_'.$dato->id.'" rel="accion_copiar" />'.
								'<br><div style="text-align:left" id="fechaini:'.$dato->id.'"><b>Fecha inicio: </b>'.$dato->fechainicio.'</div>'.
								'<div style="text-align:left"  id="fechafin:'.$dato->id.'"><b>Fecha Fin: </b>'.$dato->fechafin.'</div>'.
 
							 
							 '</td></div>'.
							 '</tr>');
					}
					 
					?>
                </table>					
		<?php echo CHtml::form(array("admin/felicidad/action"), 'post', array('class'=>'eliminar', 'id'=>'eliminar')); ?>
			<input type="hidden" id="id" name="Felicidad[id]" />
			<input type="hidden" id="option" name="option" value="eliminar"/>
 		</form>
   			 
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
			case "update":jQuery("#addUpdate").show();
				var id=jQuery(this).attr("id").split("update_")[1];
				var jsonupdate=JSON.parse(jQuery("#json_"+id).val());
				if(jQuery(".formularioEstructura").find("[name='Felicidad[id]']").size()==0){
					jQuery(".formularioEstructura").append('<input type="hidden" name="Felicidad[id]" />');
				}
				jQuery.each(jsonupdate,function(k,d){
 					if(jQuery(".formularioEstructura").find("[name='Felicidad["+k+"]']").size()>0){
 						jQuery(".formularioEstructura").find("[name='Felicidad["+k+"]']").val(d);
						
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
			case "create":jQuery("#addUpdate").show();
				jQuery(".formularioEstructura").find("#option").val(option);
				jQuery(".formularioEstructura").find("[name^='Felicidad[']").val("");
				jQuery(".formularioEstructura").find("[name='Felicidad[id]']").remove();
				jQuery(".formularioEstructura").find("[rel^='b_']").hide();
				jQuery(".formularioEstructura").find("[rel='b_create']").show();
				jQuery("#titulo").html("<b>Nueva Encuesta</b>");
				jQuery("#cont-modules").html("");

			break;
			case "delete":
				if(confirm("Esta seguro de realizar esta acción?")){
				var id=jQuery(this).attr("id").split("delete_")[1];
					jQuery(".eliminar").find("[name='Felicidad[id]']").val(id);
					jQuery(".eliminar").submit();
				}
			break;
			
			case "copiar":
				var id=jQuery(this).attr("id").split("_")[1];
				
				
				$("[rel='copiar_"+id+"']").select(); // Acá se obtiene el id del boton que hemos creado antes y se le agrega un valor y luego se le sombrea con select(). Para agregar lo que se quiere copiar editas val("EDITAESTOAQUÍ")
				document.execCommand("copy");
				 
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
	jQuery("[rel='cancelar']").click(function(){
		jQuery("#addUpdate").hide();
		
	});	
		
	 
		
		
		
	});
</script>
