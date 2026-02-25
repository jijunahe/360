   <style>
.ventanaBodyError {
color: #990000;
border: solid 1px #4F0000;
padding: 3px;
background-color: #FFF0E1;
}

.divGood {
background-color: #E2FFDF;
border: 1px solid #085500;
padding: 5px;
text-align: center;
}
</style>
<script>
	$.validator.setDefaults({
		submitHandler: function() {
			var url=$("#formCrear").attr("action");
			var objdata=$("#formCrear").serialize();
			 
 			jQuery.ajax({ 
			type: "POST",
			dataType: "json",
 			url: url,
			data:objdata,
			success:function(res){
				
				alert(res[0]);
				jQuery("#idusuario").val(res[1]);
				
			}});
		}
	});
	$().ready(function() {
		// validate the comment form when it is submitted
 
		// validate signup form on keyup and submit
		$("#formCrear").validate({
			rules: {
 				usuario: {
					required: true,
					minlength: 5
				},
				password: {
					required: true,
					minlength: 5
				},
				password2: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
				empresar: {
 					required: true
				} ,
				perfil: {
 					required: true,
				},
				documento: {
 					required: true,
					minlength: 4
				} 
			},
			messages: {
 				usuario: {
					required: "Por favor, ingrese el usuario",
					minlength: "El usuario debe ser de minimo cinco caracteres"
				},
				password: {
					required: "Por favor ingrese el password",
					minlength: "El password debe ser de al menos cinco caracteres"
				},
				password2: {
					required: "Por favor confirme el password",
					minlength: "El password debe ser de al menos cinco caracteres",
					equalTo: "Los password no coinciden"
				},
				email: "Por favor ingrese un email válido",
				empresar: "Seleccione una empresa",
				perfil: "Seleccione el perfil de usuario",
				documento: "Por favor ingrese el documento de identidad",
			}
		});
		
		
		jQuery("[name='empresa']").click(function(){
			var valor=jQuery(this).val();
			var objs=jQuery("[name='empresa']:checked");
			var checked=[];
			jQuery.each(objs,function(k,d){
				 var dato=jQuery(d).val();
				 checked.push(dato);
			});
			jQuery("#empresar").val(checked.join(","));
 			
		})
 
 
	});
</script>

<div id="content">
		<div style="clear:both" ></div> 
	<img src="<?=Yii::app()->baseUrl?>/images/moduloseguimientolineabase.jpg"  style="width:100%;height:250px" />

	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		 
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Crear usuario
			  <div class="divContentWhite">
				<?php echo CHtml::form(array("admin/rcv/crear"), 'post', array('class'=>'formCrear' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;')); ?>
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
 
 
 				  <tr valign="top">
					 <td>Nombre de usuario</td>
					 <td>
						Nombre de usuario que usara la persona para ingresar al sistema.<br />
						<input type="text" name="usuario" id="usuario" <? if(is_object($usuario)){?>value="<?=$usuario->alias?>"<?}?> maxlength="20" style="width:100px" >
						<br />
						Solo se permiten letras, numeros, punto, guion bajo y guion medio. No se permiten tildes, ñ, espacios.
 					 </td>
				  </tr>
				  <tr valign="top">
				     <td>No Documento</td>
					 <td>
					 	<input type="number" name="documento" id="documento" <? if(is_object($usuario)){?>value="<?=$usuario->documento?>"<?}?> maxlength="20" style="width:100px">
						<div id="errorsDiv_documento"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Contraseña</td>
					 <td>
					 	<input type="password" name="password" id="password" <? if(is_object($usuario)){?>value="<?=$usuario->clave?>"<?}?>  maxlength="20" style="width:100px">
						<div id="errorsDiv_password"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Repite Contraseña</td>
					 <td>
					 	<input type="password" name="password2" id="password2" <? if(is_object($usuario)){?>value="<?=$usuario->clave?>"<?}?> maxlength="20" style="width:100px">
						<div id="errorsDiv_password"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Email</td>
					 <td>
					 	<input type="email" name="email" id="email" <? if(is_object($usuario)){?>value="<?=$usuario->email?>"<?}?> maxlength="50" style="width:200px">
						<div id="errorsDiv_email"></div>
					 </td>
				  </tr>
 				  <tr valign="top">
				     <td>Perfil</td>
					 <td>
					 	<select id="perfil" name="perfil">
							<option value="-1">Seleccione un perfil de ususario</option>
						<?
							foreach($perfiles as $datap){
								$selected='';
								if(is_object($usuario)){
									if($datap->id==$usuario->perfil){
										$selected=' selected="selected" ';
									}
									
								}
								echo '<option value="'.$datap->id.'" '.$selected.'>'.$datap->nombre.'</option>';
							}
						?>
						</select>
					 </td>
				  </tr>
 				  <tr valign="top">
				     <td>Empresa</td>
					 <td>
					 	 
						<?	
							$contar=1;
							$empresasr="";
							$tunidades=array();
							$perfil="";
							$idusuario="";
							if(is_object($usuario)){
								$empresasr=$usuario->id_unidad;
								$tunidades=explode(",",$empresasr);
								$perfil=$usuario->perfil;
								$idusuario=$usuario->id;
							}
							if(!is_object($usuario) or ($perfil=="" or $perfil==3 or $perfil==4 or $perfil==1)){	
								foreach($empresas as $datae){
									$br="";
									if($contar%6==0){
										$br="</br></br>";
									}
									$che="";
									if(in_array($datae->id,$tunidades)){
										$che=' checked="checked" ';
									}
									echo '<label style="margin-left:30px"><input type="checkbox" name="empresa" value="'.$datae->id.'" '. $che.' />'.$datae->nombre.'</label>'.$br;
									$contar++;
								}?>
								<input type="hidden" name="empresar" id="empresar" value="<?=$empresasr?>" />
 								<?
							}else if($perfil==2){
							
								echo '<select name="empresar"><option value="-1">Seleccione una empresa</option>';
								foreach($empresas as $datae){
 									$che="";
									if(in_array($datae->id,$tunidades)){
										$che=' selected="selected" ';
									}
									echo '<option value="'.$datae->id.'" '. $che.' />'.$datae->nombre.'</option>';
									$contar++;
								}							
							echo '</select>';
 							}
						?><br><div style="clear:both"></div>
 						<input type="hidden" name="save" />
 						<input type="hidden" name="idusuario" id="idusuario" value="<?=$idusuario?>" />
					 </td>
				  </tr>
 				  <tr valign="top">
				     <td></td>
					 <td><input type="submit" value="Guardar"   /></td>
				  </tr>
                </table>
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
