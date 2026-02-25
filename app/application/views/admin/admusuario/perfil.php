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
				empresar: "Seleccione una organización",
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
 			
		});
		jQuery("[rel='volver']").click(function(){
			document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/admusuario";
		});
 
 
	});
</script>
 <div id="content" style="position:relative">
 	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		 
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Perfil
			  <div class="divContentWhite">
				<?php echo CHtml::form(array("admin/admusuario/perfil"), 'post', array('class'=>'formCrear' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;')); ?>
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
 
 
 				  <tr valign="top">
					 <td><b>Nombre y apellido</b></td>
					 <td>
 						<b><?=$usuario->nombres?></b>
  					 </td>
				  </tr>
 
 				  <tr valign="top">
					 <td><b>Nombre de usuario</b></td>
					 <td>
						<b><?=$usuario->alias?><br />
 					</td>
				  </tr>
				  <tr valign="top">
				     <td><b>No Documento</b></td>
					 <td>
					 	<b><?=$usuario->documento?></b>
 					 </td>
				  </tr>
				  <tr valign="top">
				     <td><b>Contraseña</b></td>
					 <td>
					 	<input type="password" name="password" id="password" <? if(is_object($usuario)){?>value="<?=$usuario->clave?>"<?}?>  maxlength="20" style="width:100px">
						<div id="errorsDiv_password"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td><b>Repite Contraseña</b></td>
					 <td>
					 	<input type="password" name="password2" id="password2" <? if(is_object($usuario)){?>value="<?=$usuario->clave?>"<?}?> maxlength="20" style="width:100px">
						<div id="errorsDiv_password"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td><b>Email</b></td>
					 <td>
					 	<input type="email" name="email" id="email" <? if(is_object($usuario)){?>value="<?=$usuario->email?>"<?}?> maxlength="50" style="width:200px">
						<div id="errorsDiv_email"></div>
					 </td>
				  </tr>
 
 
 				  <tr valign="top">
				     <td></td>
					 <td><input type="submit" value="Guardar"   /></td>
				  </tr>
                </table>
				<input type="hidden" name="save" />
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
